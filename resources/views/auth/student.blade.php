@extends("layouts.auth") 

  @section("title")
      Student Login
  @endsection
    
  @push('head')
  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/login-v4.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/login-v2.minfd53.css?v4.0.1') }}">
  @endpush

  @section("content")
    <body class="animsition page-login-v4 layout-full page-dark">
      <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
          <div class="page-brand-info">
            <div class="brand">
              <img class="brand-img" src="{{ asset('assets/images/DEST_logo.png') }}" alt="..."> 
              <hr>
              <h1 style="color:white; background-color:darkblue; font-weight: bold; font-style: italic; font-size: 40px;">Welcome to DEST Student Portal</h1>
            </div>
          </div>
          <div class="page-login-main">
            <div class="brand hidden-md-up">
              <img class="brand-img" src="{{ asset('assets/images/run_logo.png') }}" alt="..."><span class="brand-text font-size-30">RUN DEST</span>
            </div>
            <h3 class="font-size-24">Log In</h3>
            <p>Log in with your email and password</p>
            <form  method="post" id="studentLoginForm" autocomplete="off">
              @csrf
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="email" class="form-control empty" id="student_email" name="student_email" required>
                <label class="floating-label" for="student_email">Email</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="password" class="form-control empty" id="student_password" name="student_password" required>
                <label class="floating-label" for="student_password">Password</label>
              </div>
              <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                  <input type="checkbox" id="remember" name="checkbox">
                  <label for="inputCheckbox">Remember me</label>
                </div>
                <a class="float-right" href="{{route('forgot.password')}}">Forgot password?</a>
              </div>
              <button type="submit" id="btnStudentLogin" class="btn btn-primary btn-block">Log in</button>
            </form>
            <p>Applicant Login <a href="/">here</a></p>
            <p>Admin Login <a href="admin">here</a></p>
            @include("partials.auth_footer")
          </div>
        
        </div>
      </div>

      <script src=" {{ asset('scripts/validation.min.js') }}"></script>
      <script src=" {{ asset('scripts/student_auth.js') }}"></script>
    </body>
  @endsection
