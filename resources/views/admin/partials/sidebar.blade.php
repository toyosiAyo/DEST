<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('viewApplicants')}}">
                        <i data-feather="users"></i>
                        <span data-key="t-pages">Applicants</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-authentication">Applications</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="applications" data-key="t-login">All Applications</a></li>
                        <li><a href="pending_applications" data-key="t-register">Pending Applications</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span data-key="t-authentication">Payments</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('allpayments')}}" data-key="t-login">All Payments</a></li>
                        <li><a href="{{route('pending_payments')}}" data-key="t-register">Pending</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fab fa-whmcs"></i>
                        <span data-key="t-authentication">Config</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" data-key="t-login">Create Course</a></li>
                        <li><a href="#" data-key="t-register">Create Curriculum</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>