<x-app-layout>

    @section('title', 'Distributors')
    @section('page-title', 'Distributors')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('superdistributor.distributors.create') }}" class="btn btn-primary">Add Distributor</a>
        </div>
        <div class="card-body">
            <x-datatable id="datatable" ajaxUrl="{{ route('superdistributor.distributors.index') }}" :columns="$columns" />
        </div>
    </div>

    <x-confirm-delete/>

</x-app-layout>
