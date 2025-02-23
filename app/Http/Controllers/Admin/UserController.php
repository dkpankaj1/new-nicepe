<?php

namespace App\Http\Controllers\admin;

use App\Datatables\Admin\UserDatatable;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\ToasterService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizationFilter;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserDatatable $userDatatable)
    {
        if ($request->expectsJson()) {
            return $userDatatable->get();
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.users.create',
            [
                'roles' => Role::all(),
                'country' => Country::with('states')->first()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        try {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
                'wallet' => 0,
                'type' => UserType::ADMIN->value,
                'active' => $data['is_active'],
            ]);
            $user->assignRole($request->role);

            ToasterService::success('Create success');
            return redirect()->back();

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view(
            'admin.users.show',
            [
                'user' => $user,
                'roles' => Role::all(),
                'country' => Country::with('states')->first()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            [
                'user' => $user,
                'roles' => Role::all(),
                'country' => Country::with('states')->first()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate($this->rules($user->id));

        try {

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'postal_code' => $data['postal_code'],
                'active' => $data['is_active'],
            ]);
            $user->syncRoles($request->role);

            ToasterService::success('Update success');
            return redirect()->back();

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            throw_if($user->id == 1, 'An error occurred. Please try again.');

            $user->update(['active' => false, 'deleted_at' => now()]);

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

    private function rules($userId = null)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'password' => $userId ? 'nullable' : ['required', Rules\Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'wallet' => 'nullable|numeric|min:0',
            'role' => ['required', Rule::exists(Role::class, 'name')],
            'is_active' => 'required|boolean',
        ];
    }
}
