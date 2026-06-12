@php
    $projects = [
        'audio-archive' => [
            'url' => 'https://audio-archive.app',
            'image' => 'audio-archive.png',
            'title' => 'Audio Archive',
            'description' => 'Organize, stream, and enjoy your personal music collection from anywhere',
            'color' => 'group-hover:text-[#FFB900]',
            'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
        ],
        'pure-finance' => [
            'url' => 'https://pure-finance.app',
            'image' => 'pure-finance.png',
            'title' => 'Pure Finance',
            'description' => 'A distraction-free way to track finances and understand where your money goes',
            'color' => 'group-hover:text-[#06D492]',
            'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
        ],
        'movie-vault' => [
            'url' => 'https://movie-vault.app',
            'image' => 'movie-vault.png',
            'title' => 'Movie Vault',
            'description' => 'Catalog your movie and TV collection while keeping a wishlist for future additions',
            'color' => 'group-hover:text-[#3073E8]',
            'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
        ],
    ];
@endphp

<div id="projects" class="mt-24 mb-4 sm:mt-32 text-zinc-50 scroll-mt-24">
    <flux:heading class="w-7/12 leading-9 text-[20px]! font-medium mx-auto mb-8 text-center">
        Projects
    </flux:heading>

    <div class="border-y mx-auto relative border-zinc-600/50">
        <div class="bg-points absolute -z-10 inset-0 opacity-60 mask-radial-to-100% mask-radial-at-center"></div>

        <div class="mx-auto grid grid-cols-1 lg:grid-cols-3">
            @foreach ($projects as $project)
                <div class="flex h-full border-b border-zinc-600/50 p-5 last:border-b-0 lg:border-b-0 lg:border-r lg:last:border-r-0">
                    <a
                        href="{{ $project['url'] }}"
                        target="_blank"
                        class="flex h-full w-full flex-col group"
                    >
                        <div class="flex items-center gap-4">
                            <img
                                class="size-10 rounded object-cover text-zinc-50 shadow-2xl shadow-red-500/20"
                                src="{{ asset($project['image']) }}"
                                alt="{{ $project['title'] }}"
                            />

                            <flux:heading size="lg" class="font-medium text-zinc-50">
                                {{ $project['title'] }}
                            </flux:heading>
                        </div>

                        <flux:heading size="md" class="mt-4 font-medium text-zinc-200!">
                            {{ $project['description'] }}
                        </flux:heading>

                        <div class="mt-4 font-medium flex items-center gap-3">
                            <flux:icon name="link" class="size-4 {{ $project['color'] }} transition-colors" />

                            <p class="text-sm text-zinc-50 {{ $project['color'] }} transition-colors">
                                {{ Str::after($project['url'], 'https://') }}
                            </p>
                        </div>

                        <ul class="mt-auto flex flex-wrap gap-1.5 pt-6">
                            @foreach ($project['technologies'] as $tech)
                                <li
                                    @class([
                                        'bg-[#42C0F8] shadow-[#42C0F8]/15' => $tech === 'Tailwind',
                                        'bg-[#77C1D2] shadow-[#77C1D2]/15' => $tech === 'Alpine.js',
                                        'bg-[#FF2D21] shadow-[#FF2D21]/15' => $tech === 'Laravel',
                                        'bg-[#FB70A9] shadow-[#FB70A9]/15' => $tech === 'Livewire',
                                        'inline-block rounded-md px-2 py-0.5 text-[11px] font-medium text-zinc-50 shadow-md sm:px-1.5 sm:py-[.8px] sm:text-[12.5px]',
                                    ])
                                >
                                    {{ $tech }}
                                </li>
                            @endforeach
                        </ul>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>