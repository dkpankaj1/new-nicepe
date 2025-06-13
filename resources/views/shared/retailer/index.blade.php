<x-app-layout>

    @section('title', 'Retailers')
    @section('page-title', 'Retailers')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ $createRetailerUrl }}" class="btn btn-primary">Add Retailer</a>
        </div>
        <div class="card-body">
            <x-datatable id="datatable" ajaxUrl="{{ $ajaxUrl }}" :columns="$columns" />
        </div>
    </div>

    <x-confirm-delete />

</x-app-layout>
