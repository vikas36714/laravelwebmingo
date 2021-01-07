<header>
    <div class="top-bar">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-top">
                <a class="navbar-brand" href="{{ route('login') }}"><img src="{{ asset('images/logo.png') }}" class="img-fluid"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><img src="{{ asset('images/usr.png') }}" class="img-fliud"></span>
                               @if(Auth::user()->isAdmin() == 'admin') Admin @endif
                               @if(Auth::user()->isVendor() == 'vendor') {{ucfirst(Auth::user()->first_name).' '.Auth::user()->last_name}} @endif
                            </a>
                            <!---------------------------- VENDOR MENUES ----------------------------->
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->isVendor())
                                    <a class="dropdown-item" href="profile.php">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="change-password.php">Change Password</a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <!---------------------------- ADMIN MENUES ----------------------------->
                                @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('admin.general-settings') }}">General Settings</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-jet-dropdown-link class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Logout') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="middle-bar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-middle" aria-controls="navbar-middle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-middle">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <!---------------------------- ADMIN MENUES ----------------------------->
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-clock"></i> Master
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.pincode') }}">Manage Pincode</a>
                                    <a class="dropdown-item" href="{{ route('admin.category') }}">Manage Category</a>
                                    <a class="dropdown-item" href="{{ route('admin.sub-category') }}">Manage Sub Category</a>
                                    <a class="dropdown-item" href="{{ route('admin.sub-sub-category') }}">Manage Sub Sub Category</a>
                                    <a class="dropdown-item" href="{{ route('admin.services') }}">Manage Services</a>
                                    <a class="dropdown-item" href="{{ route('admin.package-category') }}">Manage Package Category</a>
                                    <a class="dropdown-item" href="{{ route('admin.packages') }}">Manage Packages</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> Users
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.user') }}">Manage Users</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i> Leads
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Add Lead</a>
                                    <a class="dropdown-item" href="{{ route('admin.pending-leads') }}">Pending Leads</a>
                                    <a class="dropdown-item" href="{{ route('admin.manage-leads') }}">Manage Leads</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users"></i> Vendor
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.vendor') }}">Manage Vendors</a>
                                    <a class="dropdown-item" href="{{ route('admin.vendor-loan') }}">Vendor Loan</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file-alt"></i> Contents
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.about') }}">Manage About Us</a>
                                    <a class="dropdown-item" href="{{ route('admin.terms-conditions') }}">Manage T &amp; C</a>
                                    <a class="dropdown-item" href="{{ route('admin.privacy-policy') }}">Manage Privacy Policy</a>
                                    <a class="dropdown-item" href="{{ route('admin.faq') }}">Manage FAQ's</a>
                                    <a class="dropdown-item" href="{{ route('admin.refund-cancellation') }}">Manage Refund &amp; Cancellation</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-pencil-alt"></i> Enquiry
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.contact') }}">Contact Us Form</a>
                                    <a class="dropdown-item" href="{{ route('admin.support') }}">Support Form</a>
                                    <a class="dropdown-item" href="{{ route('admin.feedback') }}">Feedback Form</a>
                                </div>
                            </li>
                        @endif

                        <!---------------------------- VENDOR MENUES ----------------------------->
                        @if(Auth::user()->isVendor())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> Orders
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('vendor.order') }}">Manage Orders</a>
                                    <a class="dropdown-item" href="{{ route('vendor.pending-order') }}">Pending Orders</a>
                                    <a class="dropdown-item" href="{{ route('vendor.order') }}">On-Going Orders</a>
                                    <a class="dropdown-item" href="{{ route('vendor.order') }}">Completed Orders</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> Wallet & Loan
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('vendor.wallet') }}"> My Wallet</a>
                                    <a class="dropdown-item" href="{{ route('vendor.loan-history') }}">My Loan</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
