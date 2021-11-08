@extends("layouts.auth") 

  @section("title")
      Forgot Password
  @endsection
    
  @push('head')
  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/forgot-password.minfd53.css?v4.0.1') }}">
  @endpush

  @section("content")
    <body class="animsition page-forgot-password layout-full">
      <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
          <h2>Forgot Your Password ?</h2>
      
            @if(Session::get('fail'))
                <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('fail')}}
                </div>
            @endif
          <p>Input your registered email to reset your password</p>

          <form action ="{{route('forgot.password')}}" method="post" role="form" autocomplete="off">
          @csrf
          <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control empty" id="inputEmail" name="email">
              <label class="floating-label" for="inputEmail">Your Email</label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
            </div>
          </form>
          @include("partials.auth_footer")
        </div>
      </div>
    </body>
  @endsection
