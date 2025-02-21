<?php
namespace App\Datatables\Admin;

use App\Datatables\BaseDatatable;
use App\Models\BalanceTransfer;
use Yajra\DataTables\DataTableAbstract;

class BalanceTransferDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(BalanceTransfer::query()->latest());
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
                return view('components.show-btn', ['url' => route('admin.balance-transfers.show', $balanceTransfer->id), 'permission' => 'balance-transfers.read']) .
                    view('components.edit-btn', ['url' => route('admin.balance-transfers.edit', $balanceTransfer->id), 'permission' => 'balance-transfers.edit']) .
                    view('components.delete-btn', ['url' => route('admin.balance-transfers.destroy', $balanceTransfer->id), 'permission' => 'balance-transfers.delete']);
            });
    }
}