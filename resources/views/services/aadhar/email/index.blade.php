<x-app-layout>

    @section('title', 'Email Address Update')
    @section('page-title', 'Email Address Update')

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
