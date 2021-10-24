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
            <img class="brand-img" src="../assets/images/run_logo.png" alt="..."><span>STUDENT PORTAL</span>
            <h2 class="brand-text font-size-30" style="color:yellow">DIRECTORATE OF EDUCATIONAL SERVICES AND TRAINING</h2>
          </div>
          <!-- <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p> -->
        </div>

        <div class="page-register-main">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="../assets/images/run_logo.png" alt="...">
            <h3 class="brand-text font-size-30">RUN DEST</h3>
          </div>
          <h3 class="font-size-24">Create your Profile</h3>
              @if(Session::get('success'))
                <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon md-close" aria-hidden="true"></i> {{Session::get('success')}}
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
              <input type="email" value="{{old('email')}}" class="form-control empty" id="email" name="email" required>
              <label class="floating-label" for="inputEmail">Email</label>
              @if ($errors->has('email'))
                  <span class="">
                    <strong>{{ $errors->first('email') }}</strong>
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
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                  <label class="floating-label" for="gender">Gender</label>
                </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" value="" class="form-control empty" id="password" name="password" required>
              <label class="floating-label" for="password">Password</label>
              @if ($errors->has('password'))
                  <span class="">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" value="" class="form-control empty" id="password_confirmation" name="password_confirmation" required>
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