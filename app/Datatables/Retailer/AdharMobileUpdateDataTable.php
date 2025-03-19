<?php
namespace App\Datatables\Retailer;

use App\Datatables\BaseDatatable;
use App\Models\AadharMobileUpdate;
use Yajra\DataTables\DataTableAbstract;

class AdharMobileUpdateDataTable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(AadharMobileUpdate::query());
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable->addIndexColumn();
    }
}