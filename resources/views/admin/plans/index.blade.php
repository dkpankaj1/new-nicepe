<x-app-layout>

    @section('title', 'Plans')
    @section('page-title', 'Plans')
    @section('breadcrumb', Breadcrumbs::render('admin.plans.index'))

    <div class="card">
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