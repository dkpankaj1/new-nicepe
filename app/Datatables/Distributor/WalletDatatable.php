<?php
namespace App\Datatables\Distributor;

use App\Datatables\BaseWalletDatatable;

class WalletDatatable extends BaseWalletDatatable
{
    public function __construct(){
        parent::__construct('distributor.wallet.show');
    }

}