<x-app-layout>

    @section('title', 'Mobile/Email Update')
    @section('page-title', 'Mobile/Email Update')

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">

            </div><!-- end card header -->
            <div class="card-body">
                <x-datatable id="datatable" ajaxUrl="{{ $url }}" :columns="$columns" />
            </div>
        </div>
    </div>
</x-app-layout>
