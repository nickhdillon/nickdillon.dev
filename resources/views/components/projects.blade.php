@php
    $projects = [
        'audio-archive' => [
            'url' => 'https://audio-archive.app',
            'image' => 'audio-archive.png',
            'title' => 'Audio Archive',
            'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
        ],
        'pure-finance' => [
            'url' => 'https://pure-finance.app',
            'image' => 'pure-finance.png',
            'title' => 'Pure Finance',
            'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
        ],
        'movie-vault' => [
            'url' => 'https://movie-vault.app',
            'image' => 'movie-vault.png',
            'title' => 'Movie Vault',
            'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
        ],
    ];
@endphp

<div id="projects" class="mt-24 mb-4 sm:mt-32 text-zinc-50 scroll-mt-24">
    <flux:heading class="w-7/12 leading-9 text-[20px]! font-medium mx-auto mb-8 text-center">
        Projects
    </flux:heading>

    <div class="border-y mx-auto border-zinc-600">
        <div class="mx-auto grid grid-cols-1 lg:grid-cols-3">
            @foreach ($projects as $project)
                <div class="border-b border-zinc-600 p-6 last:border-b-0 lg:border-b-0 lg:border-r lg:last:border-r-0">
                    <a
                        href="{{ $project['url'] }}"
                        target="_blank"
                    >
                        <img
                            class="h-48 w-full object-cover shadow-2xl shadow-red-500/20 text-zinc-50 sm:h-56"
                            src="{{ asset($project['image']) }}"
                        />

                        <div class="space-y-1 pt-4">
                            <flux:heading size="lg" class="font-medium text-zinc-50">
                                {{ $project['title'] }}
                            </flux:heading>

                            <ul class="flex flex-wrap gap-1.5">
                                @foreach ($project['technologies'] as $tech)
                                    <li class="inline-block rounded-md bg-red-500 px-2 py-0.5 text-[10px] font-medium text-zinc-50 shadow-md shadow-red-500/15 sm:px-1.5 sm:py-[.8px] sm:text-[12.5px]">
                                        {{ $tech }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>