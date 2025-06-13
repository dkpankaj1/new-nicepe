<x-app-layout>
    @section('title', 'Roles')
    @section('page-title', 'Roles')
    @section('breadcrumb', Breadcrumbs::render('admin.roles.index'))
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{route('admin.roles.create')}}" class="btn btn-primary px-3"> Add</a>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <x-datatable id="datatable" ajaxUrl="{{route('admin.roles.index')}}" :columns="[
        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
        ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
        ['data' => 'guard_name', 'name' => 'guard_name', 'title' => 'Guard'],
        ['data' => 'users', 'name' => 'users', 'title' => 'Users Count'],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
        ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
    ]" />
            </div>
        </div>
    </div>
    <x-confirm-delete />
</x-app-layout>