@use('App\Services\MovieVaultService', 'MovieVaultService')

<div class="w-full p-4 mx-auto overflow-y-hidden sm:py-8 sm:px-6 lg:px-8 max-w-7xl">
    <div class="flex flex-col justify-between sm:flex-row sm:items-center">
        <div class="flex flex-row items-center space-x-1.5">
            <h1 class="text-2xl font-bold text-slate-800 md:text-3xl dark:text-slate-100">
                My Vault
            </h1>

            <p class="text-2xl font-bold text-slate-800 md:text-3xl dark:text-slate-100">
                (Total: {{ $vault_records->total() }})
            </p>
        </div>

        <div class="flex items-center mt-2 space-x-2 sm:mt-0">
            <flux:button variant="indigo" href="{{ route('movie-vault.wishlist') }}" wire:navigate
                class="w-full sm:w-auto">
                <flux:icon icon="heart" variant="outline" class="w-4 h-4" />

                Wishlist
            </flux:button>

            <flux:button variant="indigo" icon="plus" href="{{ route('movie-vault.explore') }}" wire:navigate
                class="w-full sm:w-auto">
                Add to vault
            </flux:button>
        </div>
    </div>

    @if (count(auth()->user()->vaults->where('on_wishlist', false)) > 0)
        <div class="flex items-center mt-4 space-x-2">
            <div class="relative w-full">
                <x-text-input id="search" wire:model.live.debounce.300ms='search'
                    class="w-full bg-white pl-9 dark:bg-slate-800 placeholder:text-slate-400" type="text"
                    placeholder="Search..." />

                <button class="absolute inset-0 right-auto" type="submit" aria-label="Search">
                    <svg class="ml-3 mr-2 fill-current text-slate-400 shrink-0 dark:text-slate-500" width="16"
                        height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                        <path
                            d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                    </svg>
                </button>

                <button x-cloak x-show="$wire.search.length > 0" wire:click="$set('search', '')"
                    class="absolute inset-0 left-auto pr-2" type="submit" aria-label="Search">
                    <x-heroicon-s-x-mark
                        class="w-5 h-5 duration-200 ease-in-out text-slate-500 hover:text-slate-600 dark:hover:text-slate-400" />
                </button>
            </div>

            <x-movie-vault.filters :$ratings :$genres />
        </div>
    @endif

    <div wire:loading.remove wire:target='search,type,selected_ratings,selected_genres,sort_direction'>
        <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($vault_records as $vault)
                <x-mary-card shadow
                    class="duration-200 ease-in-out border text-slate-800 dark:bg-slate-800 border-slate-200 dark:border-slate-700 bg-slate-50 dark:text-slate-50"
                    wire:key='{{ $vault->id }}'>
                    <div class="-mx-1 -my-3">
                        <h1 class="text-xl font-bold truncate whitespace-nowrap">
                            {{ $vault->original_title }}
                        </h1>

                        <h3>
                            {{ $vault->release_date ? 'Release Date: ' : 'First Air Date: ' }}

                            {{ MovieVaultService::formatDate($vault->release_date ?? $vault->first_air_date) }}
                        </h3>

                        <p class="truncate">
                            Genres: {{ Str::replace(',', ', ', $vault->genres) }}
                        </p>

                        <p>
                            Rating: {{ $vault->rating }}

                            @isset($vault->imdb_id)
                                -

                                <a class="text-sm font-medium text-indigo-500 duration-200 ease-in-out hover:text-indigo-600 dark:hover:text-indigo-400"
                                    href="https://www.imdb.com/title/{{ $vault->imdb_id }}/parentalguide" target="_blank">
                                    <span class="inline-flex items-center">
                                        View parents guide

                                        <x-heroicon-s-arrow-up-right class="w-3 h-3 ml-0.5" />
                                    </span>
                                </a>
                            @endisset
                        </p>

                        @isset($vault->runtime)
                            <p>
                                Length:

                                {{ MovieVaultService::formatRuntime($vault->runtime) }}
                            </p>
                        @endisset

                        @isset($vault->seasons)
                            <p>
                                Seasons:

                                {{ $vault->seasons }}
                            </p>
                        @endisset

                        <p class="truncate">
                            Actors:

                            {{ Str::replace(',', ', ', $vault->actors) ?: 'No actors found' }}
                        </p>

                        <div class="flex items-center justify-between w-full">
                            <a class="text-sm font-medium text-indigo-500 duration-200 ease-in-out hover:text-indigo-600 dark:hover:text-indigo-400"
                                href="{{ route('movie-vault.details', $vault->id) }}" wire:navigate>
                                View all details &rarr;
                            </a>

                            <div class="flex items-center -mr-2">
                                <x-modal icon="information-circle" info variant="indigo"
                                    wire:submit="addToWishlist({{ $vault->id }})">
                                    <x-slot:button>
                                        <x-heroicon-s-plus-small
                                            class="w-6 h-6 duration-200 ease-in-out rounded-md hover:bg-slate-200 dark:hover:bg-slate-700" />
                                    </x-slot:button>

                                    <x-slot:title>
                                        Add to wishlist
                                    </x-slot:title>

                                    <x-slot:body>
                                        <div>
                                            Are you sure you want to add

                                            <span class="font-semibold text-indigo-500">
                                                '{{ $vault->title }}'
                                            </span>

                                            to your wishlist?
                                        </div>
                                    </x-slot:body>
                                </x-modal>

                                <x-modal icon="information-circle" delete variant="danger"
                                    wire:submit="delete({{ $vault->id }})">
                                    <x-slot:button>
                                        <x-heroicon-o-trash
                                            class="p-1 text-red-500 duration-100 ease-in-out rounded-md w-7 h-7 hover:bg-slate-200 dark:hover:bg-slate-700" />
                                    </x-slot:button>

                                    <x-slot:title>
                                        Remove from vault
                                    </x-slot:title>

                                    <x-slot:body>
                                        <div>
                                            Are you sure you want to remove

                                            <span class="font-semibold text-red-500">
                                                '{{ $vault->title }}'
                                            </span>

                                            from your vault?
                                        </div>
                                    </x-slot:body>
                                </x-modal>
                            </div>
                        </div>
                    </div>

                    <x-slot:figure>
                        <a href="{{ route('movie-vault.details', $vault->id) }}" wire:navigate class="w-full">
                            <img class="h-[300px] w-full object-cover"
                                src="{{ 'https://image.tmdb.org/t/p/w500/' . $vault->poster_path ?? $vault->backdrop_path . '?include_adult=false&language=en-US&page=1' }}"
                                alt="{{ $vault->original_title }}" />
                        </a>
                    </x-slot:figure>
                </x-mary-card>
            @empty
                <div class="col-span-3 mx-auto mt-6 text-center">
                    <h1 class="text-lg font-semibold text-slate-500">
                        Search movies or TV shows from the

                        <a class="-mr-1 font-medium text-indigo-500 duration-200 ease-in-out hover:text-indigo-600 dark:hover:text-indigo-400"
                            href="{{ route('movie-vault.explore', $search ?: null) }}" wire:navigate>
                            Explore page
                        </a>.
                    </h1>
                </div>
            @endforelse
        </div>

        <div class="pt-4">
            {{ $vault_records->links() }}
        </div>
    </div>

    <div class="flex justify-center mt-6" wire:loading.flex
        wire:target='search,type,selected_ratings,selected_genres,sort_direction'>
        <x-large-loading-spinner />
    </div>
</div>
