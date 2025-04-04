<?php

namespace Database\Factories\PureFinance;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\PureFinance\TransactionType;
use App\Models\PureFinance\Category;
use App\Models\PureFinance\Account;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PureFinance\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaction_date = $this->faker->dateTimeBetween('-2 years', 'now');

        $frequency = Arr::random(['month', 'year']);

        $recurring_end = (clone $transaction_date)->modify("+1 {$frequency}");

        return [
            'account_id' => Account::count() > 0
                ? Account::inRandomOrder()->first()->id
                : Account::factory(),
            'category_id' => Category::count() > 0
                ? Category::inRandomOrder()->first()->id
                : Category::factory(),
            'type' => Arr::random(TransactionType::cases()),
            'transfer_to' => null,
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'payee' => $this->faker->text(30),
            'date' => $transaction_date->format('Y-m-d'),
            'notes' => $this->faker->paragraph(4),
            'status' => Arr::random([true, false]),
            'is_recurring' => Arr::random([true, false]),
            'frequency' => $frequency,
            'recurring_end' => $recurring_end->format('Y-m-d')
        ];
    }
}
