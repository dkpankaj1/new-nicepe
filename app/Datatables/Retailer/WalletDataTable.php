<?php
namespace App\Datatables\Retailer;

use App\Datatables\BaseWalletDatatable;

class WalletDataTable extends BaseWalletDatatable
{
    public function __construct(){
        parent::__construct('retailer.wallet.show');
    }
}