<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                @if($data->role == 'director' || $data->role == 'admin' || $data->role == 'accountant')
                <li>
                    <a href="dashboard">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endif
                @if($data->role == 'director' || $data->role == 'admin')
                <li>
                    <a href="{{route('viewApplicants')}}">
                        <i data-feather="users"></i>
                        <span>Applicants</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/students">
                        <i data-feather="users"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('view_lecturers')}}">
                        <i data-feather="user-plus"></i>
                        <span>Lecturers</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span>Applications</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('viewApplications')}}">All Applications</a></li>
                        <li><a href="{{route('viewPendingApplications')}}">Pending Applications</a></li>
                    </ul>
                </li>
                @endif
                @if($data->role == 'director' || $data->role == 'admin' || $data->role == 'accountant')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Payments</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('allpayments')}}">All Payments</a></li>
                        <li><a href="{{route('pending_payments')}}">Pending</a></li>
                    </ul>
                </li>
                @endif
                @if($data->role == 'director' || $data->role == 'admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fab fa-whmcs"></i>
                        <span>Config</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Create Course</a></li>
                        <li><a href="{{route('curriculum')}}">Create Curriculum</a></li>
                        <li><a href="{{route('view_curriculum')}}">View Curriculum</a></li>
                        <li><a href="{{route('events')}}">Post News/Events</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('view_registration')}}">
                        <i data-feather="file-text"></i>
                        <span>Course Registration</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('view_results')}}">
                        <i data-feather="layers"></i>
                        <span>Results</span>
                    </a>
                </li>
                @endif
                @if($data->role !== 'director' && $data->role !== 'admin' && $data->role !== 'accountant')
                <li>
                    <a href="{{route('score_input')}}">
                        <i data-feather="edit"></i>
                        <span>Score Input</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>