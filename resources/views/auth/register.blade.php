@extends("layouts.auth") 

  @section("title")
      Register
  @endsection

  @push('head')
  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/register-v2.minfd53.css?v4.0.1') }}">
  <script src="{{ asset('global/js/Plugin/animate-list.minfd53.js?v4.0.1') }}"></script>
  @endpush
  
  @section("content")

    <!-- Page -->
    <body class="animsition page-register-v2 layout-full page-dark">

    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content">
        <div class="page-brand-info">
          <div class="brand">
            <img class="brand-img" src="../assets/images/logo%402x.png" alt="...">
            <h2 class="brand-text font-size-40">Remark</h2>
          </div>
          <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="page-register-main">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="../assets/images/logo-colored%402x.png" alt="...">
            <h3 class="brand-text font-size-40">Remark</h3>
          </div>
          <h3 class="font-size-24">Sign Up</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

          <form method="post" role="form" autocomplete="off">
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty" id="inputName" name="name">
              <label class="floating-label" for="inputName">Name</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control empty" id="inputEmail" name="email">
              <label class="floating-label" for="inputEmail">Email</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty" id="inputPassword" name="password">
              <label class="floating-label" for="inputPassword">Password</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty" id="inputPasswordCheck" name="passwordCheck">
              <label class="floating-label" for="inputPasswordCheck">Retype Password</label>
            </div>
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                <input type="checkbox" id="inputCheckbox" name="term">
                <label for="inputCheckbox"></label>
              </div>
              <p class="ml-35">By clicking Sign Up, you agree to our <a href="#">Terms</a>.</p>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </form>

          <p>Have account already? Please go to <a href="/">Sign In</a></p>
          @include("partials.auth_footer")
        </div>

      </div>
    </div>
    <!-- End Page -->

    <!-- Page -->
    
    </body>
  @endsection