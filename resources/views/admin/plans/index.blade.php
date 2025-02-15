<x-app-layout>

    @section('title', 'Plans')
    @section('page-title', 'Plans')
    @section('breadcrumb', Breadcrumbs::render('admin.plans.index'))

    <div class="card">
        @can('plans.create')
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{route('admin.plans.create')}}" class="btn btn-primary px-3"> Add</a>
                </div>
            </div><!-- end card header -->
        @endcan
        <div class="card-body">
            <x-datatable id="datatable" ajaxUrl="{{route('admin.plans.index')}}" :columns="[
        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
        ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
        ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
    ]" />
        </div>
    </div>

    <x-confirm-delete />
</x-app-layout>