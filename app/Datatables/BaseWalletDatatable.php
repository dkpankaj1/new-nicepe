<?php
namespace App\Datatables;

use App\Enums\TransactionEnum;
use App\Models\Transaction;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;

class BaseWalletDatatable extends BaseDatatable
{
    protected $showBtnRouteName;
    public function __construct(string $routeName)
    {
        parent::__construct(Transaction::query()
            ->where('user_id', Auth::user()->id)
            ->whereNot('status', TransactionEnum::STATUS_PENDING)
            ->latest());
        $this->showBtnRouteName = $routeName;
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()
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
                return view('components.link', [
                    'href' => route($this->showBtnRouteName, $transaction->id),
                    'class' => 'btn btn-info btn-sm',
                    'label' => 'Show',
                ]);
            });

    }
}