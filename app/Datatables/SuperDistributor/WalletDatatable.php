<?php
namespace App\Datatables\SuperDistributor;

use App\Datatables\BaseWalletDatatable;

class WalletDatatable extends BaseWalletDatatable
{
    public function __construct(){
        parent::__construct('superdistributor.wallet.show');
    }

}