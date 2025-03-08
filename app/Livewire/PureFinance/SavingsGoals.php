<?php

declare(strict_types=1);

namespace App\Livewire\PureFinance;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class SavingsGoals extends Component
{
    public function render(): View
    {
        return view('livewire.pure-finance.savings-goals', [
            'goals' => auth()
                ->user()
                ->savings_goals
        ]);
    }
}
