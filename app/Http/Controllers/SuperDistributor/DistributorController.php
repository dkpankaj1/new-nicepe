<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Datatables\SuperDistributor\DistributorDatatable;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Plan;
use App\Models\User;
use App\Services\PlanService;
use App\Services\ToasterService;
use App\Services\UserService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class DistributorController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.   
     */
    public function index(Request $request, DistributorDatatable $datatable)
    {
        if ($request->expectsJson()) {
            return $datatable->get();
        }
        return view(
            'super-distributor.distributor.index',
            [
                'breadcrumb' => Breadcrumbs::render('superdistributor.distributors.index'),
                'ajaxUrl' => route('superdistributor.distributors.index'),
                'columns' => $datatable->columns()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PlanService $planService)
    {
        return view(
            'super-distributor.distributor.create',
            [
                'breadcrumb' => Breadcrumbs::render('superdistributor.distributors.create'),
                'country' => Country::with('states')->first(),
                'plans' => $planService->selectPlans(Auth::user()->id)
            ],
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        try {
            $this->userService->createUser($data, UserType::DISTRIBUTOR->value);
            ToasterService::success(__('message.success.default'));
            return redirect()->back();

        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $distributor)
    {
        return view('super-distributor.distributor.show', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.distributors.show', $distributor)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $distributor, PlanService $planService)
    {
        return view('super-distributor.distributor.edit', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.distributors.edit', $distributor),
            'user' => $distributor,
            'plans' => $planService->selectPlans(Auth::user()->id),
            'country' => Country::with('states')->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $distributor)
    {
        $data = $request->validate($this->rules($distributor->id));
        try {
            $this->userService->updateUser($distributor, $data);
            ToasterService::success(__('message.success.default'));
            return redirect()->back();
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $distributor)
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
            'plan' => [
                'required',
                Rule::exists('plans', 'id')
                    ->whereNull('deleted_at')
                    ->where('is_active', true)
                    ->where('user_id', Auth::id()),
            ],
            'is_active' => 'required|boolean',
        ];
    }

}
