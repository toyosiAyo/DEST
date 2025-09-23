<div class="site-menubar">
    <div class="site-menubar-header">
        <div class="cover overlay">
            <img class="cover-image" src="assets/examples/images/dashboard-header.jpg" alt="...">
            <div class="overlay-panel vertical-align overlay-background">
                <div class="vertical-align-middle">
                    <a class="avatar avatar-lg" href="profile">
                        @if ($data->profile_pix)
                            <img src="{{ asset('storage/' . $data->profile_pix) }}" alt="">
                        @else
                            <img src="../global/portraits/default.png" alt="...">
                        @endif
                    </a>
                    <div class="site-menubar-info">
                        <h5 class="site-menubar-user">{{ $data->surname . ' ' . $data->first_name }}</h5>
                        <p class="site-menubar-email">{{ $data->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-item @php echo Request::path()=='student_dashboard'? 'active':'' @endphp">
                        <a href="{{ route('student.dashboard') }}">
                            <i class="site-menu-icon md-home" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li
                        class="site-menu-item has-sub @php echo Request::path()=='registration'? 'active open':'' @endphp">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-file-text" aria-hidden="true"></i>
                            <span class="site-menu-title">Course Registration</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @php echo Request::path()=='registration'? 'active':'' @endphp">
                                <a href="registration">
                                    <span class="site-menu-title">List of Courses</span>
                                </a>
                            </li>
                            <li class="site-menu-item @php echo Request::path()=='courses'? 'active':'' @endphp">
                                <a href="courses">
                                    <span class="site-menu-title">Registered Courses</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="site-menu-item has-sub @php echo Request::path()=='transactions'? 'active open':'' @endphp">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-file-text" aria-hidden="true"></i>
                            <span class="site-menu-title">Payments</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @php echo Request::path()=='fee_schedule'? 'active':'' @endphp">
                                <a href="fee_schedule">
                                    <span class="site-menu-title">School Fees Breakdown</span>
                                </a>
                            </li>
                            <li class="site-menu-item @php echo Request::path()=='transactions'? 'active':'' @endphp">
                                <a href="transactions">
                                    <span class="site-menu-title">Transaction History</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item @php echo Request::path()=='result'? 'active':'' @endphp">
                        <a href="#">
                            <i class="site-menu-icon md-card" aria-hidden="true"></i>
                            <span class="site-menu-title">Result</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="{{ route('logout') }}">
                            <i class="site-menu-icon md-power" aria-hidden="true"></i>
                            <span class="site-menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
