<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\RewardDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Reward;
use App\Services\ToasterService;
use App\Traits\AuthorizationFilter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RewardController extends Controller
{
    use AuthorizationFilter;
    public function __construct()
    {
        $this->applyAuthorization([
            'index' => 'rewards.read',
            'show' => 'rewards.read',
            'create' => 'rewards.create',
            'store' => 'rewards.create',
            'edit' => 'rewards.edit',
            'update' => 'rewards.edit',
            'destroy' => 'rewards.delete',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RewardDataTable $dataTable)
    {
        return $request->expectsJson()
            ? $dataTable->get()
            : view('admin.reward.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $feautres = Feature::all();
        return view('admin.reward.create', ['features' => $feautres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'feature_id' => ['required', 'integer', Rule::exists(Feature::class, 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'point' => ['required', 'integer', Rule::when($request->reward_type == 1, ['between:1,100'])],
            'reward_type' => ['required', 'integer', Rule::in([0, 1])],
            'expiry_date' => ['required', 'date'],
            'enable' => ['required', 'boolean'],
        ]);

        try {
            Reward::create([
                'feature_id' => $request->feature_id,
                'name' => $request->name,
                'description' => $request->description,
                'point' => $request->point,
                'reward_type' => $request->reward_type,
                'expiry_date' => $request->expiry_date,
                'enable' => $request->enable,
            ]);
            ToasterService::success(__('message.success.default'));
            return redirect()->back();
        } catch (Exception $e) {
            ToasterService::error(__('message.error.default'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reward $reward)
    {
        return view('admin.reward.show', ['reward' => $reward]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reward $reward)
    {
        return view('admin.reward.edit', 
        [
            'features' => Feature::all(),
            'reward' => $reward
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'point' => ['required', 'integer', Rule::when($request->reward_type == 1, ['between:1,100'])],
            'reward_type' => ['required', 'integer', Rule::in([0, 1])],
            'expiry_date' => ['required', 'date'],
            'enable' => ['required', 'boolean'],
        ]);
        try {
            $reward->update([
                'name' => $request->name,
                'description' => $request->description,
                'point' => $request->point,
                'reward_type' => $request->reward_type,
                'expiry_date' => $request->expiry_date,
                'enable' => $request->enable,
            ]);
            ToasterService::success(__('message.success.default'));
            return redirect()->back();
        } catch (Exception $e) {
            ToasterService::error(__('message.error.default'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reward $reward)
    {
        try {


            return response()->json([
                'message' => __('message.success.default'),
                'status' => 'success',
            ]);

        } catch (Exception $e) {

            return response()->json([
                'message' => __('message.error.default'),
                'status' => 'error',
            ]);
        }
    }
}
