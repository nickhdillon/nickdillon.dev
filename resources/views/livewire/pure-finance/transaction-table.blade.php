@use('App\Enums\PureFinance\TransactionType', 'TransactionType')

<div x-on:account-saved.window="$wire.$refresh" class="flex flex-col gap-2.5 sm:pt-5 sm:gap-3">
    <div class="flex flex-row items-center justify-between w-full gap-2">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-200">
            Transactions
        </h1>

        @if (auth()->user()->accounts()->count() > 0)
            <flux:button
                href="{{ $account ? route('pure-finance.account.transaction-form', $account->id) : route('pure-finance.transaction-form') }}"
                wire:navigate variant="indigo" size="sm" class="!h-7 sm:!h-8">
                <x-heroicon-o-plus class="w-4 h-4" />

                <span class="hidden sm:block">New Transaction</span>

                <span class="block sm:hidden">Add</span>
            </flux:button>
        @endif
    </div>

    <div
        class="bg-white border shadow-sm rounded-xl border-slate-200 dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-200">
        <div
            class="flex gap-2 sm:border-b border-slate-200 dark:border-slate-600 sm:flex-row justify-between items-center sm:px-5 px-3.5 py-3.5">
            <x-pure-finance.status-tabs :$transactions :$cleared_total :$pending_total />

            <div class="flex items-center w-full sm:w-auto justify-between -mr-1.5 space-x-1">
                <div class="relative block w-full pr-2 sm:w-64">
                    <label for="search" class="sr-only">
                        Search
                    </label>

                    <input type="text" wire:model.live.debounce.300ms='search' name="search" id="search"
                        autofocus
                        class="block w-full px-3 py-1.5 sm:text-sm rounded-lg shadow-sm border-slate-300 ps-9 focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-slate-700 dark:text-slate-400 dark:placeholder-slate-500 dark:focus:ring-indigo-600"
                        placeholder="Search transactions..." />

                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="text-slate-400 size-4 dark:text-slate-500" xmlns="<http://www.w3.org/2000/svg>"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </div>

                    <button x-cloak x-show="$wire.search.length > 0" wire:click="$set('search', '')"
                        class="absolute inset-0 left-auto pr-4" type="submit" aria-label="Search">
                        <x-heroicon-s-x-mark
                            class="w-6 h-6 p-0.5 text-rose-500 duration-200 ease-in-out rounded-md hover:bg-slate-200 dark:hover:bg-slate-700" />
                    </button>
                </div>

                <x-pure-finance.filters :$account :$accounts :$categories />

                <x-pure-finance.columns :$columns />
            </div>
        </div>

        <div class="border-t sm:hidden border-slate-200 dark:border-slate-600">
            <div class="flex flex-col divide-y divide-slate-200 dark:divide-slate-600">
                @forelse ($transactions as $transaction)
                    <x-pure-finance.transaction :$transaction />
                @empty
                    <div
                        class="p-2.5 text-sm italic font-medium text-center text-slate-800 whitespace-nowrap dark:text-slate-200">
                        No transactions found...
                    </div>
                @endforelse
            </div>
        </div>

        <div class="hidden overflow-x-auto sm:block">
            <table class="w-full divide-y table-auto divide-slate-200 dark:divide-slate-600">
                <div x-cloak x-show="$wire.sort_col !== 'date'"
                    class="flex items-center px-5 py-2 space-x-2 text-sm border-b border-slate-200 dark:border-slate-600">
                    <p>Sort By:</p>

                    <div
                        class="flex px-2 py-1 space-x-1 overflow-hidden text-xs font-medium border rounded-md w-fit border-rose-500 text-rose-500 dark:border-rose-500 dark:text-rose-500 bg-rose-500/10 dark:bg-rose-500/10">
                        <span class="font-medium text-rose-500">
                            {{ Str::title($sort_col) }}
                        </span>

                        <button class="!text-rose-500" wire:click="$set('sort_col', 'date')">
                            <x-heroicon-s-x-mark class="!w-4 !h-4" />
                        </button>
                    </div>
                </div>

                <thead class="bg-slate-100/75 dark:bg-slate-700">
                    <tr>
                        @if (in_array('date', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="date" />
                        @endif

                        @if (!$account && in_array('account', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="account" :$account />
                        @endif

                        @if (in_array('category', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="category" />
                        @endif

                        @if (in_array('type', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="type" />
                        @endif

                        @if (in_array('amount', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="amount" />
                        @endif

                        @if (in_array('payee', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="payee" />
                        @endif

                        @if (in_array('status', $columns))
                            <x-sortable-column :$sort_col :$sort_asc column="status" />
                        @endif

                        <th scope="col"
                            class="py-3 pr-5 text-xs font-semibold uppercase text-slate-600 text-end dark:text-slate-200">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 dark:divide-slate-600">
                    @forelse ($transactions as $transaction)
                        <tr wire:key='{{ $transaction->id }}'>
                            @if (in_array('date', $columns))
                                <td
                                    class="py-4 text-sm first:pl-5 text-slate-800 whitespace-nowrap dark:text-slate-200">
                                    {{ Carbon\Carbon::parse($transaction->date)->format('M j, Y') }}
                                </td>
                            @endif

                            @if (!$account && in_array('account', $columns))
                                <td
                                    class="py-3.5 first:pl-5 text-sm font-medium text-slate-800 whitespace-nowrap dark:text-slate-200">
                                    <a class="text-sm font-medium text-indigo-500 duration-200 ease-in-out hover:text-indigo-600 dark:hover:text-indigo-400"
                                        href="{{ route('pure-finance.account.overview', $transaction->account) }}"
                                        wire:navigate>
                                        {{ $transaction->account->name }}
                                    </a>
                                </td>
                            @endif

                            @if (in_array('category', $columns))
                                <td
                                    class="py-3.5 first:pl-5 text-sm text-slate-800 whitespace-nowrap dark:text-slate-200">
                                    {{ $transaction->category->name }}
                                </td>
                            @endif

                            @if (in_array('type', $columns))
                                <td
                                    class="py-3.5 first:pl-5 text-sm text-slate-800 whitespace-nowrap dark:text-slate-200">
                                    {{ $transaction->type->label() }}
                                </td>
                            @endif

                            @if (in_array('amount', $columns))
                                <td
                                    class="py-3.5 first:pl-5 text-sm text-slate-800 whitespace-nowrap dark:text-slate-200">
                                    @if (in_array($transaction->type, [TransactionType::DEBIT, TransactionType::TRANSFER, TransactionType::WITHDRAWAL]))
                                        <span class="-mr-1">-</span>
                                    @else
                                        <span class="-mr-1 text-emerald-500">+</span>
                                    @endif

                                    <span @class([
                                        'text-emerald-500' => in_array($transaction->type, [
                                            TransactionType::CREDIT,
                                            TransactionType::DEPOSIT,
                                        ]),
                                    ])>
                                        ${{ Number::format($transaction->amount ?? 0, 2) }}
                                    </span>
                                </td>
                            @endif

                            @if (in_array('payee', $columns))
                                <td
                                    class="py-3.5 first:pl-5 text-sm text-slate-800 whitespace-nowrap dark:text-slate-200">
                                    {{ $transaction->payee }}
                                </td>
                            @endif

                            @if (in_array('status', $columns))
                                <td class="py-3.5 first:pl-5 whitespace-nowrap">
                                    <form wire:submit="toggleStatus({{ $transaction->id }})">
                                        <button type="submit" @class([
                                            'border-emerald-500 text-emerald-500 dark:border-emerald-500 dark:text-emerald-500 bg-emerald-500/10 dark:bg-emerald-500/10' =>
                                                $transaction->status,
                                            'border-amber-500 text-amber-500 dark:border-amber-500 dark:text-amber-500 bg-amber-500/10 dark:bg-amber-500/10' => !$transaction->status,
                                            'inline-flex items-center space-x-0.5 px-2 py-1 overflow-hidden text-xs font-medium border rounded-md w-[84px] h-[26px] relative',
                                        ])>
                                            <div wire:loading.remove
                                                wire:target="toggleStatus({{ $transaction->id }})">
                                                @if ($transaction->status)
                                                    <x-heroicon-s-check-badge
                                                        class="w-[16px] h-[16px] text-emerald-500" />
                                                @else
                                                    <x-heroicon-s-arrow-path class="w-[16px] h-[16px] text-amber-500" />
                                                @endif
                                            </div>

                                            <span wire:loading.remove
                                                wire:target="toggleStatus({{ $transaction->id }})" class="pl-0.5">
                                                {{ $transaction->status ? 'Cleared' : 'Pending' }}
                                            </span>

                                            <x-loading-spinner target="toggleStatus({{ $transaction->id }})"
                                                class="pr-6" />
                                        </button>
                                    </form>
                                </td>
                            @endif

                            <td
                                class="py-1 pr-5 text-sm font-medium whitespace-nowrap text-slate-800 dark:text-slate-200">
                                <div class="flex items-center justify-end">
                                    @if ($transaction->attachments)
                                        <button
                                            x-on:click="$dispatch('open-attachments', { attachments: @js($transaction->attachments) })">
                                            <x-heroicon-o-photo
                                                class="p-1 duration-100 mt-0.5 mr-0.5 ease-in-out rounded-md w-7 h-7 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700" />
                                        </button>
                                    @endif

                                    <a href="{{ route('pure-finance.transaction-form', $transaction->id) }}">
                                        <x-heroicon-o-pencil-square
                                            class="p-1 text-indigo-500 duration-100 ease-in-out rounded-md w-7 h-7 hover:bg-slate-200 dark:hover:bg-slate-700" />
                                    </a>

                                    <x-modal icon="information-circle" delete variant="danger"
                                        wire:submit="delete({{ $transaction->id }})">
                                        <x-slot:button>
                                            <x-heroicon-o-trash
                                                class="p-1 -mr-2 text-red-500 duration-100 ease-in-out rounded-md w-7 h-7 hover:bg-slate-200 dark:hover:bg-slate-700" />
                                        </x-slot:button>

                                        <x-slot:title>
                                            Delete Transaction
                                        </x-slot:title>

                                        <x-slot:body>
                                            Are you sure you want to delete this transaction?
                                        </x-slot:body>
                                    </x-modal>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <p class="p-3 text-sm italic font-medium text-center">No transactions found...</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $transactions->links(data: ['scrollTo' => false]) }}

    <livewire:pure-finance.attachments />
</div>
