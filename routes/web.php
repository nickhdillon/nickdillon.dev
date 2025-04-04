<?php

use App\Livewire\MovieVault\Explore;
use App\Livewire\MovieVault\MyVault;
use App\Livewire\MovieVault\Wishlist;
use Illuminate\Support\Facades\Route;
use App\Livewire\PureFinance\Accounts;
use App\Livewire\PureFinance\TagTable;
use App\Livewire\MovieVault\VaultDetails;
use App\Livewire\PureFinance\SavingsGoal;
use App\Livewire\PureFinance\CategoryTable;
use App\Livewire\PureFinance\AccountOverview;
use App\Livewire\PureFinance\TransactionForm;
use App\Livewire\PureFinance\PlannedExpenseView;

Route::view('/', 'portfolio')->name('portfolio');

Route::view('/apps', 'apps')->name('apps');

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');

    Route::prefix('movie-vault')
        ->name('movie-vault.')
        ->middleware('can:access-movie-vault')
        ->group(function () {
            Route::get('my-vault', MyVault::class)->name('my-vault');

            Route::get('explore/{query?}', Explore::class)->name('explore');

            Route::get('{vault}/details', VaultDetails::class)->name('details');

            Route::get('wishlist', Wishlist::class)->name('wishlist');
        });

    Route::prefix('pure-finance')
        ->name('pure-finance.')
        ->group(function () {
            Route::view('/', 'pure-finance')->name('index');

            Route::get('accounts', Accounts::class)->name('accounts');

            Route::get('account/{account}/overview', AccountOverview::class)->name('account.overview');

            Route::get('account/{account}/transaction-form/{transaction?}', TransactionForm::class)
                ->name('account.transaction-form');

            Route::get('transaction-form/{transaction?}', TransactionForm::class)
                ->name('transaction-form');

            Route::get('categories', CategoryTable::class)->name('categories');

            Route::get('tags', TagTable::class)->name('tags');

            Route::get('planned-expense/{expense}', PlannedExpenseView::class)
                ->name('planned-expense-view');

            Route::get('savings-goal/{goal}', SavingsGoal::class)
                ->name('savings-goal-view');
        });
});

require __DIR__ . '/auth.php';
