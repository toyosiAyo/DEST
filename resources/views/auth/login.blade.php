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
              <img class="brand-img" src="{{ asset('assets/images/logo%402x.png') }}" alt="...">
              <h2 class="brand-text font-size-40">RUN DEST</h2>
            </div>
            <!-- <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</p> -->
          </div>

          <div class="page-login-main">
            <div class="brand hidden-md-up">
              <img class="brand-img" src="{{ asset('assets/images/logo-colored%402x.png') }}" alt="...">
              <h3 class="brand-text font-size-40">RUN DEST</h3>
            </div>
            <h3 class="font-size-24">Log In</h3>
            <p>Log in with your email and password</p>
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
                <input type="email" class="form-control empty" id="inputEmail" name="email">
                <label class="floating-label" for="inputEmail">Email</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="password" class="form-control empty" id="inputPassword" name="password">
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
            @include("partials.auth_footer")
          </div>
        
        </div>
      </div>
    </body>
  @endsection
