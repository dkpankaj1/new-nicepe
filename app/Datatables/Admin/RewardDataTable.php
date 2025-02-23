<?php
namespace App\Datatables\Admin;

use App\Datatables\BaseDatatable;
use App\Models\GeneralSetting;
use App\Models\Reward;
use Yajra\DataTables\DataTableAbstract;

class RewardDataTable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Reward::query());
    }

    public function configure($datatable): DataTableAbstract
    {
        $generalSetting = GeneralSetting::first();
        $currencyCode = $generalSetting->currency->code ?? "";
        return
            $datatable
                ->addIndexColumn()
                ->addColumn('feature', function ($reward) {
                    return $reward->feature->name;
                })
                ->addColumn('reward', function ($reward) use ($currencyCode) {
                    return $reward->reward_type ? "$reward->point (%)" : "$reward->point ($currencyCode)";
                })
                ->addColumn('created_at', function ($reward) {
                    return $reward->updated_at ? $reward->created_at->diffForHumans() : 'N/A';
                })
                ->addColumn('updated_at', function ($reward) {
                    return $reward->updated_at ? $reward->updated_at->diffForHumans() : 'N/A';
                })
                ->addColumn('status', fn($reward) => $reward->enable
                    ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                    : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

                ->addColumn('action', function ($reward) {
                    return view('components.show-btn', ['url' => route('admin.rewards.show', $reward->id), 'permission' => 'rewards.read']) .
                        view('components.edit-btn', ['url' => route('admin.rewards.edit', $reward->id), 'permission' => 'rewards.edit']) .
                        view('components.delete-btn', ['url' => route('admin.rewards.destroy', $reward->id), 'permission' => 'rewards.delete']);
                });
    }
}