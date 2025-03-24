<?php
namespace App\Datatables\Distributor;

use App\Datatables\BaseDatatable;
use App\Models\Plan;
use Yajra\DataTables\DataTableAbstract;

class PlanDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Plan::query()->withCurrentUser());
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
                $action = view('components.link', ['href' => route('distributor.plans.show', $plan->id), 'label' => 'show', 'class' => 'btn btn-sm btn-info']);
                
                if ($plan->deleted_at == null) {
                    $action = $action .
                        view('components.link', ['href' => route('distributor.plans.edit', $plan->id), 'label' => 'edit', 'class' => 'btn btn-sm btn-warning']) .
                        view('components.user-btn-delete', ['url' => route('distributor.plans.destroy', $plan->id)]);
                }

                return $action;
            });
    }
}