@extends("layouts.auth") 

  @section("title")
      Login
  @endsection
    
  @push('head')
  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/login-v2.minfd53.css?v4.0.1') }}">
  @endpush

  @section("content")
    <body class="animsition page-login-v2 layout-full page-dark">
      <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
          <div class="page-brand-info">
            <div class="brand">
              <img class="brand-img" src="{{ asset('assets/images/DEST_logo.png') }}" alt="..."> 
              <hr>
              <h1 style="color:white; background-color:darkblue; font-weight: bold; font-style: italic; font-size: 40px;">Welcome to DEST Admission Portal</h1>
            </div>
          </div>
          <div class="page-login-main">
            <div class="brand hidden-md-up">
              <img class="brand-img" src="{{ asset('assets/images/run_logo.png') }}" alt="..."><span class="brand-text font-size-30">RUN DEST</span>
            </div>
            <h3 class="font-size-24">Log In</h3>
            <p>Log in with your email and password</p>
             
            @if(Session::get('pass_reset'))
                <div class="alert dark alert-icon alert-info alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('pass_reset')}}
                </div>
            @endif
            
            @if(Session::get('verified'))
                <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('verified')}}
                </div>
            @endif
         
              @if(Session::get('success'))
                <p>{{Session::get('success')}}</p>
              @endif
              @if(Session::get('fail'))
                <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('fail')}}
                </div>
              @endif
            <form action="{{route('auth.check')}}" method="post" autocomplete="off">
              @csrf
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="email" class="form-control empty" id="inputEmail" name="email" required>
                <label class="floating-label" for="inputEmail">Email</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="password" class="form-control empty" id="inputPassword" name="password" required>
                <label class="floating-label" for="inputPassword">Password</label>
              </div>
              <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                  <input type="checkbox" id="remember" name="checkbox">
                  <label for="inputCheckbox">Remember me</label>
                </div>
                <a class="float-right" href="{{route('forgot.password')}}">Forgot password?</a>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </form>
            <p>No account? <a href="{{route('get.account.form')}}">Create Profile here</a></p>
            <p>Student Login <a href="student">here</a></p>
            <p>Admin Login <a href="admin">here</a></p>
            @include("partials.auth_footer")
          </div>
        
        </div>
      </div>
    </body>
  @endsection
