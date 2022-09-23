@extends("layouts.auth") 

  @section("title")
      Verify Email
  @endsection
    
  @push('head')
  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/forgot-password.minfd53.css?v4.0.1') }}">
  @endpush

  @section("content")
  <style>
      .verify-email {
        font-size: 30px;
        text-align: center;
        letter-spacing: 15px;
        
        }
  </style>
    <body class="animsition page-forgot-password layout-full">
      <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
          <h2>Verify your Email Address</h2>
            @if(Session::get('account_created'))
                <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('account_created')}}
                </div>
            @endif
            @if(Session::get('success'))
                <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('success')}}
                </div>
            @endif
            @if(Session::get('resend'))
                <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('resend')}}
                </div>
            @endif
            @if(Session::get('verify'))
                <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('verify')}}
                </div>
            @endif
            @if(Session::get('fail'))
                <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('fail')}}
                </div>
            @endif
          <p>Input the OTP sent to your registered email</p>

          <form action ="{{route('account_activate')}}" method="post" role="form" autocomplete="off">
            @csrf
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="tel" maxlength="6" class="form-control empty verify-email" id="otp" name="otp" required>
              <label class="floating-label" for="inputEmail">Enter OTP</label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Verify</button>
              <small>Didn't get a code? <a href="{{route('resend_otp')}}">Resend</a></small><br>
              <small><a href="{{route('auth.login')}}">Return to Login</a></small>
            </div>
          </form>
          @include("partials.auth_footer")
        </div>
      </div>
    </body>
  @endsection
