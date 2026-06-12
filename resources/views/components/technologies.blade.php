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

<div id="stack" class="mt-32 sm:mt-40 text-zinc-50 scroll-mt-24">
    <flux:heading class="w-9/12 leading-9 text-[20px]! font-medium mx-auto text-center">
        Stack
    </flux:heading>

    <div class="border-y bg-grid mx-auto border-zinc-600/50 mt-10 p-4">
        <div class="z-10 grid grid-cols-2 md:grid-cols-4 gap-4 w-full md:w-9/12 mx-auto">
            @foreach ($technologies as $technology)
                <div class="w-full p-4 max-w-56 mx-auto transition hover:scale-110">
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
</div>