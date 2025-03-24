<x-app-layout>

    @section('title', 'Plans')
    @section('page-title', 'Plans')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="card">

        @can('plans.create')
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ $createBtnUrl }}" class="btn btn-primary px-3"> Add</a>
                </div>
            </div><!-- end card header -->
        @endcan

        <div class="card-body">
            <x-datatable id="datatable" ajaxUrl="{{ $ajaxUrl }}" :columns="$columns" />
        </div>

    </div>

    <x-confirm-delete />

</x-app-layout>
