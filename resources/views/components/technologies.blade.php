@php
    $technologies = collect([
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
    ]);
@endphp

<div id="stack" class="mt-32 sm:mt-40 text-zinc-50 scroll-mt-24">
    <flux:heading class="w-9/12 leading-9 mx-auto text-[20px]! font-medium text-center mb-7">
        Stack
    </flux:heading>

    <div class="mx-auto border-y border-zinc-600">
        <div class="md:hidden">
            @foreach ($technologies->chunk(2) as $row)
                <div class="flex border-b border-zinc-600 last:border-b-0">
                    @foreach ($row as $technology)
                        <div class="flex-1 border-r border-zinc-600 last:border-r-0">
                            <div class="mx-auto w-44 px-4 py-5 transition hover:scale-110">
                                <a href="{{ $technology['url'] }}" target="_blank">
                                    <div class="mb-2 flex justify-center">
                                        <img src="{{ asset($technology['image']) }}" />
                                    </div>

                                    <h1 class="text-center text-lg font-medium">
                                        {{ $technology['title'] }}
                                    </h1>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="hidden md:block">
            @foreach ($technologies->chunk(4) as $row)
                <div class="flex border-b border-zinc-600 last:border-b-0">
                    @foreach ($row as $technology)
                        <div class="flex-1 border-r border-zinc-600 last:border-r-0">
                            <div class="mx-auto w-44 px-4 py-6 transition hover:scale-110">
                                <a href="{{ $technology['url'] }}" target="_blank">
                                    <div class="mb-2 flex justify-center">
                                        <img src="{{ asset($technology['image']) }}" />
                                    </div>

                                    <h1 class="text-center text-lg font-medium">
                                        {{ $technology['title'] }}
                                    </h1>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>