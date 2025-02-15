<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\SuperDistributorDatatable;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Plan;
use App\Models\User;
use App\Services\PlanService;
use App\Services\ToasterService;
use App\Services\UserService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class SuperDistributorController extends Controller
{
    use AuthorizationFilter;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->applyAuthorization([
            'index' => 'super-distributors.read',
            'show' => 'super-distributors.read',
            'create' => 'super-distributors.create',
            'store' => 'super-distributors.create',
            'edit' => 'super-distributors.edit',
            'update' => 'super-distributors.edit',
            'destroy' => 'super-distributors.delete',
        ]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, SuperDistributorDatatable $superDistributorDatatable)
    {
        return $request->expectsJson()
            ? $superDistributorDatatable->get()
            : view('admin.superdistributor.index');
    }

    public function create(PlanService $planService)
    {
        return view('admin.superdistributor.create', [
            'plans' => $planService->selectPlans(Auth::user()->id),
            'country' => Country::with('states')->first()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        try {
            $this->userService->createUser($data, UserType::SUPERDISTRIBUTOR->value);
            ToasterService::success('Create success');
            return redirect()->route('admin.super-distributors.index');

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    public function show(user $user)
    {
        return view('admin.superdistributor.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $super_distributor, PlanService $planService)
    {
        return view('admin.superdistributor.edit', [
            'user' => $super_distributor,
            'plans' => $planService->selectPlans(Auth::user()->id),
            'country' => Country::with('states')->first(),
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $super_distributor)
    {
        $data = $request->validate($this->rules($super_distributor->id));
        try {
            $this->userService->updateUser($super_distributor, $data);
            ToasterService::success('Update success');
            return redirect()->route('admin.super-distributors.index');
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $super_distributor)
    {
        try {
            $this->userService->deleteUser($super_distributor);
            return response()->json([
                'message' => 'User deactivated successfully.',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'status' => 'error',
            ]);
        }
    }
    private function rules($userId = null)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($userId)],
            'password' => $userId ? 'nullable' : ['required', Rules\Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'wallet' => 'nullable|numeric|min:0',
            'plan' => ['required', Rule::exists(Plan::class, 'id')],
            'is_active' => 'required|boolean',
        ];
    }
}
