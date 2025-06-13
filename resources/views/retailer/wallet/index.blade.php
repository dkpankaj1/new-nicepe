<x-app-layout>
    @section('title', 'Wallet')
    @section('page-title', 'Wallet')
    @section('breadcrumb',Breadcrumbs::render('retailer.wallet.index'))

    <div class="card">
        <div class="card-body">

        </div>
    </div>

    <div class="card">
        <div class="card-body">


            <x-datatable id="datatable" ajaxUrl="{{route('retailer.wallet.index')}}" :columns="[
        [
            'data' => 'DT_RowIndex',
            'name' => 'DT_RowIndex',
            'title' => '#',
            'searchable' => false,
            'orderable' => false
        ],
        [
            'data' => 'transaction_id',
            'name' => 'transaction_id',
            'title' => 'Transaction ID',
        ],
        [
            'data' => 'transaction_type',
            'name' => 'transaction_type',
            'title' => 'Tnx Type',
        ],
        [
            'data' => 'transaction_direction',
            'name' => 'transaction_direction',
            'title' => 'Direction',
        ],
        [
            'data' => 'amount',
            'name' => 'amount',
            'title' => 'Amt',
        ],
        [
            'data' => 'fee',
            'name' => 'fee',
            'title' => 'Fee',
        ],
        [
            'data' => 'tax',
            'name' => 'tax',
            'title' => 'Tax',
        ],
        [
            'data' => 'opening_balance',
            'name' => 'opening_balance',
            'title' => 'Opening Balance',
        ],
        [
            'data' => 'closing_balance',
            'name' => 'closing_balance',
            'title' => 'Closing Balance',
        ],
        [
            'data' => 'status',
            'name' => 'status',
            'title' => 'Status',
        ],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
        // ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
    ]" />


        </div>
    </div>
</x-app-layout>