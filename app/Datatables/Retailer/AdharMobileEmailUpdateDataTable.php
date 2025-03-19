<?php
namespace App\Datatables\Retailer;

use App\Datatables\BaseDatatable;
use App\Models\AadharMobileEmailUpdate;
use Yajra\DataTables\DataTableAbstract;

class AdharMobileEmailUpdateDataTable extends BaseDatatable
{
    public function __construct()
    {
        $query = AadharMobileEmailUpdate::query();
        parent::__construct($query);
    }

    public function configure($datatable): DataTableAbstract
    {
        return $datatable->addIndexColumn();
        // Implement your action logic here
    }
}