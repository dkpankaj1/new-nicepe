<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\RolesDatatable;
use App\Http\Controllers\Controller;
use App\Models\permissionGroup;
use App\Services\ToasterService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    use AuthorizationFilter;
    public function __construct()
    {
        $this->applyAuthorization([
            'index' => 'roles.read',
            'show' => 'roles.read',
            'create' => 'roles.create',
            'store' => 'roles.create',
            'edit' => 'roles.edit',
            'update' => 'roles.edit',
            'destroy' => 'roles.delete',
        ]);

    }
    public function index(Request $request, RolesDatatable $rolesDatatable)
    {
        if ($request->expectsJson()) {
            return $rolesDatatable->get();
        }
        return view('admin.roles.index');
    }
    public function create()
    {
        $permissionGroups = permissionGroup::with('permissions')->get();
        return view('admin.roles.create', ['permissionGroups' => $permissionGroups]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => ['sometimes', 'array']
        ]);
        try {
            $role = Role::create([
                'name' => Str::lower($request->name)
            ]);

            $role->syncPermissions($request->permissions);

            ToasterService::success('Create success');
            return redirect()->back();

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    public function show(Role $role)
    {
        return view(
            'admin.roles.show',
            [
                'role' => $role,
                'hasPermissions' => $role->permissions()->pluck('name')->toArray(),
                'permissionGroups' => PermissionGroup::with('permissions')->get()
            ]
        );
    }

    public function edit(Role $role)
    {
        return view(
            'admin.roles.edit',
            [
                'role' => $role,
                'hasPermissions' => $role->permissions()->pluck('name')->toArray(),
                'permissionGroups' => PermissionGroup::with('permissions')->get()
            ]
        );
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => ['sometimes', 'array']
        ]);
        try {

            $role->update([
                'name' => Str::lower($request->name),
            ]);

            $role->syncPermissions($request->permissions);

            ToasterService::success('Update success');
            return redirect()->back();
        } catch (\Exception $e) {

            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return response()->json([
                'message' => __('message.success.default'),
                'status' => 'success',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => __('message.error.default'),
                'status' => 'error',
            ]);
        }
    }
}
