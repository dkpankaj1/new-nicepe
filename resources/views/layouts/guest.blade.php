<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Starter | Kadso - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{asset('backend/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    @stack('pageCss')

    <!-- Icons -->
    <link href="{{asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<!-- body start -->

<body data-menu-color="dark" data-sidebar="default">

    {{$slot}}

    <!-- Vendor -->
    <script src="{{asset('backend/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('backend/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('backend/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('backend/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/libs/toastr/toastr.min.js')}}"></script>

    <x-toaster />

    @stack('pageScript')

    <!-- App js-->
    <script src="{{asset('backend/js/app.js')}}"></script>

</body>

</html>