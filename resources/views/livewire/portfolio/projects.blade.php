<?php

declare(strict_types=1);

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'projects' => [
                'pure-finance' => [
                    'url' => route('pure-finance.index'),
                    'image' => 'pure-finance.png',
                    'title' => 'Pure Finance',
                    'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
                ],
                'movie-vault' => [
                    'url' => route('movie-vault.my-vault'),
                    'image' => 'movie-vault.png',
                    'title' => 'Movie Vault',
                    'technologies' => ['Tailwind', 'Alpine.js', 'Laravel', 'Livewire'],
                ],
            ],
        ];
    }
}; ?>

<div class="flex flex-col items-center justify-center p-4 mt-24 mb-4 sm:mt-32 text-zinc-50">
    <flux:heading class="w-7/12 !text-[32px] font-semibold mx-auto mb-8 text-center">
        A couple of my projects:
    </flux:heading>

    <div class="flex flex-col px-3 space-y-8 sm:space-y-0 sm:space-x-8 sm:flex-row text-zinc-800">
        @foreach ($projects as $project)
        <a href="{{ $project['url'] }}"
            class="max-w-sm duration-200 ease-in-out border rounded-[12px] p-[4px] shadow-xl bg-zinc-800 border-zinc-700 hover:shadow-amber-500/20 hover:scale-105">
            <div>
                <img class="object-cover w-full h-48 border rounded-[8px] border-zinc-700 inset-shadow-lg text-zinc-50 bg-zinc-900 sm:h-56"
                    src="{{ asset($project['image']) }}" />

                <div class="p-4 -mt-1 space-y-1">
                    <flux:heading size="xl" class="font-semibold text-zinc-50">
                        {{ $project['title'] }}
                    </flux:heading>

                    <ul>
                        @foreach ($project['technologies'] as $tech)
                        <li
                            class="inline-block px-2 sm:px-2.5 py-0.5 sm:py-[.8px] mr-1 text-[12.5px] sm:text-sm font-semibold text-zinc-50 bg-[#ff9b3e] rounded-md shadow-md shadow-amber-500/15">
                            {{ $tech }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>