<?php
namespace App\Datatables\ApiClient;

use App\Datatables\BaseWalletDatatable;

class WalletDatatable extends BaseWalletDatatable
{
    public function __construct(){
        parent::__construct('apiclient.wallet.show');
    }

}