<div>
<div class="min-h-screen bg-[#1A1B23] text-white flex">
    <!-- Sidebar -->
    <aside class="w-20 bg-[#252732] flex flex-col items-center py-6 border-r border-[#3A3B47]">
        <a href="{{ route('dashboard') }}" class="mb-8 p-3 bg-blue-600 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
        </a>

        <a href="{{ route('profile') }}" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Settings">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>
        <div class="mt-auto">
            <button class="p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Dark Mode">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-[#1A1B23] border-b border-[#3A3B47] px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <button wire:click="previousMonth" class="p-2 text-gray-400 hover:text-white hover:bg-[#252732] rounded transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button wire:click="nextMonth" class="p-2 text-gray-400 hover:text-white hover:bg-[#252732] rounded transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <button wire:click="goToToday" class="px-4 py-2 text-gray-300 border border-[#3A3B47] rounded hover:bg-[#252732] transition-colors text-sm">
                        Today
                    </button>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-300 hover:text-white hover:bg-[#252732] rounded transition-colors text-sm">
                        Dashboard
                    </a>
                </div>
            </div>
        </header>

        <!-- Calendar Content -->
        <main class="flex-1 overflow-auto bg-[#1A1B23] p-8">
            <div class="max-w-6xl mx-auto">
                <!-- Header Text -->
                <div class="text-center mb-6">
                    <p class="text-sm text-gray-400 uppercase tracking-wider mb-2">PRINTABLE AND FILLABLE</p>
                    <h1 class="text-3xl font-light text-white mb-2">{{ $currentYear }} CALENDAR</h1>
                </div>

                <!-- Calendar Grid -->
                <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg overflow-hidden">
                    <!-- Month Header -->
                    <div class="bg-[#252732] border-b border-[#3A3B47] px-6 py-4">
                        <h2 class="text-2xl font-semibold text-white uppercase tracking-wide">{{ $monthName }}</h2>
                    </div>

                    <!-- Day Headers (Monday to Sunday) -->
                    <div class="grid grid-cols-7 border-b border-[#3A3B47] bg-[#252732]">
                        @foreach(['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'] as $day)
                        <div class="px-4 py-3 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider border-r border-[#3A3B47] last:border-r-0">
                            {{ $day }}
                        </div>
                        @endforeach
                    </div>

                    <!-- Calendar Days Grid -->
                    <div class="grid grid-cols-7">
                        @foreach($days as $dayData)
                        <div class="min-h-[120px] p-3 border-r border-b border-[#3A3B47] last:border-r-0 bg-[#2D2E3A] hover:bg-[#353642] transition-colors">
                            @if($dayData === null)
                                <div class="text-gray-600 text-sm"></div>
                            @else
                                <div class="mb-2">
                                    <span class="text-lg font-medium {{ $dayData['isToday'] ? 'text-white bg-purple-600 rounded-full w-8 h-8 flex items-center justify-center' : 'text-gray-300' }}">
                                        {{ $dayData['day'] }}
                                    </span>
                                </div>
                                @if(count($dayData['tasks']) > 0)
                                <div class="space-y-1">
                                    @foreach(array_slice($dayData['tasks'], 0, 3) as $task)
                                    <div class="text-xs text-gray-400 truncate px-1 py-0.5 rounded
                                        {{ $task->priority === 'high' ? 'bg-red-500/20 text-red-300' : ($task->priority === 'medium' ? 'bg-yellow-500/20 text-yellow-300' : 'bg-green-500/20 text-green-300') }}">
                                        {{ $task->title }}
                                    </div>
                                    @endforeach
                                    @if(count($dayData['tasks']) > 3)
                                    <div class="text-xs text-gray-500 px-1">
                                        +{{ count($dayData['tasks']) - 3 }} more
                                    </div>
                                    @endif
                                </div>
                                @endif
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Text -->
                <div class="text-center mt-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">MONDAY & SUNDAY START | LETTER SIZE & A4</p>
                </div>
            </div>
        </main>
    </div>
</div>
</div>
