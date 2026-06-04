<div
    x-data="{ active: '', menuOpen: false }"
    class="sticky top-4 sm:top-5 w-11/12 max-w-6xl mx-auto shadow-lg z-10 p-3 sm:p-4 border border-white/15 backdrop-blur-md text-zinc-50"
>
    <nav class="flex items-center justify-between">
        <a href="{{ route('home') }}" wire:navigate>
            <img src="{{ asset('logo.svg') }}" class="w-10 duration-300 ease-in-out hover:scale-110" />
        </a>

        <div class="hidden sm:flex items-center gap-6">
            <x-nav-link name="experience" />

            <x-nav-link name="stack" />

            <x-nav-link name="projects" />
        </div>

       <div class="relative flex sm:hidden">
            <button
                type="button"
                class="flex items-center justify-center"
                x-on:click="menuOpen = ! menuOpen"
            >
                <flux:icon name="bars-3" class="size-5" />
            </button>

            <div
                x-cloak
                x-show="menuOpen"
                x-transition
                x-on:click="menuOpen = false"
                x-on:click.outside="menuOpen = false"
                x-on:scroll.window="menuOpen = false"
                class="absolute right-0 top-full mt-1.5 z-50 flex w-50 flex-col divide-y divide-zinc-600 border border-zinc-600 bg-zinc-700 [&>a]:w-full [&>a]:p-2.5"
            >
                <x-nav-link name="experience" />

                <x-nav-link name="stack" />

                <x-nav-link name="projects" />
            </div>
        </div>
    </nav>
</div>