<?php
namespace App\Datatables;

use App\Models\Transaction;
use Yajra\DataTables\DataTableAbstract;
use Illuminate\Support\Str;

class TransactionDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Transaction::query()->latest('id'));
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()

            ->addColumn('user', fn($transaction) => $transaction->user->name)
            ->addColumn('user_type', fn($transaction) => Str::of($transaction->user->type)->replace('_', ' ')->title())
            ->addColumn('email', fn($transaction) => $transaction->user->email)
            ->addColumn('transaction_direction', fn($transaction) => ucfirst($transaction->transaction_direction))
            ->addColumn('opening_balance', function ($transaction) {
                return "{$transaction->currency->code} {$transaction->opening_balance}";
            })
            ->addColumn('amount', function ($transaction) {
                return "{$transaction->currency->code} {$transaction->amount}";
            })
            ->addColumn('fee', function ($transaction) {
                return "{$transaction->currency->code} {$transaction->fee}";
            })
            ->addColumn('tax', function ($transaction) {
                return "{$transaction->tax} (%)";
            })
            ->addColumn('closing_balance', function ($transaction) {
                return "{$transaction->currency->code} {$transaction->closing_balance}";
            })
            ->addColumn('status', function ($transaction) {
                $badgeType = match ($transaction->status) {
                    'complete' => 'success',
                    'pending' => 'info',
                    'failed' => 'danger',
                    default => 'secondary',
                };
                return view('components.badges', [
                    'type' => $badgeType,
                    'text' => ucfirst($transaction->status),
                ]);
            })

            ->addColumn('created_at', fn($feature) => $feature->created_at->diffForHumans())

            ->addColumn('updated_at', fn($feature) => $feature->updated_at->diffForHumans())

            ->addColumn('action', function ($transaction) {
                return view('components.show-btn', ['url' => route('admin.transactions.show', $transaction->id), 'permission' => 'transactions.read']);
            })
        ;
        // Implement your action logic here
    }
}