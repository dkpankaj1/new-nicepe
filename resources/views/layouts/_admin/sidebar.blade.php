<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('backend/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('backend/images/logo-light.png')}}" alt="" height="24">
                    </span>
                </a>
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('backend/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="home"></i>
                        <span class="badge bg-success rounded-pill float-end">9+</span>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Accounting</li>

                <li>
                    <a href="#transfer" data-bs-toggle="collapse">
                        <i data-feather="arrow-up-circle"></i>
                        <span> Transfer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="transfer">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">List</a>
                            </li>
                            <li>
                                <a href="#">New Transfer</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#transactionMenu" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> Transaction </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="transactionMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">History</a>
                            </li>
                            <li>
                                <a href="#">Report</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title">Services</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="cpu"></i>
                        <span> Features </span>
                    </a>
                </li>

                <li>
                    <a href="#planMenu" data-bs-toggle="collapse">
                        <i data-feather="box"></i>
                        <span> Plans </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="planMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">List</a>
                            </li>
                            <li>
                                <a href="#">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="menu-title">Peoples</li>

                <li>
                    <a href="#userMenu" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="userMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">List</a>
                            </li>
                            <li>
                                <a href="#">Create</a>
                            </li>

                            <li>
                                <a href="#">Role & Permissions</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#superDistributorMenu" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Super Distributor </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="superDistributorMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">List</a>
                            </li>
                            <li>
                                <a href="#">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#distributorMenu" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Distributor </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="distributorMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">List</a>
                            </li>
                            <li>
                                <a href="#">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#retailerMenu" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Retailer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="retailerMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">List</a>
                            </li>
                            <li>
                                <a href="#">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Settings</li>

                <li>
                    <a href="#settingMenu" data-bs-toggle="collapse">
                        <i data-feather="settings"></i>
                        <span> Setting </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="settingMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Brand Setting</a>
                            </li>
                            <li>
                                <a href="#">Email Configuration</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Other</li>

                <li>
                    <a href="#websiteMenu" data-bs-toggle="collapse">
                        <i data-feather="layout"></i>
                        <span> Website </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="websiteMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">HomePage</a>
                            </li>
                            <li>
                                <a href="#">About Page</a>
                            </li>
                            <li>
                                <a href="#">Policies</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>