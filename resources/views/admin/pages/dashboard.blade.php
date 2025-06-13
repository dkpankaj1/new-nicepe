<x-app-layout>

    @section('title', 'Dashboard')
    @section('page-title', 'Dashboard')
    @section('breadcrumb', Breadcrumbs::render('admin.dashboard'))

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-muted mb-3 fw-semibold">User</p>
                            <h4 class="m-0 mb-3 fs-18">Api Client
                                <a href="{{route('admin.api-clients.index')}}"> ( {{$apiClientCount}} )</a>
                            </h4>
                        </div>

                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="widget-box">
                                <div class="widget-icon mb-2 bg-success-subtle">
                                    <i class="mdi mdi-folder-account icons text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-muted mb-3 fw-semibold">User</p>
                            <h4 class="m-0 mb-3 fs-18">Super Distributor
                                <a href="{{route('admin.super-distributors.index')}}">
                                    ( {{$superDistributorCount}} )
                                </a>
                            </h4>
                        </div>

                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="widget-box">
                                <div class="widget-icon mb-2 bg-info-subtle">
                                    <i class="mdi mdi-folder-account icons text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-muted mb-3 fw-semibold">user</p>
                            <h4 class="m-0 mb-3 fs-18">Distributor
                                <a href="{{route('admin.distributors.index')}}">
                                    ( {{$distributorCount}} )
                                </a>
                            </h4>
                        </div>

                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="widget-box">
                                <div class="widget-icon mb-2 bg-primary-subtle">
                                    <i class="mdi mdi-folder-account icons text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-muted mb-3 fw-semibold">User</p>
                            <h4 class="m-0 mb-3 fs-18">Retailer
                                <a href="{{route('admin.retailers.index')}}">
                                    ( {{$retailerCount}} )
                                </a>
                            </h4>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="widget-box">
                                <div class="widget-icon mb-2 bg-warning-subtle">
                                    <i class="mdi mdi-folder-account icons text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Services Used</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="justify-content-center">
                        <div id="customer_rate" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Recent Users</h5>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="justify-content-center">
                        <div class="table-responsive card-table">
                            <table class="table align-middle table-nowrap mb-0">
                                <tbody>
                                    @foreach ($recentUsers as $recentUser)                                        
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center my-1">
                                                    <div
                                                        class="avatar-sm rounded me-3 align-items-center justify-content-center d-flex">
                                                        <img src="{{$recentUser->avatar}}" class="img-fluid rounded-circle"
                                                            alt="">
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 mb-1">{{$recentUser->name}} ({{$recentUser->type}})
                                                        </h5>
                                                        <span class="text-muted">{{$recentUser->email}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="fw-normal my-1">{{$generalSetting->currency->symbol}}
                                                    {{$recentUser->wallet}}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="card overflow-hidden">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">User Activity</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="justify-content-center">
                        <div class="table-responsive card-table">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-2 border-0">Date/Time</th>
                                        <th class="py-2 border-0">Type</th>
                                        <th class="py-2 border-0">Ip Address</th>
                                        <th class="py-2 border-0">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($activityLogs as $activityLog)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h5 class="fs-14 my-1">{{$activityLog->created_at->diffForHumans()}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="fs-14 my-1 fw-normal">{{$activityLog->action}}</p>
                                            </td>
                                            <td>
                                                {{$activityLog->ip_address}}
                                            </td>
                                            <td>
                                               <a href="" class="btn btn-sm btn-primary">show</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-6">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Transaction</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="justify-content-center">
                        <div id="author_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('pageScript')
        <!-- Apexcharts JS -->
        <script src="{{asset('backend/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- for basic area chart -->
        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

        <!-- Widgets Init Js -->
        <script src="{{asset('backend/js/pages/dashboard.init.js')}}"></script>

    @endpush
</x-app-layout>