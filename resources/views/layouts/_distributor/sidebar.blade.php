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
                    <a href="{{ route('distributor.dashboard') }}">
                        <i data-feather="home"></i>
                        <span class="badge bg-success rounded-pill float-end">9+</span>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Transactions </li>
                <li>
                    <a href="#transfer" data-bs-toggle="collapse">
                        <i data-feather="arrow-up-circle"></i>
                        <span> Balance Transfer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="transfer">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('distributor.balance-transfers.index') }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('distributor.balance-transfers.create') }}">New Transfer</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#myWalletMenu" data-bs-toggle="collapse">
                        <i data-feather="credit-card"></i>
                        <span> Wallet </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myWalletMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('distributor.wallet.index') }}">History</a>
                            </li>
                            <li>
                                <a href="{{ route('distributor.wallet-recharge.create') }}">Recharge</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Scheme</li>

                <li>
                    <a href="#plansMenu" data-bs-toggle="collapse">
                        <i data-feather="sliders"></i>
                        <span> Plans </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="plansMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('distributor.plans.index') }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('distributor.plans.create') }}">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title">Peoples</li>

                <li>
                    <a href="#retailerMenu" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Retailer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="retailerMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('distributor.retailers.index') }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('distributor.retailers.create') }}">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Account</li>

                <li>
                    <a href="{{ route('distributor.myplan.index') }}">
                        <i data-feather="list"></i>
                        <span> My Plan </span>
                    </a>
                </li>


                <li>
                    <a href="#myAccountMenu" data-bs-toggle="collapse">
                        <i data-feather="layout"></i>
                        <span> My Account </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myAccountMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('distributor.account.index') }}">Account</a>
                            </li>
                            <li>
                                <a href="{{ route('distributor.account.update') }}">Update Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('distributor.account.password') }}">Change Password</a>
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
