<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirmation;
    public $avatar;
    public $avatarPreview;

    public function mount()
    {
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
            $this->avatarPreview = Storage::url($user->avatar);
        } else {
            $this->avatarPreview = null;
        }
    }

    public function updatedAvatar()
    {
        if (!$this->avatar) {
            return;
        }

        $this->validate([
            'avatar' => 'image|max:5120', // 5MB Max
        ], [
            'avatar.image' => 'The file must be an image.',
            'avatar.max' => 'The image size must not exceed 5MB.',
        ]);

        try {
            // Create preview using temporary URL
            if (method_exists($this->avatar, 'temporaryUrl')) {
                $this->avatarPreview = $this->avatar->temporaryUrl();
            } else {
                // Fallback for when file is already uploaded
                $this->avatarPreview = null;
            }
        } catch (\Exception $e) {
            \Log::error('Preview error: ' . $e->getMessage());
            $this->addError('avatar', 'Failed to load image preview: ' . $e->getMessage());
        }
    }

    public function uploadAvatar()
    {
        // Validate the file
        $this->validate([
            'avatar' => 'required|image|max:5120|mimes:jpeg,png,jpg,gif,webp',
        ], [
            'avatar.required' => 'Please select an image to upload.',
            'avatar.image' => 'The file must be an image.',
            'avatar.max' => 'The image size must not exceed 5MB.',
            'avatar.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
        ]);

        if (!$this->avatar) {
            session()->flash('error', 'No file selected. Please choose a photo first.');
            return;
        }

        try {
            $user = Auth::user();
            
            // Delete old avatar if exists
            if ($user->avatar) {
                $oldPath = 'public/' . $user->avatar;
                if (Storage::disk('local')->exists($oldPath)) {
                    Storage::disk('local')->delete($oldPath);
                }
            }

            // Ensure avatars directory exists
            $avatarsDir = 'public/avatars';
            if (!Storage::disk('local')->exists($avatarsDir)) {
                Storage::disk('local')->makeDirectory($avatarsDir, 0755, true);
            }

            // Get file extension
            $extension = $this->avatar->getClientOriginalExtension();
            if (empty($extension)) {
                $extension = $this->avatar->guessExtension() ?? 'jpg';
            }

            // Store new avatar
            $filename = 'avatars/' . $user->id . '_' . time() . '_' . Str::random(10) . '.' . $extension;
            $storedPath = $this->avatar->storeAs('public', $filename);
            
            if (!$storedPath) {
                throw new \Exception('Failed to store the file. Please check storage permissions.');
            }
            
            // Update user avatar path (remove 'public/' prefix for storage URL)
            $avatarPath = str_replace('public/', '', $storedPath);
            $user->update(['avatar' => $avatarPath]);

            // Refresh user data and preview
            $user->refresh();
            $this->loadUserData();
            $this->avatar = null;

            session()->flash('message', 'Profile photo uploaded successfully!');
            $this->dispatch('avatar-updated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Avatar upload error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            $this->addError('avatar', 'Failed to upload profile photo: ' . $e->getMessage());
            session()->flash('error', 'Failed to upload profile photo: ' . $e->getMessage());
        }
    }

    public function removeAvatar()
    {
        try {
            $user = Auth::user();
            
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            $user->update(['avatar' => null]);
            $this->avatarPreview = null;
            $this->avatar = null;

            session()->flash('message', 'Profile photo removed successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to remove profile photo. Please try again.');
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken.',
        ]);

        try {
            Auth::user()->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            // Refresh user data
            Auth::user()->refresh();
            $this->loadUserData();

            session()->flash('message', 'Profile updated successfully!');
            $this->dispatch('profile-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update profile. Please try again.');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:8',
            'newPasswordConfirmation' => 'required|same:newPassword',
        ], [
            'currentPassword.required' => 'Please enter your current password.',
            'newPassword.required' => 'Please enter a new password.',
            'newPassword.min' => 'The new password must be at least 8 characters.',
            'newPasswordConfirmation.required' => 'Please confirm your new password.',
            'newPasswordConfirmation.same' => 'The new password confirmation does not match.',
        ]);

        if (!Hash::check($this->currentPassword, Auth::user()->password)) {
            $this->addError('currentPassword', 'The current password is incorrect.');
            return;
        }

        try {
            Auth::user()->update([
                'password' => Hash::make($this->newPassword),
            ]);

            $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation']);
            session()->flash('message', 'Password updated successfully!');
            $this->dispatch('password-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update password. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
