<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | Admin Dashboard Template</title>
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

    <!-- Begin page -->
    <div id="app-layout">


        <!-- Topbar Start -->
        @if (Auth::user()->type == App\Enums\UserType::ADMIN->value)
            @include('layouts._admin.topbar')
        @endif
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        @if (Auth::user()->type == App\Enums\UserType::ADMIN->value)
            @include('layouts._admin.sidebar')
        @endif
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content px-2">

                <!-- Start Content-->

                <div class="container-fluid">
                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">@yield('page-title')</h4>
                        </div>
                        <div class="text-end">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>

                {{$slot}}

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            <script>document.write(new Date().getFullYear())</script> - Made with <span
                                class="mdi mdi-heart text-danger"></span> by <a href="https://www.github.com/dkpankaj1"
                                target="_blank" class="text-reset fw-semibold">Dipankar pankaj</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

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