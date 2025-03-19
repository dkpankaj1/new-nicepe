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
                    <a href="{{ route('retailer.dashboard') }}">
                        <i data-feather="home"></i>
                        <span class="badge bg-success rounded-pill float-end">9+</span>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title"> Services</li>

                @anyFeatureEnabled('aadharEmailUpdateFeatureEnabled', 'aadharMobileUpdateFeatureEnabled','aadharMobileEmailUpdateFeatureEnabled')
                    <li>
                        <a href="#myAadharService" data-bs-toggle="collapse">
                            <i data-feather="file"></i>
                            <span> Aadhar Service</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="myAadharService">
                            <ul class="nav-second-level">

                                @aadharMobileUpdateFeatureEnabled
                                    <li>
                                        <a href="#myAadharMobileUpdate" data-bs-toggle="collapse">
                                            <i data-feather="chevrons-right"></i>
                                            <span>Mobile Update</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="myAadharMobileUpdate">
                                            <ul class="nav-second-level">
                                                <li><a href="{{ route('retailer.aadhar.mobileupdate.create') }}">Apply</a></li>
                                                <li><a href="{{ route('retailer.aadhar.mobileupdate.index') }}">List</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endaadharMobileUpdateFeatureEnabled

                                @aadharEmailUpdateFeatureEnabled
                                    <li>
                                        <a href="#myAadharEmailUpdate" data-bs-toggle="collapse">
                                            <i data-feather="chevrons-right"></i>
                                            <span> Email Update</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="myAadharEmailUpdate">
                                            <ul class="nav-second-level">
                                                <li><a href="{{ route('retailer.aadhar.emailupdate.create') }}">Apply</a></li>
                                                <li><a href="{{ route('retailer.aadhar.emailupdate.index') }}">List</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endaadharEmailUpdateFeatureEnabled

                                @aadharMobileEmailUpdateFeatureEnabled
                                    <li>
                                        <a href="#myAadharemailMobileUpdate" data-bs-toggle="collapse">
                                            <i data-feather="chevrons-right"></i>
                                            <span> Email/Mobile Update</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="myAadharemailMobileUpdate">
                                            <ul class="nav-second-level">
                                                <li><a href="{{ route('retailer.aadhar.mobileemailupdate.create') }}">Apply</a>
                                                </li>
                                                <li><a href="{{ route('retailer.aadhar.mobileemailupdate.index') }}">List</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endaadharMobileEmailUpdateFeatureEnabled

                            </ul>
                        </div>
                    </li>
                @endanyFeatureEnabled

                <li class="menu-title">Account</li>
                <li>
                    <a href="#myWalletMenu" data-bs-toggle="collapse">
                        <i data-feather="credit-card"></i>
                        <span> Wallet </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myWalletMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('retailer.wallet.index') }}">History</a>
                            </li>
                            <li>
                                <a href="{{ route('retailer.wallet-recharge.create') }}">Recharge</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('retailer.myplan.index') }}">
                        <i data-feather="list"></i>
                        <span> Plans </span>
                    </a>
                </li>

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
                                <a href="{{ route('retailer.account.index') }}">Account</a>
                            </li>
                            <li>
                                <a href="{{ route('retailer.account.update') }}">Update Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('retailer.account.password') }}">Change Password</a>
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
