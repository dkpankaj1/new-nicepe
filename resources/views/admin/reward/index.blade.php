<x-app-layout>

    @section('title', 'Rewards')
    @section('page-title', 'Rewards')
    @section('breadcrumb', Breadcrumbs::render('admin.rewards.index'))

    <div class="container-fluid">
        <div class="card">
            @can('retailers.create')
                <div class="card-header">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('admin.rewards.create')}}" class="btn btn-primary px-3"> Add</a>
                    </div>
                </div><!-- end card header -->
            @endcan
            <div class="card-body">
                <x-datatable id="datatable" ajaxUrl="{{route('admin.rewards.index')}}" :columns="[
        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
        ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
        ['data' => 'feature', 'name' => 'feature', 'title' => 'Feature'],
        ['data' => 'reward', 'name' => 'reward', 'title' => 'Reward'],
        ['data' => 'status', 'name' => 'status', 'title' => 'Reward'],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
        ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]
    ]" />
            </div>
        </div>
    </div>

    <x-confirm-delete />

</x-app-layout>