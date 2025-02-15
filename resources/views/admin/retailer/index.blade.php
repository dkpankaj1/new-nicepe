<x-app-layout>
    @section('title', 'Retailers')
    @section('page-title', 'Retailers')
    @section('breadcrumb', Breadcrumbs::render('admin.retailers.index'))
    <!-- Start Content-->

    <div class="container-fluid">
        <div class="card">
            @can('retailers.create')
                <div class="card-header">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('admin.retailers.create')}}" class="btn btn-primary px-3"> Add</a>
                    </div>
                </div><!-- end card header -->
            @endcan
            <div class="card-body">
                <x-datatable id="datatable" ajaxUrl="{{route('admin.retailers.index')}}" :columns="[
        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
        ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
        ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
        ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
        ['data' => 'city', 'name' => 'city', 'title' => 'City'],
        ['data' => 'wallet', 'name' => 'wallet', 'title' => 'Wallet ( ' . $generalSetting->currency->symbol . ' )'],
        ['data' => 'plan', 'name' => 'plan', 'title' => 'Plan'],
        ['data' => 'state', 'name' => 'state', 'title' => 'State'],
        ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
        ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
    ]" />
            </div>
        </div>
    </div>

    <x-confirm-delete />

</x-app-layout>