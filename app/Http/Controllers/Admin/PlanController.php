<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\PlanServiceInterface;
use App\Datatables\PlansDatatable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Plan;
use App\Services\PlanService;
use App\Services\ToasterService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    use AuthorizationFilter;
    protected $planService;
    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;

        $this->applyAuthorization([
            'index' => 'plans.read',
            'show' => 'plans.read',
            'create' => 'plans.create',
            'store' => 'plans.create',
            'edit' => 'plans.edit',
            'update' => 'plans.edit',
            'destroy' => 'plans.delete',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PlansDatatable $plansDatatable)
    {
        if ($request->expectsJson()) {
            return $plansDatatable->get();
        }
        return view('admin.plans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create', ['featurs' => Feature::all()]);
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
            ],
            [
                'feature.*.fee.required_if' => 'The fee for feature is required when the feature is enabled.',
            ]
        );

        try {

            $plan = $this->planService->create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'description' => $request->description
            ]);

            // Create Plan Details
            foreach ($validated['feature'] as $featureId => $feature) {
                $plan->planDetails()->create([
                    'feature_id' => $featureId,
                    'fee' => $feature['fee'],
                ]);
            }

            ToasterService::success('Create success');
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        $plan->load('planDetails');
        return view('admin.plans.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        $plan->load('planDetails');
        return view('admin.plans.edit', [
            'plan' => $plan,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
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
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        try {
            throw_if($plan->id == 1, "could not be delete");

            $this->planService->delete($plan);

            return response()->json([
                'message' => 'Delete success.',
                'status' => 'success',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'status' => 'error',
            ]);
        }
    }
}
