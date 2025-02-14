@push('pageCss')
    <!-- Datatables css -->
    <link href="{{ asset('backend/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush


<table id="{{ $id }}" class="table table-striped dt-responsive nowrap w-100">
</table>

@push('pageScript')

    <!-- Datatables js -->
    <script src="{{ asset('backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <!-- dataTables.bootstrap5 -->
    <script src="{{ asset('backend/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>

    <!-- buttons.bootstrap5 -->
    <script src="{{ asset('backend/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>

    <!-- dataTable.responsive -->
    <script src="{{ asset('backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>


    <script>
        $(document).ready(function () {
            $('#{{ $id }}').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ $ajaxUrl }}',
                    type: "GET",
                    dataType: "json"
                },
                columns: {!! json_encode($columns) !!}
            });
        });
    </script>
    
@endpush