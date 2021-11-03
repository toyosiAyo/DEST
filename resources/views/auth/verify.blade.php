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
        margin-left: 15px;
        }
  </style>
    <body class="animsition page-forgot-password layout-full">
      <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
          <h2>Verify your Email Address</h2>
          <p>Input the OTP sent to your registered email</p>

          <form action ="#" method="post" role="form" autocomplete="off">
            @csrf
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="tel" maxlength="6" class="form-control empty verify-email" id="otp" name="otp" required>
              <label class="floating-label" for="inputEmail">Enter OTP</label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Verify</button>
              <small>Didn't get a code? <a href="">Resend</a></small>
            </div>
          </form>
          @include("partials.auth_footer")
        </div>
      </div>
    </body>
  @endsection
