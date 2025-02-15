<?php
namespace App\Datatables;

use App\Models\Plan;
use Yajra\DataTables\DataTableAbstract;

class PlansDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Plan::query());
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()
            ->addColumn('created_at', fn($feature) => $feature->created_at->diffForHumans())
            ->addColumn('updated_at', fn($feature) => $feature->updated_at->diffForHumans())
            ->addColumn('action', function ($plan) {
                return view('components.show-btn', ['url' => route('admin.plans.show', $plan),'permission' => 'plans.read']) .
                    view('components.edit-btn', ['url' => route('admin.plans.edit', $plan),'permission' => 'plans.edit']) .
                    view('components.delete-btn', ['url' => route('admin.plans.destroy', $plan),'permission' => 'plans.delete']);
            });
    }
}