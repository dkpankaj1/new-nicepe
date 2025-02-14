<?php
namespace App\Datatables;

use App\Models\Feature;
use Yajra\DataTables\DataTableAbstract;

class FeatureDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Feature::query());
    }

    protected function configure($dataTable): DataTableAbstract
    {
        return $dataTable
            ->addIndexColumn()
            ->addColumn('active', fn($feature) => view('components.badges', [
                'type' => $feature->enable ? "success" : "danger",
                'text' => $feature->enable ? "Active" : "In-active",
            ]))
            ->addColumn('action', function ($feature) {
                return
                    view('components.show-btn', ['url' => route('admin.features.show', $feature)]).
                    view('components.edit-btn', ['url' => route('admin.features.edit', $feature)]);
            });
    }
}
