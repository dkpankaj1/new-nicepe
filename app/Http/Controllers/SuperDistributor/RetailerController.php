<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Datatables\SuperDistributor\RetailerDatatable;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\PlanService;
use App\Services\ToasterService;
use App\Services\UserService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RetailerController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RetailerDatatable $datatable)
    {
        if ($request->expectsJson()) {
            return $datatable->get();
        }
        return view('shared.retailer.index', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.retailers.index'),
            'createRetailerUrl' => route('superdistributor.retailers.create'),
            'ajaxUrl' => route('superdistributor.retailers.index'),
            'columns' => $datatable->columns()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PlanService $planService)
    {
        return view('shared.retailer.create', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.retailers.create'),
            'country' => Country::with('states')->first(),
            'plans' => $planService->selectPlans(Auth::user()->id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        try {
            $this->userService->createUser($data, UserType::RETAILER->value);
            ToasterService::success(__('message.success.default'));
            return redirect()->back();
        } catch (\Exception $e) {
            ToasterService::error(__('message.error.default'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $retailer)
    {
        return view('shared.retailer.show', ['breadcrumb' => Breadcrumbs::render('superdistributor.retailers.show', $retailer)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $retailer, PlanService $planService)
    {
        return view('shared.retailer.edit', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.retailers.edit', $retailer),
            'user' => $retailer,
            'plans' => $planService->selectPlans(Auth::user()->id),
            'country' => Country::with('states')->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $retailer)
    {
        $data = $request->validate($this->rules($retailer->id));
        try {
            $this->userService->updateUser($retailer, $data);
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
    public function destroy(User $retailer)
    {
        try {
            $this->userService->deleteUser($retailer);
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
