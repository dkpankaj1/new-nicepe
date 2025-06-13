<?php
namespace App\Datatables\Retailer;

use App\Datatables\BaseDatatable;
use App\Models\AadharMobileUpdate;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;

class AdharMobileUpdateDataTable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(AadharMobileUpdate::query()->where('user_id', Auth::user()->id));
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable
            ->addIndexColumn();
            
            // ->addColumn('action', function ($user) {
            //     return view('components.show-btn', ['url' => route('admin.super-distributors.show', $user->id), 'permission' => 'super-distributors.read']) .
            //         view('components.edit-btn', ['url' => route('admin.super-distributors.edit', $user->id), 'permission' => 'super-distributors.edit']) .
            //         view('components.delete-btn', ['url' => route('admin.super-distributors.destroy', $user->id), 'permission' => 'super-distributors.delete']);
            // });
    }
}