<?php

declare(strict_types=1);

namespace App\Livewire\PureFinance;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use App\Models\PureFinance\Account;
use Illuminate\Contracts\View\View;
use App\Models\PureFinance\Category;
use App\Models\PureFinance\Transaction;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TransactionTable extends Component
{
    use WithPagination;

    public ?Account $account = null;

    public string $search = '';

    public string $status = 'all';

    public int $cleared_total;

    public int $pending_total;

    public string $transaction_type = '';

    public Collection $accounts;

    public array $selected_accounts = [];

    public array $categories = [];

    public array $selected_categories = [];

    public array $columns = [
        'date',
        'account',
        'category',
        'type',
        'amount',
        'payee',
        'status'
    ];

    public string $date = '';

    public string $sort_col = 'date';

    public bool $sort_asc = false;

    public function mount(): void
    {
        if (!$this->account) $this->accounts = $this->getAccounts();

        $this->getCategories();

        if ($this->account) {
            $this->columns = collect($this->columns)
                ->reject(fn(string $column): bool => $column === 'account')
                ->values()
                ->toArray();
        }
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function getAccounts(): Collection
    {
        return auth()
            ->user()
            ->accounts()
            ->select('name')
            ->distinct()
            ->pluck('name')
            ->sort();
    }

    public function getCategories(): void
    {
        $this->categories = auth()
            ->user()
            ->categories()
            ->with('children')
            ->select(['id', 'name', 'parent_id'])
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    #[On('clear-filters')]
    public function clearFilters(): void
    {
        $this->reset(['transaction_type', 'selected_categories', 'selected_accounts', 'date']);
    }

    public function sortBy(string $column): void
    {
        if ($this->sort_col === $column) {
            $this->sort_asc = !$this->sort_asc;
        } else {
            $this->sort_col = $column;
            $this->sort_asc = false;
        }
    }

    public function applyColumnSorting(Builder $query): Builder
    {
        $direction = $this->sort_asc ? 'asc' : 'desc';

        return match ($this->sort_col) {
            'account' => $query->orderBy(
                Account::select('name')
                    ->whereColumn('id', 'transactions.account_id')
                    ->limit(1),
                $direction
            ),
            'category' => $query->orderBy(
                Category::select('name')
                    ->whereColumn('id', 'transactions.category_id')
                    ->limit(1),
                $direction
            ),
            'type', 'amount', 'payee', 'date', 'status' => $query->orderBy($this->sort_col, $direction),
            default => $query
        };
    }

    public function toggleStatus(Transaction $transaction): void
    {
        $transaction->update(['status' => !$transaction->status]);

        Notification::make()
            ->title("Successfully changed status")
            ->success()
            ->send();

        $this->dispatch('status-changed');
    }

    public function delete(Transaction $transaction): void
    {
        $transaction->delete();

        Notification::make()
            ->title("Successfully deleted transaction")
            ->success()
            ->send();

        $this->dispatch('transaction-deleted');

        $this->dispatch('close-modal');
    }

    public function render(): View
    {
        $transactions = Transaction::query()
            ->with([
                'account:id,name,user_id',
                'category:id,name,parent_id',
                'category.parent:id,name',
                'tags:id,name'
            ])
            ->whereRelation('account', 'user_id', auth()->id())
            ->addSelect([
                'cleared_total' => Transaction::selectRaw('COUNT(*)')
                    ->whereColumn('account_id', 'transactions.account_id')
                    ->where('status', true),
                'pending_total' => Transaction::selectRaw('COUNT(*)')
                    ->whereColumn('account_id', 'transactions.account_id')
                    ->where('status', false),
            ])
            ->when($this->account, function (Builder $query): void {
                $query->whereRelation('account', 'name', $this->account->name);
            })
            ->when($this->status !== 'all', function (Builder $query): void {
                $query->where('status', $this->status === 'cleared' ? true : false);
            })
            ->when(strlen($this->search) >= 1, function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query->whereRelation('category', 'name', 'like', "%{$this->search}%")
                        ->orWhere('payee', 'like', "%{$this->search}%")
                        ->orWhere('amount', 'like', "%{$this->search}%")
                        ->orWhere('transactions.type', 'like', "%{$this->search}%");

                    if (!$this->account) {
                        $query->orWhereRelation('account', 'name', 'like', "%{$this->search}%");
                    }
                });
            })
            ->when($this->sort_col, fn(Builder $query): Builder => $this->applyColumnSorting($query))
            ->when($this->transaction_type, function (Builder $query): void {
                $query->where('transactions.type', $this->transaction_type);
            })
            ->when(!empty($this->selected_accounts), function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    foreach ($this->selected_accounts as $account) {
                        $query->orWhereRelation('account', 'name', 'like', $account);
                    }
                });
            })
            ->when(!empty($this->selected_categories), function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    foreach ($this->selected_categories as $selected_category) {
                        $category = Category::query()
                            ->with('parent')
                            ->select(['id', 'name', 'parent_id'])
                            ->where('name', 'like', $selected_category)
                            ->first();

                        if (!$category->parent()->exists()) {
                            $query->orWhereRelation('category', 'name', 'like', $category->name)
                                ->orWhereRelation('category', 'parent_id', $category->id);
                        } else {
                            $query->orWhereRelation('category', 'name', 'like', $category->name);
                        }
                    }
                });
            })
            ->when($this->date, function (Builder $query): void {
                $query->whereBetween('date', [Carbon::parse($this->date)->toDateString(), now()->toDateString()]);
            })
            ->whereDate('date', '<=', now()->timezone('America/Chicago'))
            ->latest('id')
            ->paginate(25);

        $this->cleared_total = $transactions->first()->cleared_total ?? 0;
        $this->pending_total = $transactions->first()->pending_total ?? 0;

        return view('livewire.pure-finance.transaction-table', [
            'transactions' => $transactions
        ]);
    }
}
