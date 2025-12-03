<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Your Lists</h3>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click="cancelDelete">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4" wire:click.stop>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Delete List</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete "<strong>{{ $deleteListName }}</strong>"? This will also delete all tasks in this list. This action cannot be undone.</p>
            <div class="flex gap-3 justify-end">
                <button wire:click="cancelDelete" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>
                <button wire:click="confirmDeleteList" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Create New List Form -->
    <form wire:submit="createList" class="space-y-4 mb-6 p-4 bg-gray-50 rounded-lg">
        <div>
            <label for="listName" class="block text-sm font-medium text-gray-700 mb-1">List Name</label>
            <input type="text" id="listName" wire:model="listName" placeholder="My new list..."
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#D96846] focus:border-[#D96846]">
            @error('listName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="listColor" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
            <div class="flex gap-2 flex-wrap">
                @foreach(['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'] as $color)
                <label class="cursor-pointer">
                    <input type="radio" wire:model="listColor" value="{{ $color }}" class="hidden">
                    <div class="w-8 h-8 rounded-full border-2" style="background-color: {{ $color }}; border-color: {{ $listColor === $color ? 'black' : 'lightgray' }};"></div>
                </label>
                @endforeach
            </div>
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="createList" class="w-full bg-[#D96846] hover:bg-[#c55a38] disabled:opacity-50 disabled:cursor-not-allowed text-white font-medium py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
            <span wire:loading.remove wire:target="createList">Create List</span>
            <span wire:loading wire:target="createList" class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Creating...
            </span>
        </button>
    </form>

    <!-- Lists Display -->
    <div class="space-y-2">
        @forelse(Auth::user()->lists()->orderBy('order_position')->get() as $list)
        @if($editingListId === $list->id)
        <!-- Edit Form -->
        <div class="p-3 bg-gray-50 rounded-lg border-l-4" style="border-color: {{ $list->color }}">
            <input type="text" wire:model="editingName" placeholder="List name"
                class="w-full px-2 py-1 mb-2 border border-gray-300 rounded text-sm">
            <div class="flex gap-1 mb-2 flex-wrap">
                @foreach(['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'] as $color)
                <label class="cursor-pointer">
                    <input type="radio" wire:model="editingColor" value="{{ $color }}" class="hidden">
                    <div class="w-6 h-6 rounded-full border-2" style="background-color: {{ $color }}; border-color: {{ $editingColor === $color ? 'black' : 'lightgray' }};"></div>
                </label>
                @endforeach
            </div>
            <div class="flex gap-2">
                <button wire:click="updateList" wire:loading.attr="disabled" wire:target="updateList" class="flex-1 bg-green-600 disabled:opacity-50 text-white text-xs py-1 rounded hover:bg-green-700 flex items-center justify-center gap-1">
                    <span wire:loading.remove wire:target="updateList">Save</span>
                    <span wire:loading wire:target="updateList">
                        <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
                <button wire:click="cancelEdit" class="flex-1 bg-gray-400 text-white text-xs py-1 rounded hover:bg-gray-500">Cancel</button>
            </div>
        </div>
        @else
        <!-- Display List -->
        <div wire:navigate href="{{ route('tasks', $list->id) }}" class="p-3 rounded-lg border-l-4 cursor-pointer hover:bg-gray-50 transition flex justify-between items-center" style="border-color: {{ $list->color }}; background-color: {{ $list->color }}08">
            <span class="font-medium text-gray-900">{{ $list->name }}</span>
            <div class="flex gap-1">
                <button wire:click.stop="editList({{ $list->id }})" class="text-gray-400 hover:text-[#D96846]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
                <button wire:click.stop="$dispatch('open-delete-list-modal', {id: {{ $list->id }}, name: '{{ $list->name }}'})" class="text-gray-400 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>
        @endif
        @empty
        <p class="text-gray-500 text-sm text-center py-4">No lists yet</p>
        @endforelse
    </div>
</div>