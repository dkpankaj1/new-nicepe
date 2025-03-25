<?php
namespace App\Datatables\SuperDistributor;

use App\Datatables\BaseDatatable;
use App\Enums\UserType;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;

class DistributorDatatable extends BaseDatatable
{
    protected $generalSetting;
    public function __construct()
    {
        parent::__construct(
            User::query()
                ->where('type', UserType::DISTRIBUTOR->value)
                ->where('parent', Auth::id())
                ->latest()
        );

        $this->generalSetting = GeneralSetting::first();
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()

            ->addColumn('avatar', fn($user) => view('components.user-avatar', ['src' => $user->avatar]))

            ->addColumn('status', fn($user) => $user->active == 1
                ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

            ->addColumn('wallet', fn($user) => number_format($user->wallet, 2))

            ->addColumn('plan', fn($user) => $user->plan->name ?? 'no-plan')

            ->addColumn('created_at', function ($user) {
                return $user->updated_at ? $user->created_at->diffForHumans() : 'N/A';
            })
            ->addColumn('updated_at', function ($user) {
                return $user->updated_at ? $user->updated_at->diffForHumans() : 'N/A';
            })
            ->addColumn('action', function ($user) {
                return view('components.link', ['href' => route('superdistributor.distributors.show', $user->id), 'label' => 'show', 'class' => 'btn btn-sm btn-info']) .
                    view('components.link', ['href' => route('superdistributor.distributors.edit', $user->id), 'label' => 'edit', 'class' => 'btn btn-sm btn-warning']) .
                    view('components.user-btn-delete', ['url' => route('superdistributor.distributors.destroy', $user->id)]);
            });
    }

    public function columns(): array
    {
        return [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
            ['data' => 'avatar', 'name' => 'avatar', 'title' => 'Avatar'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'city', 'name' => 'city', 'title' => 'City'],
            ['data' => 'wallet', 'name' => 'wallet', 'title' => 'Wallet ( ' . $this->generalSetting->currency->symbol . ' )'],
            ['data' => 'plan', 'name' => 'plan', 'title' => 'Plan'],
            ['data' => 'state', 'name' => 'state', 'title' => 'State'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
        ];
    }
}