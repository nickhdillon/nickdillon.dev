<?php

namespace App\Models;

use App\Models\PureFinance\Tag;
use App\Models\MovieVault\Vault;
use App\Models\PureFinance\Account;
use App\Models\PureFinance\Category;
use App\Models\PureFinance\SavingsGoal;
use App\Models\PureFinance\Transaction;
use Illuminate\Notifications\Notifiable;
use App\Models\PureFinance\PlannedExpense;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vaults(): HasMany
    {
        return $this->hasMany(Vault::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, Account::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function planned_expenses(): HasManyThrough
    {
        return $this->hasManyThrough(PlannedExpense::class, Category::class);
    }

    public function savings_goals(): HasMany
    {
        return $this->hasMany(SavingsGoal::class);
    }
}
