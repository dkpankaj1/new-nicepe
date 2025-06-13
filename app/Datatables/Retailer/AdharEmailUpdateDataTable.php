<?php
namespace App\Datatables\Retailer;

use App\Datatables\BaseDatatable;
use App\Models\AadharEmailUpdate;
use Yajra\DataTables\DataTableAbstract;

class AdharEmailUpdateDataTable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(AadharEmailUpdate::query());
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable->addIndexColumn();
    }
}