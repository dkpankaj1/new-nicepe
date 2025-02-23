<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\DistributorDatatable;
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

class DistributorController extends Controller
{
    use AuthorizationFilter;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->applyAuthorization([
            'index' => 'distributors.read',
            'show' => 'distributors.read',
            'create' => 'distributors.create',
            'store' => 'distributors.create',
            'edit' => 'distributors.edit',
            'update' => 'distributors.edit',
            'destroy' => 'distributors.delete',
        ]);

    }
    public function index(Request $request, DistributorDatatable $distributorDatatable)
    {
        return $request->expectsJson()
            ? $distributorDatatable->get()
            : view('admin.distributor.index');
    }

    public function create(Request $request, PlanService $planService)
    {
        return view('admin.distributor.create', [
            'plans' => $planService->selectPlans($request->user()->id),
            'country' => Country::with('states')->first()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        try {
            $this->userService->createUser($data, UserType::DISTRIBUTOR->value);
            ToasterService::success('Create success');
            return redirect()->back();

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }

    }

    public function show(User $user)
    {
        return view('admin.distributor.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $distributor, PlanService $planService)
    {
        return view('admin.distributor.edit', [
            'user' => $distributor,
            'plans' => $planService->selectPlans(Auth::user()->id),
            'country' => Country::with('states')->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $distributor)
    {
        $data = $request->validate($this->rules($distributor->id));
        try {
            $this->userService->updateUser($distributor, $data);
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
    public function destroy(user $distributor)
    {
        try {
            $this->userService->deleteUser($distributor);
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
