<div x-data="{ savingsGoalFormModalOpen: false }" class="w-full pt-3 mx-auto space-y-5 sm:pt-5 sm:space-y-3">
    <div
        class="bg-white border divide-y shadow-sm rounded-xl border-slate-200 dark:bg-slate-800 divide-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 dark:divide-slate-600 h-fit">
        <div class="flex items-center justify-between gap-2 px-4 py-2.5">
            <h1 class="text-xl font-semibold text-slate-800 dark:text-slate-200">
                Savings Goals
            </h1>

            <div>
                <flux:button x-on:click="savingsGoalFormModalOpen = true" aria-controls="savingsGoalFormModalOpen-modal"
                    variant="indigo" size="sm" class="!h-7">
                    <x-heroicon-o-plus class="w-4 h-4" />

                    Add
                </flux:button>

                <livewire:pure-finance.savings-goal-form />
            </div>
        </div>

        <div class="flex flex-col divide-y divide-slate-200 dark:divide-slate-600">
            @forelse ($goals as $goal)
                <a href="{{ route('pure-finance.savings-goal-view', $goal) }}" wire:navigate
                    class="flex items-center justify-between px-4 py-3 text-sm duration-200 ease-in-out last:rounded-b-xl hover:bg-slate-100 dark:hover:bg-slate-700">
                    <p class="font-medium">{{ $goal->name }}</p>

                    {{-- <p>
                        <span @class([
                            'text-red-500 font-medium' =>
                                $expense->total_spent > $expense->monthly_amount,
                        ])>
                            ${{ Number::format($expense->total_spent ?? 0, 2) }}
                        </span>

                        of

                        ${{ Number::format($expense->monthly_amount ?? 0, 2) }}
                    </p> --}}
                </a>
            @empty
                <div
                    class="p-2.5 text-sm italic font-medium text-center text-slate-800 whitespace-nowrap dark:text-slate-200">
                    No goals found...
                </div>
            @endforelse
        </div>
    </div>
</div>
