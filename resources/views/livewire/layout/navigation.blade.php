<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav
    class="sticky top-0 z-30 w-full transition-all duration-200 ease-in-out bg-white border-b border-slate-200 dark:bg-slate-800 dark:border-slate-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Hamburger button -->
                <button @click.stop="sidebarOpen = !sidebarOpen" :aria-expanded="sidebarOpen" aria-controls="sidebar"
                    class="text-slate-500 hover:text-slate-600 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect height="2" width="16" x="4" y="5" />
                        <rect height="2" width="16" x="4" y="11" />
                        <rect height="2" width="16" x="4" y="17" />
                    </svg>
                </button>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center ms-6">
                <x-mary-theme-toggle
                    class="p-3 transition-all duration-200 ease-in-out rounded-full btn-ghost hover:text-slate-700 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-500 dark:hover:text-slate-200" />

                @if (!auth()->user())
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Login
                </a>
                @else
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out bg-white border border-transparent rounded-md text-slate-500 dark:text-slate-400 dark:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-300 focus:outline-none">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (request()->routeIs('pure-finance.*'))
                        <x-dropdown-link :href="route('pure-finance.categories')" wire:navigate>
                            <div class="flex items-center">
                                <flux:icon.squares-2x2 class="mr-1.5 !-ml-0.5 !h-5 !w-5" />
                                {{ __('Categories') }}
                            </div>
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('pure-finance.tags')" wire:navigate>
                            <div class="flex items-center">
                                <flux:icon.tags class="mr-1.5 !-ml-0.5 !h-5 !w-5 !stroke-[1.5px]" />
                                {{ __('Tags') }}
                            </div>
                        </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            <div class="flex items-center">
                                <flux:icon.user-circle class="mr-1.5 !-ml-0.5 !h-5 !w-5" />
                                {{ __('Profile') }}
                            </div>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                <div class="flex items-center">
                                    <flux:icon.arrow-left-start-on-rectangle class="mr-1.5 !-ml-0.5 !h-5 !w-5" />
                                    {{ __('Log Out') }}
                                </div>
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
                @endif
            </div>
        </div>
    </div>
</nav>