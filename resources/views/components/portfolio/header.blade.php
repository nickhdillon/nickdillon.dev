<div class="fixed w-full z-10 px-3.5 py-3 sm:py-3.5 border-b sm:px-10 border-zinc-700 backdrop-blur-2xl text-zinc-50">
    <nav class="flex items-center justify-between mx-auto xl:max-w-5xl">
        <a href="{{ route('portfolio') }}" wire:navigate>
            <img src="{{ asset('logo.svg') }}" class="w-10 duration-300 ease-in-out hover:scale-110" />
        </a>

        @livewire('portfolio.socials')
    </nav>
</div>
