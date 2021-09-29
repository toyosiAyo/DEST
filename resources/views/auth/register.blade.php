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
              <input type="text" value="{{old('surname')}}" class="form-control empty" id="surname" name="surname" required>
              <label class="floating-label" for="surname">Surname</label>
              @if ($errors->has('surname'))
                  <span class="">
                    <strong>{{ $errors->first('surname') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" value="{{old('firstname')}}" class="form-control empty" id="firstname" name="firstname" required>
              <label class="floating-label" for="firstname">Firstname</label>
              @if ($errors->has('firstname'))
                  <span class="">
                    <strong>{{ $errors->first('firstname') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" value="{{old('othername')}}" class="form-control empty" id="othername" name="othername" required>
              <label class="floating-label" for="othername">Othername</label>
              @if ($errors->has('othername'))
                  <span class="">
                    <strong>{{ $errors->first('othername') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" value="{{old('inputEmail')}}" class="form-control empty" id="inputEmail" name="email" required>
              <label class="floating-label" for="inputEmail">Email</label>
              @if ($errors->has('inputEmail'))
                  <span class="">
                    <strong>{{ $errors->first('inputEmail') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" value="{{old('phone')}}" class="form-control empty" id="phone" name="phone" required>
              <label class="floating-label" for="phone">Phone Number</label>
              @if ($errors->has('phone'))
                  <span class="">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
                  <select class="form-control" id="gender" name="gender" required>
                    <option>&nbsp;</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  <label class="floating-label" for="gender">Gender</label>
                </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" value="{{old('inputPassword')}}" class="form-control empty" id="inputPassword" name="password" required>
              <label class="floating-label" for="inputPassword">Password</label>
              @if ($errors->has('inputPassword'))
                  <span class="">
                    <strong>{{ $errors->first('inputPassword') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" value="{{old('password_confirmation')}}" class="form-control empty" id="password_confirmation" name="password_confirmation" required>
              <label class="floating-label" for="password_confirmation">Confirm Password</label>
              @if ($errors->has('password_confirmation'))
                  <span class="">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif
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