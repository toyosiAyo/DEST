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
            <h2 class="brand-text font-size-40">RUN DEST</h2>
          </div>
          <!-- <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p> -->
        </div>

        <div class="page-register-main">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="../assets/images/logo-colored%402x.png" alt="...">
            <h3 class="brand-text font-size-40">RUN DEST</h3>
          </div>
          <h3 class="font-size-24">Create your Profile</h3>

          <form action="{{route('save.account.form')}}" method="post" role="form" autocomplete="off">
            @csrf
          <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty" id="inputName" name="name">
              <label class="floating-label" for="inputName">Name</label>
              <small>Surname first</small>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control empty" id="inputEmail" name="email">
              <label class="floating-label" for="inputEmail">Email</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty" id="phone" name="phone">
              <label class="floating-label" for="phone">Phone Number</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
                  <select class="form-control">
                    <option>&nbsp;</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  <label class="floating-label">Gender</label>
                </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty" id="inputPassword" name="password">
              <label class="floating-label" for="inputPassword">Password</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty" id="inputPasswordCheck" name="passwordCheck">
              <label class="floating-label" for="inputPasswordCheck">Confirm Password</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
          <p>Have an account already? Please go to <a href="{{route('auth.login')}}">Log In</a></p>
          @include("partials.auth_footer")
        </div>

      </div>
    </div>
    <!-- End Page -->

    <!-- Page -->
    
    </body>
  @endsection