<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\RetailerDatatable;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    use AuthorizationFilter;

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->applyAuthorization([
            'index' => 'retailers.read',
            'show' => 'retailers.read',
            'create' => 'retailers.create',
            'store' => 'retailers.create',
            'edit' => 'retailers.edit',
            'update' => 'retailers.edit',
            'destroy' => 'retailers.delete',
        ]);

    }
    public function index(Request $request, ApiClientDatatable $apiClientDatatable)
    {
        return $request->expectsJson()
            ? $apiClientDatatable->get()
            : view('admin.apiclient.index');
    }

    public function create(Request $request, PlanService $planService)
    {
        return view('admin.apiclient.create', [
            'plans' => $planService->selectPlans($request->user()->id),
            'country' => Country::with('states')->first()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        try {
            $this->userService->createUser($data, UserType::APICLIENT->value);
            ToasterService::success('Create success');
            return redirect()->route('admin.api-clients.index');

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }

    }

    public function show(user $user)
    {
        return view('admin.apiclient.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $api_client, PlanService $planService)
    {
        return view('admin.apiclient.edit', [
            'user' => $api_client,
            'plans' => $planService->selectPlans(Auth::user()->id),
            'country' => Country::with('states')->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $api_client)
    {
        $data = $request->validate($this->rules($api_client->id));
        try {
            $this->userService->updateUser($api_client, $data);
            ToasterService::success('Update success');
            return redirect()->route('admin.api-clients.index');
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $api_client)
    {
        try {
            $this->userService->deleteUser($api_client);
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
