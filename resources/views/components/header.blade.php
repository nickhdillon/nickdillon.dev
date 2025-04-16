<div class="sticky top-5 w-11/12 max-w-6xl mx-auto shadow-lg z-10 p-3 sm:p-4 border rounded-[12px] border-white/15 backdrop-blur-md text-zinc-50">
    <nav class="flex items-center justify-between">
        <a href="{{ route('home') }}" wire:navigate>
            <img src="{{ asset('logo.svg') }}" class="w-10 duration-300 ease-in-out hover:scale-110" />
        </a>

        <x-socials />
    </nav>
</div>