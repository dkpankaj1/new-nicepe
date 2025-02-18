<?php
namespace App\Datatables;

use App\Enums\UserType;
use App\Models\User;
use Yajra\DataTables\DataTableAbstract;

class RetailerDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(
            User::query()
                ->where('type', UserType::RETAILER->value)
                ->latest()
        );
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()

            ->addColumn('avatar',fn($user) => view('components.user-avatar',['src' => $user->avatar]))
            
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
                return view('components.show-btn', ['url' => route('admin.retailers.show', $user->id), 'permission' => 'retailers.read']) .
                    view('components.edit-btn', ['url' => route('admin.retailers.edit', $user->id), 'permission' => 'retailers.edit']) .
                    view('components.delete-btn', ['url' => route('admin.retailers.destroy', $user->id), 'permission' => 'retailers.delete']);
            });
    }
}