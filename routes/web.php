<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\TaskManager;
use App\Livewire\ListManager;
use App\Livewire\Profile;
use App\Livewire\Calendar;

// Public welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', TaskManager::class)->name('dashboard');
    Route::get('/calendar', Calendar::class)->name('calendar');
    Route::get('/tasks/{list?}', TaskManager::class)->name('tasks');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/lists', ListManager::class)->name('lists');
});

require __DIR__ . '/auth.php';
