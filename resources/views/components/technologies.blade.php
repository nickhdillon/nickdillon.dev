@php
    $technologies = [
        [
            'url' => 'https://tailwindcss.com',
            'image' => 'tailwindcss.svg',
            'title' => 'Tailwind CSS',
        ],
        [
            'url' => 'https://alpinejs.dev/',
            'image' => 'alpinejs.svg',
            'title' => 'Alpine.js',
        ],
        [
            'url' => 'https://laravel.com',
            'image' => 'laravel.svg',
            'title' => 'Laravel',
        ],
        [
            'url' => 'https://livewire.laravel.com/',
            'image' => 'livewire.svg',
            'title' => 'Livewire',
        ],
        [
            'url' => 'https://vuejs.org/',
            'image' => 'vue.svg',
            'title' => 'Vue.js',
        ],
        [
            'url' => 'https://inertiajs.com/',
            'image' => 'inertia.svg',
            'title' => 'Inertia.js',
        ],
        [
            'url' => 'https://www.typescriptlang.org/',
            'image' => 'typescript.svg',
            'title' => 'TypeScript',
        ],
        [
            'url' => 'https://www.docker.com/',
            'image' => 'docker.svg',
            'title' => 'Docker',
        ],
    ];
@endphp

<div class="flex flex-col items-center justify-center mt-32 sm:mt-40 text-zinc-50">
    <flux:heading class="w-9/12 mb-3 leading-9 text-[24px]! font-medium text-center">
        Stack:
    </flux:heading>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-10 max-w-5xl">
        @foreach ($technologies as $technology)
            <div class="p-2 w-40 mx-auto transition hover:scale-110">
                <a href="{{ $technology['url'] }}" target="_blank">
                    <div class="flex justify-center mb-2">
                        <img src="{{ asset($technology['image']) }}" />
                    </div>

                    <h1 class="text-lg font-medium text-center">
                        {{ $technology['title'] }}
                    </h1>
                </a>
            </div>
        @endforeach
    </div>
</div>