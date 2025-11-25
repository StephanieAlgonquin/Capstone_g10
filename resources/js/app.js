import './bootstrap';
import Sortable from 'sortablejs';

function initSortables() {
    // Lists container
    const listsContainer = document.getElementById('lists-container');
    if (listsContainer && !listsContainer.sortableInstance) {
        listsContainer.sortableInstance = Sortable.create(listsContainer, {
            animation: 150,
            ghostClass: 'opacity-50',
            chosenClass: 'shadow-lg',
            onEnd: function (evt) {
                const ordered = Array.from(listsContainer.querySelectorAll('.list-card[data-id]')).map(el => parseInt(el.getAttribute('data-id')));
                if (window.Livewire) {
                    Livewire.dispatch('reorderLists', { orderedIds: ordered });
                }
            }
        });
    }

    // Tasks containers (one per list)
    document.querySelectorAll('.tasks-list').forEach(container => {
        if (!container.sortableInstance) {
            container.sortableInstance = Sortable.create(container, {
                animation: 120,
                ghostClass: 'opacity-50',
                chosenClass: 'shadow-md',
                onEnd: function (evt) {
                    const listId = container.getAttribute('data-list-id');
                    const ordered = Array.from(container.querySelectorAll('.task-item[data-id]')).map(el => parseInt(el.getAttribute('data-id')));
                    if (window.Livewire && listId) {
                        Livewire.dispatch('reorderTasks', { listId: parseInt(listId), orderedIds: ordered });
                    }
                }
            });
        }
    });
}

function destroySortables() {
    const listsContainer = document.getElementById('lists-container');
    if (listsContainer && listsContainer.sortableInstance) {
        listsContainer.sortableInstance.destroy();
        listsContainer.sortableInstance = null;
    }

    document.querySelectorAll('.tasks-list').forEach(container => {
        if (container.sortableInstance) {
            container.sortableInstance.destroy();
            container.sortableInstance = null;
        }
    });
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl+K or Cmd+K for search
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('input[wire\\:model*="searchQuery"]');
        if (searchInput) {
            searchInput.focus();
            searchInput.select();
        }
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('[class*="fixed"][class*="inset-0"]');
        modals.forEach(modal => {
            if (modal.style.display !== 'none') {
                const closeBtn = modal.querySelector('button[wire\\:click*="close"], button[wire\\:click*="cancel"]');
                if (closeBtn) closeBtn.click();
            }
        });
    }
});

window.addEventListener('DOMContentLoaded', () => {
    initSortables();
});

// Re-initialize after Livewire updates
if (window.Livewire) {
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            destroySortables();
            setTimeout(() => {
                initSortables();
            }, 100);
        });
    });
}
