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

                <li class="menu-title">Services</li>

                {{-- @mobileRechargeFeatureEnabled
                <li>
                    <a href="#myRechargeMenu" data-bs-toggle="collapse">
                        <i data-feather="phone"></i>
                        <span> Mobile/DTH Recharge</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myRechargeMenu">
                        <ul class="nav-second-level">

                            <li><a href="{{route('apiclient.recharge')}}">DTH Recharge</a></li>
                            <li><a href="#">Mobile Recharge</a></li>
                            <li><a href="#">History</a></li>

                        </ul>
                    </div>
                </li>
                @endmobileRechargeFeatureEnabled --}}

                @aadharMobileEmailUpdateFeatureEnabled
                @endaadharMobileEmailUpdateFeatureEnabled

                <li>
                    <a href="#myAadharUpdate" data-bs-toggle="collapse">
                        <i data-feather="check"></i>
                        <span> Aadhar Update</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myAadharUpdate">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('retailer.aadhar-update.create') }}">Apply</a></li>
                            <li><a href="#">List</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#myAadharToPan" data-bs-toggle="collapse">
                        <i data-feather="check"></i>
                        <span> Aadhar To PAN</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myAadharToPan">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('retailer.aadhar-to-pan.create') }}">Apply</a></li>
                            <li><a href="#">List</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#myBirthCertificate" data-bs-toggle="collapse">
                        <i data-feather="check"></i>
                        <span> Birth Certificate</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myBirthCertificate">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('retailer.birth-certificate.create') }}">Apply</a></li>
                            <li><a href="#">List</a></li>
                        </ul>
                    </div>
                </li>

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
