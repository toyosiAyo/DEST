<div class="site-menubar">
    <div class="site-menubar-header">
        <div class="cover overlay">
            <img class="cover-image" src="assets/examples/images/dashboard-header.jpg" alt="...">
            <div class="overlay-panel vertical-align overlay-background">
                <div class="vertical-align-middle">
                    <a class="avatar avatar-lg" href="profile">
                    <img src="../global/portraits/default.png" alt="">
                    </a>
                    <div class="site-menubar-info">
                        <h5 class="site-menubar-user">{{$data->surname.' '.$data->first_name}}</h5>
                        <p class="site-menubar-email">{{$data->email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-item @php echo Request::path()=='dashboard'? 'active':'' @endphp">
              <a href="{{route('applicant.dashboard')}}">
                <i class="site-menu-icon md-home" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li>
            <li class="site-menu-item has-sub @php echo Request::path()=='create_application'? 'active open':'' @endphp">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-file-text" aria-hidden="true"></i>
                <span class="site-menu-title">Application</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item @php echo Request::path()=='create_application'? 'active':'' @endphp">
                  <a href="create_application">
                    <span class="site-menu-title">Create New</span>
                  </a>
                </li>
                <li class="site-menu-item @php echo Request::path()=='application'? 'active':'' @endphp">
                  <a href="application">
                    <span class="site-menu-title">View</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="site-menu-item @php echo Request::path()=='payments'? 'active':'' @endphp">
              <a href="payments">
                <i class="site-menu-icon md-card" aria-hidden="true"></i>
                <span class="site-menu-title">Payment History</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a href="#">
                <i class="site-menu-icon md-settings" aria-hidden="true"></i>
                <span class="site-menu-title">Settings</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a href="{{route('logout')}}">
                <i class="site-menu-icon md-power" aria-hidden="true"></i>
                <span class="site-menu-title">Logout</span>
              </a>
            </li>            
          </ul>
        </div>
      </div>
    </div>
</div>