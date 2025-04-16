@php
    $technologies = [
        'tallStack' => [
            'tailwindcss' => [
                'url' => 'https://tailwindcss.com',
                'image' => 'tailwindcss.svg',
                'title' => 'Tailwind CSS',
            ],
            'alpinejs' => [
                'url' => 'https://alpinejs.dev/',
                'image' => 'alpinejs.svg',
                'title' => 'Alpine.js',
            ],
            'laravel' => [
                'url' => 'https://laravel.com',
                'image' => 'laravel.svg',
                'title' => 'Laravel',
            ],
            'livewire' => [
                'url' => 'https://livewire.laravel.com/',
                'image' => 'livewire.svg',
                'title' => 'Livewire',
            ],
        ],
        'other' => [
            'filament' => [
                'url' => 'https://filamentphp.com/',
                'image' => 'filament-logo.svg',
                'title' => 'Filament',
            ],
            'vuejs' => [
                'url' => 'https://vuejs.org/',
                'image' => 'vue.svg',
                'title' => 'Vue.js',
            ],
            'inertiajs' => [
                'url' => 'https://inertiajs.com/',
                'image' => 'inertia.svg',
                'title' => 'Inertia.js',
            ],
            'docker' => [
                'url' => 'https://www.docker.com/',
                'image' => 'docker.svg',
                'title' => 'Docker',
            ],
        ],
    ];
@endphp

<div class="flex flex-col items-center justify-center mt-32 sm:mt-40 text-zince-50">
    <flux:heading class="w-9/12 mb-3 leading-9 !text-[30px] font-medium text-center">
        My favorite technologies:
    </flux:heading>

    <div class="p-4 space-y-8 md:space-y-12">
        @foreach ($technologies as $stack => $items)
            <div class="grid grid-cols-2 gap-8 md:flex md:justify-center md:space-x-2 flex:space-y-4 md:space-y-0">
                @foreach ($items as $technology)
                    <div
                        class="p-2 duration-200 text-zinc-50 hover:ease-in-out hover:scale-110 w-36">
                        <a href="{{ $technology['url'] }}" target="_blank">
                            <div class="flex justify-center mb-1 5">
                                <img src="{{ asset($technology['image']) }}" />
                            </div>

                            <div class="text-center">
                                <h1 class="text-xl font-medium shadow-indigo-400/50">
                                    {{ $technology['title'] }}
                                </h1>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>