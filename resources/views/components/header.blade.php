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

        <flux:dropdown class="sm:hidden flex items-center">
            <button>
                <flux:icon name="bars-3" class="stroke-white!" />
            </button>

            <flux:menu>
                <flux:menu.item>
                    <x-nav-link name="experience" />
                </flux:menu.item>

                <flux:menu.separator />

                <flux:menu.item>
                    <x-nav-link name="stack" />
                </flux:menu.item>

                <flux:menu.separator />

                <flux:menu.item>
                    <x-nav-link name="projects" />
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </nav>
</div>