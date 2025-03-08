<div x-cloak x-on:planned-expense-saved="savingsGoalFormModalOpen = false">
    <div class="fixed inset-0 z-30 transition-opacity bg-slate-900 bg-opacity-40 dark:bg-opacity-60 backdrop-blur-sm"
        x-show="savingsGoalFormModalOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;">
    </div>

    <div id="savingsGoalFormModalOpen-modal"
        class="fixed inset-0 z-30 flex items-center justify-center px-4 my-4 sm:px-6" role="dialog" aria-modal="true"
        x-show="savingsGoalFormModalOpen" x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
        <div class="w-full max-w-lg max-h-full bg-white border rounded-lg shadow-lg dark:bg-slate-800 text-slate-800 dark:text-slate-100 border-slate-200 dark:border-slate-700"
            x-on:click.outside="savingsGoalFormModalOpen = false"
            x-on:keydown.escape.window="savingsGoalFormModalOpen = false"
            x-trap.inert.noscroll="savingsGoalFormModalOpen">
            <div class="px-5 py-2.5 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="text-lg font-semibold">
                        {{ $goal ? 'Edit' : 'Create' }} Goal
                    </div>

                    <flux:button icon="x-mark" x-on:click="savingsGoalFormModalOpen = false"
                        class="!h-8 !w-8 !-mr-2 !border-none hover:!bg-slate-100 dark:hover:!bg-slate-700 !shadow-none" />
                </div>
            </div>

            <form class="p-5 space-y-5" wire:submit='submit' x-on:submit="$dispatch('savings-goal-updated')">
                <div class="space-y-5">
                    <div>
                        <div class="flex space-x-1">
                            <x-input-label for="name" :value="__('Name')" />

                            <span class="text-rose-500">*</span>
                        </div>

                        <x-text-input wire:model="name" id="name" class="block w-full mt-1 !rounded-lg sm:text-sm"
                            type="text" name="name" required autofocus autocomplete="name" />

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex space-x-1">
                            <x-input-label for="goal_amount" :value="__('Goal Amount')" />

                            <span class="text-rose-500">*</span>
                        </div>

                        <x-text-input wire:model="goal_amount" id="goal_amount"
                            class="block !rounded-lg w-full mt-1 sm:text-sm" type="number" name="goal_amount" required
                            autofocus autocomplete="goal_amount" placeholder="100.00" step="0.01" />

                        <x-input-error :messages="$errors->get('goal_amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="saved_amount" :value="__('Saved so far')" />

                        <x-text-input wire:model="saved_amount" id="saved_amount"
                            class="block !rounded-lg w-full mt-2 sm:text-sm" type="number" name="saved_amount"
                            autofocus autocomplete="saved_amount" step="0.01" />

                        <x-input-error :messages="$errors->get('saved_amount')" class="mt-2" />
                    </div>

                    <div>
                        <label class="flex items-center justify-between" for="target">
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                Target Goal Date
                            </p>

                            <div class="flex items-center cursor-pointer w-fit">
                                <input type="checkbox" id="target" name="target" x-model="$wire.target" autofocus
                                    class="sr-only peer" />

                                <div
                                    class="relative z-0 w-11 h-6 bg-amber-500 dark:bg-amber-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-indigo-500 dark:peer-checked:bg-indigo-600">
                                </div>
                            </div>
                        </label>
                    </div>

                    <div x-cloak x-show="$wire.target" class="flex items-center justify-between gap-3" x-collapse>
                        <div class="w-full">
                            <x-input-label for="target_month" :value="__('Target Month')" />

                            <select wire:model="target_month" id="target_month" autofocus
                                class="flex w-full mt-2 rounded-lg shadow-sm sm:text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">Select a month</option>

                                @foreach ($months as $month)
                                    <option value="{{ $month }}">
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('target_month')" class="mt-2" />
                        </div>

                        <div class="w-full">
                            <x-input-label for="target_year" :value="__('Target Year')" />

                            <select wire:model="target_year" id="target_year" autofocus
                                class="flex w-full mt-2 rounded-lg shadow-sm sm:text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">Select a year</option>

                                @foreach ($years as $year)
                                    <option value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('target_year')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <div class="flex space-x-1">
                            <x-input-label for="monthly_contribution" :value="__('Monthly Contribution')" />

                            <span class="text-rose-500">*</span>
                        </div>

                        <x-text-input wire:model="monthly_contribution" id="monthly_contribution"
                            class="block !rounded-lg w-full mt-1 sm:text-sm" type="number"
                            name="monthly_contribution" required autofocus autocomplete="monthly_contribution"
                            placeholder="100.00" step="0.01" />

                        <x-input-error :messages="$errors->get('monthly_contribution')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="space-x-1 text-sm text-white">
                        <flux:button variant="outline" class="!px-5" x-on:click="savingsGoalFormModalOpen = false">
                            Cancel
                        </flux:button>

                        <flux:button variant="indigo" class="!px-5" type="submit">
                            Submit
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
