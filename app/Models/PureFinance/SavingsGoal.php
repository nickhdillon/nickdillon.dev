<?php

namespace App\Models\PureFinance;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingsGoal extends Model
{
    /** @use HasFactory<\Database\Factories\SavingsGoalFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'goal_amount',
        'target',
        'target_month',
        'target_year',
        'monthly_contribution'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
