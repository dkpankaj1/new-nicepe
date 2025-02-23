<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

           <!-- LogoBox :: Begin-->
           <x-logo-box />
           <!-- LogoBox :: End-->

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="home"></i>
                        <span class="badge bg-success rounded-pill float-end">9+</span>
                        <span> Dashboard </span>
                    </a>
                </li>

                @canany(['balance-transfers.index', 'balance-transfers.create', 'transactions.read'])
                    <li class="menu-title">Accounting</li>
                @endcanany

                @canany(['balance-transfers.index', 'balance-transfers.create'])
                    <li>
                        <a href="#transfer" data-bs-toggle="collapse">
                            <i data-feather="arrow-up-circle"></i>
                            <span> Balance Transfer </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="transfer">
                            <ul class="nav-second-level">

                                @can('balance-transfers.index')
                                    <li>
                                        <a href="{{route('admin.balance-transfers.index')}}">List</a>
                                    </li>
                                @endcan

                                @can('balance-transfers.create')
                                    <li>
                                        <a href="{{route('admin.balance-transfers.create')}}">New Transfer</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                @can('transactions.read')
                    <li>
                        <a href="#transactionMenu" data-bs-toggle="collapse">
                            <i data-feather="bar-chart-2"></i>
                            <span> Transaction </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="transactionMenu">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('admin.transactions.index')}}">History</a>
                                </li>
                                <li>
                                    <a href="#">Report</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @canany(['plans.read', 'plans.create'])
                    <li class="menu-title">Services & Plans</li>
                @endcanany

                @role('superAdmin')
                <li>
                    <a href="#featureMenu" data-bs-toggle="collapse">
                        <i data-feather="cpu"></i>
                        <span> Features & Reward</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="featureMenu">
                        <ul class="nav-second-level">
                            
                            @can('admin.features.index')
                                <li>
                                    <a href="{{route('admin.features.index')}}">Features</a>
                                </li>
                            @endcan

                            @can('admin.rewards.index')
                                <li>
                                    <a href="{{route('admin.rewards.index')}}">Rewards</a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @endrole

                @canany(['plans.read', 'plans.create'])
                    <li>
                        <a href="#planMenu" data-bs-toggle="collapse">
                            <i data-feather="box"></i>
                            <span> Plans </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="planMenu">
                            <ul class="nav-second-level">
                                @can('plans.read')
                                    <li>
                                        <a href="{{route('admin.plans.index')}}">List</a>
                                    </li>
                                @endcan

                                @can('plans.create')
                                    <li>
                                        <a href="{{route('admin.plans.create')}}">Create</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany([
                    'users.read',
                    'users.create',
                    'roles.read',
                    'api-clients.read',
                    'api-clients.create',
                    'super-distributors.read',
                    'super-distributors.create',
                    'distributors.read',
                    'distributors.create',
                    'retailers.read',
                    'retailers.create'
                ])
                                <li class="menu-title">Peoples</li>
                @endcanany


                @canany(['users.read', 'users.create', 'roles.read'])
                    <li>

                        <a href="#userMenu" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Users </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <div class="collapse" id="userMenu">
                            <ul class="nav-second-level">

                                @can('users.read')
                                    <li>
                                        <a href="{{route('admin.users.index')}}">List</a>
                                    </li>
                                @endcan

                                @can('users.create')
                                    <li>
                                        <a href="{{route('admin.users.create')}}">Create</a>
                                    </li>
                                @endcan

                                @can('roles.read')
                                    <li>
                                        <a href="{{route('admin.roles.index')}}">Role & Permissions</a>
                                    </li>
                                @endcan                         </ul>

                        </div>

                    </li>
                @endcanany

                @canany(['api-clients.read', 'api-clients.create'])
                    <li>
                        <a href="#apiClientMenu" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Api Client </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="apiClientMenu">
                            <ul class="nav-second-level">
                                @can('api-clients.read')
                                    <li>
                                        <a href="{{route('admin.api-clients.index')}}">List</a>
                                    </li>
                                @endcan
                                @can('api-clients.create')
                                    <li>
                                        <a href="{{route('admin.api-clients.create')}}">Create</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['super-distributors.read', 'super-distributors.create'])
                    <li>
                        <a href="#superDistributorMenu" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Super Distributor </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="superDistributorMenu">
                            <ul class="nav-second-level">
                                @can('super-distributors.read')
                                    <li>
                                        <a href="{{route('admin.super-distributors.index')}}">List</a>
                                    </li>
                                @endcan
                                @can('super-distributors.create')
                                    <li>
                                        <a href="{{route('admin.super-distributors.create')}}">Create</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['distributors.read', 'distributors.create'])  
                    <li>
                        <a href="#distributorMenu" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Distributor </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="distributorMenu">
                            <ul class="nav-second-level">
                                @can('distributors.read')
                                    <li>
                                        <a href="{{route('admin.distributors.index')}}">List</a>
                                    </li>
                                @endcan
                                @can('distributors.create')
                                    <li>
                                        <a href="{{route('admin.distributors.create')}}">Create</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['retailers.read', 'retailers.create'])  
                    <li>
                        <a href="#retailerMenu" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Retailer </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="retailerMenu">

                            <ul class="nav-second-level">

                                @can('retailers.read')
                                    <li>
                                        <a href="{{route('admin.retailers.index')}}">List</a>
                                    </li>
                                @endcan

                                @can('retailers.create')
                                    <li>
                                        <a href="{{route('admin.retailers.create')}}">Create</a>
                                    </li>
                                @endcan

                            </ul>

                        </div>
                    </li>
                @endcanany



                @role('superAdmin')

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
                                <a href="{{route('admin.setting.brand')}}">Brand Setting</a>
                            </li>
                            <li>
                                <a href="{{route('admin.setting.general')}}">General Setting</a>
                            </li>
                            <li>
                                <a href="{{route('admin.setting.email')}}">Email Configuration</a>
                            </li>
                        </ul>
                    </div>

                </li>

                @endrole

                <li class="menu-title">Other</li>

                <li>
                    <a href="#myAccountMenu" data-bs-toggle="collapse">
                        <i data-feather="layout"></i>
                        <span> My Account </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myAccountMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('admin.account.index')}}">Account</a>
                            </li>
                            <li>
                                <a href="{{route('admin.account.update')}}">Update Profile</a>
                            </li>
                            <li>
                                <a href="{{route('admin.account.password')}}">Change Password</a>
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