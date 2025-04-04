<?php
namespace App\Datatables\Distributor;

use App\Datatables\BaseDatatable;
use App\Models\BalanceTransfer;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;

class BalanceTransferDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(
            BalanceTransfer::query()
                ->where('from_user', operator: Auth::id())
                ->latest()
        );
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
        
            ->addIndexColumn()

            ->addColumn('name', fn($balanceTransfer) => $balanceTransfer->toUser->name)

            ->addColumn('email', fn($balanceTransfer) => $balanceTransfer->toUser->email)

            ->addColumn('amount', fn($balanceTransfer) => $balanceTransfer->amount)

            ->addColumn('created_at', function ($balanceTransfer) {
                return $balanceTransfer->updated_at ? $balanceTransfer->created_at->diffForHumans() : 'N/A';
            })

            ->addColumn('updated_at', function ($balanceTransfer) {
                return $balanceTransfer->updated_at ? $balanceTransfer->updated_at->diffForHumans() : 'N/A';
            })

            ->addColumn('action', function ($balanceTransfer) {
                $action = view('components.link', ['href' => route('distributor.balance-transfers.show', $balanceTransfer->id), 'label' => 'show', 'class' => 'btn btn-sm btn-info']);

                if ($balanceTransfer->deleted_at == null)
                    $action = $action .
                        view('components.link', ['href' => route('distributor.balance-transfers.edit', $balanceTransfer->id), 'label' => 'edit', 'class' => 'btn btn-sm btn-warning']) .
                        view('components.user-btn-delete', ['url' => route('distributor.balance-transfers.destroy', $balanceTransfer->id)]);

                return $action;
            });
    }
}