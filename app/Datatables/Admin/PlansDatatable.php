<?php
namespace App\Datatables\Admin;

use App\Datatables\BaseDatatable;
use App\Models\Plan;
use Yajra\DataTables\DataTableAbstract;

class PlansDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Plan::query()->latest());
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn()
            ->addColumn('created_at', fn($plan) => $plan->created_at->diffForHumans())
            ->addColumn('updated_at', fn($plan) => $plan->updated_at->diffForHumans())
            ->addColumn('status', fn($plan) => $plan->deleted_at == null
                ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                : view('components.badges', ['type' => 'danger', 'text' => 'deleted']))
            ->addColumn('action', function ($plan) {
                return view('components.show-btn', ['url' => route('admin.plans.show', $plan), 'permission' => 'plans.read']) .
                    view('components.edit-btn', ['url' => route('admin.plans.edit', $plan), 'permission' => 'plans.edit']) .
                    view('components.delete-btn', ['url' => route('admin.plans.destroy', $plan), 'permission' => 'plans.delete']);
            });
    }
}