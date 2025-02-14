<x-app-layout>

    @section('title', 'Feature')
    @section('page-title', 'Feature')
    @section('breadcrumb',Breadcrumbs::render('admin.features.index'))


    <div class="card">
        <div class="card-body">
            <x-data-table id="usersTable" ajax-url="{{route('admin.features.index')}}" :columns="[
        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
        ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
        ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
        ['data' => 'fee', 'name' => 'fee', 'title' => 'Fee ( '.$generalSetting->currency->symbol.' )'],
        ['data' => 'active', 'name' => 'active', 'title' => 'Status'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
    ]" />
        </div>
    </div>

</x-app-layout>