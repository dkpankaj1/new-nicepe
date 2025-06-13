<x-app-layout>
    @section('title', 'Balance Transfer')
    @section('page-title', 'Balance Transfer')
    @section('breadcrumb', Breadcrumbs::render('distributor.balance-transfers.index'))
    <!-- Start Content-->

    <div class="container-fluid">
        <div class="card">
            @can('balance-transfers.index')
                <div class="card-header">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('distributor.balance-transfers.create')}}" class="btn btn-primary px-3"> Add</a>
                    </div>
                </div><!-- end card header -->
            @endcan
            <div class="card-body">
                <x-datatable id="datatable" ajaxUrl="{{route('distributor.balance-transfers.index')}}" :columns="[
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
                    ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                    ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                    ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount (' . $generalSetting->currency->symbol . ')'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
                    ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
                    ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
                ]" />
            </div>
        </div>
    </div>

    <x-confirm-delete />

</x-app-layout>