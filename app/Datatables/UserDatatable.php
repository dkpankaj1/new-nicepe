<?php
namespace App\Datatables;

use App\Enums\UserType;
use App\Models\GeneralSetting;
use App\Models\User;
use Yajra\DataTables\DataTableAbstract;

class UserDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(User::query()->where('type', UserType::ADMIN->value)->latest());
    }

    public function configure($datatable): DataTableAbstract
    {

        return $datatable
            ->addIndexColumn()

            ->addColumn('status', fn($user) => $user->active == 1
                ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

            ->addColumn('role', fn($user) => $user->getRoleNames()[0] ?? "No Role")
            
            // ->addColumn('wallet', fn($user) => number_format($user->wallet, 2))

            // ->addColumn('avatar', fn($user) => view('components.user-avatar', ['src' => $user->avatar]))

            ->addColumn('created_at', function ($user) {
                return $user->updated_at ? $user->created_at->diffForHumans() : 'N/A';
            })
            ->addColumn('updated_at', function ($user) {
                return $user->updated_at ? $user->updated_at->diffForHumans() : 'N/A';
            })

            ->addColumn('action', function ($user) {
                return view('components.show-btn', ['url' => route('admin.users.show', $user->id),'permission' =>'users.read']) .
                    view('components.edit-btn', ['url' => route('admin.users.edit', $user->id),'permission' =>'users.edit']) .
                    view('components.delete-btn', ['url' => route('admin.users.destroy', $user->id),'permission' =>'users.delete']);
            });
        // Implement your action logic here
    }
}