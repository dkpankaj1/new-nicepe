<x-app-layout>

    @section('title', 'Dashboard')
    @section('page-title', 'Dashboard')
    @section('breadcrumb',Breadcrumbs::render('admin.dashboard'))

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-muted mb-3 fw-semibold">User</p>
                            <h4 class="m-0 mb-3 fs-18">New Users</h4>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-top-right text-success"></i>+
                                    12%</span>Last month
                            </p>
                        </div>

                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="total_space" class="me-2"></div>
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
                            <h4 class="m-0 mb-3 fs-18">Super Distributor</h4>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-bottom-left text-danger"></i>-
                                    25%</span>Last month
                            </p>
                        </div>

                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="video_space" class="me-2"></div>
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
                            <h4 class="m-0 mb-3 fs-18">Distributor</h4>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-top-right text-success"></i> +
                                    45%</span>last month
                            </p>
                        </div>

                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="music_space" class="me-2"></div>
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
                            <h4 class="m-0 mb-3 fs-18">Retailer</h4>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-top-right text-success"></i> +
                                    25%</span>last month
                            </p>
                        </div>

                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="document_space" class="me-2"></div>
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
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center my-1">
                                                <div
                                                    class="avatar-sm rounded me-3 align-items-center justify-content-center d-flex">
                                                    <img src="assets/images/users/user-11.jpg"
                                                        class="img-fluid rounded-circle" alt="">
                                                </div>
                                                <div>
                                                    <h5 class="fs-14 mb-1">Noam Henson</h5>
                                                    <span class="text-muted">14 Verified Purchases</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal my-1">$88K</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center my-1">
                                                <div
                                                    class="avatar-sm rounded me-3 align-items-center justify-content-center d-flex">
                                                    <img src="assets/images/users/user-12.jpg"
                                                        class="img-fluid rounded-circle" alt="">
                                                </div>
                                                <div>
                                                    <h5 class="fs-14 mb-1">Israel Faizul</h5>
                                                    <span class="text-muted">23 Verified Purchases</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal my-1">$104K</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center my-1">
                                                <div
                                                    class="avatar-sm rounded me-3 align-items-center justify-content-center d-flex">
                                                    <img src="assets/images/users/user-13.jpg"
                                                        class="img-fluid rounded-circle" alt="">
                                                </div>
                                                <div>
                                                    <h5 class="fs-14 mb-1">Pascal Kremp</h5>
                                                    <span class="text-muted">13 Verified Purchases</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal my-1">$67K</p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center my-1">
                                                <div
                                                    class="avatar-sm rounded me-3 align-items-center justify-content-center d-flex">
                                                    <img src="assets/images/users/user-14.jpg"
                                                        class="img-fluid rounded-circle" alt="">
                                                </div>
                                                <div>
                                                    <h5 class="fs-14 mb-1">Jenny Dubois</h5>
                                                    <span class="text-muted">08 Verified Purchases</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal my-1">$48K</p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="border-0">
                                            <div class="d-flex align-items-center my-1">
                                                <div
                                                    class="avatar-sm rounded me-3 align-items-center justify-content-center d-flex">
                                                    <img src="assets/images/users/user-15.jpg"
                                                        class="img-fluid rounded-circle" alt="">
                                                </div>
                                                <div>
                                                    <h5 class="fs-14 mb-1">Felipa Silva</h5>
                                                    <span class="text-muted">08 Verified Purchases</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <p class="fw-normal my-1">$95K</p>
                                        </td>
                                    </tr>
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
                                        <th class="py-2 border-0">Date</th>
                                        <th class="py-2 border-0">Payload</th>
                                        <th class="py-2 border-0">Ip Address</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="fs-14 my-1">02-02-2025</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fs-14 my-1 fw-normal">NAN</p>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle fs-13 px-2 rounded-5 text-success fw-medium">192.168.0.158</span>
                                        </td>
                                    </tr>


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

    @endpush)
</x-app-layout>