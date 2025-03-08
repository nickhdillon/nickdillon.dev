<?php

declare(strict_types=1);

namespace App\Livewire\PureFinance;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use App\Models\PureFinance\SavingsGoal;

class SavingsGoalForm extends Component
{
    public ?SavingsGoal $goal = null;

    #[Validate(['required', 'string'])]
    public string $name = '';

    #[Validate(['required', 'decimal:0,2', 'numeric', 'min:1', 'gt:saved_amount'])]
    public float $goal_amount;

    #[Validate(['required', 'decimal:0,2', 'numeric', 'lt:goal_amount'])]
    public float $saved_amount = 0;

    #[Validate(['required', 'boolean'])]
    public bool $target = true;

    #[Validate(['nullable', 'string'])]
    public ?string $target_month = null;

    #[Validate(['nullable', 'string'])]
    public ?string $target_year = null;

    #[Validate(['required', 'decimal:0,2', 'numeric', 'min:1'])]
    public float $monthly_contribution;

    public Collection $months;

    public Collection $years;

    public function render(): View
    {
        $this->months = collect(range(1, 12))->map(
            fn(int $month): string =>
            Carbon::create()
                ->month($month)
                ->format('M')
        );

        $this->years = collect(range(Carbon::now()->year, Carbon::now()->year + 20));

        return view('livewire.pure-finance.savings-goal-form');
    }
}
