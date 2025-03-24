<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Datatables\SuperDistributor\PlanDatatable;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Services\PlanService;
use App\Services\ToasterService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
{
    protected $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PlanDatatable $plansDatatable)
    {
        if ($request->expectsJson()) {
            return $plansDatatable->get();
        }

        return view('shared.plans.index', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.plans.index'),
            'createBtnUrl' => route('superdistributor.plans.create'),
            'ajaxUrl' => route('superdistributor.plans.index'),
            'columns' => [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
                ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
                ['data' => 'action', 'name' => 'action', 'title' => '#', 'searchable' => false, 'orderable' => false],
            ]
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(Auth::id());

        $features = $user->plan?->planDetails()
            ->whereNull('deleted_at')
            ->get()
            ->filter(fn($planDetail) => $planDetail->feature->enable)
            ->map(fn($planDetail) => (object) [
                "id" => $planDetail->feature->id,
                "name" => $planDetail->feature->name,
                "fee" => $planDetail->fee,
            ]) ?? collect();

        return view('shared.plans.create', [
            'breadcrumb' => Breadcrumbs::render('superdistributor.plans.create'),
            'actionUrl' =>  route('superdistributor.plans.store'),
            'featurs' => $features
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'feature' => 'required|array',
                'feature.*.fee' => 'required|numeric|min:0',
                'feature.*.select' => 'nullable',
            ],
            [
                'feature.*.fee.required_if' => 'The fee for feature is required when the feature is enabled.',
            ]
        );

        try {
            $user = User::find(Auth::id());

            // Get only those feature IDs that are available in the user's current plan
            $allowedFeatureIds = $user->plan->planDetails()
                ->whereNull('deleted_at')
                ->pluck('feature_id')
                ->toArray();

            $plan = $this->planService->create([
                'user_id' => $user->id,
                'name' => $request->name,
                'description' => $request->description
            ]);

            // Create Plan Details
            foreach ($validated['feature'] as $featureId => $feature) {
                if (isset($feature['select']) && in_array($featureId, $allowedFeatureIds)) {
                    $plan->planDetails()->create([
                        'feature_id' => $featureId,
                        'fee' => $feature['fee'],
                    ]);
                }
            }

            ToasterService::success('Create success');
            return redirect()->route('superdistributor.plans.index');
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong. Please try again.');
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        Gate::authorize('view', $plan);
        return view('shared.plans.show', [
            'plan' => $plan,
            'breadcrumb' => Breadcrumbs::render('superdistributor.plans.show', $plan)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        Gate::authorize('update', $plan);
        return view('shared.plans.edit', [
            'plan' => $plan,
            'breadcrumb' => Breadcrumbs::render('superdistributor.plans.edit', $plan),
            'actionUrl' => route('superdistributor.plans.update', $plan->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        Gate::authorize('update', $plan);

        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'detail.*.fee' => 'required|numeric|min:0',
            ],
            [
                'detail.*.fee.required_' => 'The fee for feature is required.',
            ]
        );

        try {

            $plan->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            // Update Plan Details
            if ($request->has('detail')) {
                foreach ($request->input('detail') as $detailId => $detailData) {
                    $planDetail = $plan->planDetails()->find($detailId);
                    if ($planDetail) {
                        $planDetail->update([
                            'fee' => $detailData['fee'] ?? 0,
                        ]);
                    }
                }
            }

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
    public function destroy( Plan $plan)
    {
        Gate::authorize('delete', $plan);

        try {
            throw_if($plan->id == 1, "could not be delete");

            $this->planService->delete($plan);

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
