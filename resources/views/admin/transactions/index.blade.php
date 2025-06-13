<x-app-layout>
    @section('title', 'Transactions')
    @section('page-title', 'Transactions')
    @section('breadcrumb', Breadcrumbs::render('admin.transactions.index'))
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <x-datatable id="datatable" ajaxUrl="{{route('admin.transactions.index')}}" :columns="[
        [
            'data' => 'DT_RowIndex',
            'name' => 'DT_RowIndex',
            'title' => '#',
            'searchable' => false,
            'orderable' => false
        ],
        [
            'data' => 'user',
            'name' => 'user',
            'title' => 'Name',
        ],
        [
            'data' => 'email',
            'name' => 'email',
            'title' => 'Email',
        ],
        [
            'data' => 'user_type',
            'name' => 'user_type',
            'title' => 'User Type',
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
        // [
        //     'data' => 'fee',
        //     'name' => 'fee',
        //     'title' => 'Fee',
        // ],
        // [
        //     'data' => 'tax',
        //     'name' => 'tax',
        //     'title' => 'Tax',
        // ],
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
    </div>
</x-app-layout>