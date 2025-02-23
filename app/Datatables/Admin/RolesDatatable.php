<?php
namespace App\Datatables\Admin;

use App\Datatables\BaseDatatable;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTableAbstract;

class RolesDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(
            Role::query()
                ->latest()
                ->where('id', '!=', 1)
        );
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()
            ->addColumn('users', function ($role) {
                return $role->users->count();
            })
            ->addColumn('created_at', function ($roles) {
                return $roles->updated_at ? $roles->created_at->diffForHumans() : 'N/A';
            })
            ->addColumn('updated_at', function ($roles) {
                return $roles->updated_at ? $roles->updated_at->diffForHumans() : 'N/A';
            })
            ->addColumn('action', function ($roles) {
                return view('components.show-btn', ['url' => route('admin.roles.show', $roles->id), 'permission' => 'roles.read']) .
                    view('components.edit-btn', ['url' => route('admin.roles.edit', $roles->id), 'permission' => 'roles.edit']) .
                    view('components.delete-btn', ['url' => route('admin.roles.destroy', $roles->id), 'permission' => 'roles.delete']);
            });
    }
}