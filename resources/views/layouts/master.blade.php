<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="RUN DEST">
  <meta name="author" content="Toyosi Ayo">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/run_logo.png') }}">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('global/css/bootstrap.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/css/bootstrap-extend.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/site.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Skin tools (demo site only) -->
  <link rel="stylesheet" href="{{ asset('global/css/skintools.minfd53.css?v4.0.1') }}">
  <script src="assets/js/Plugin/skintools.minfd53.js?v4.0.1') }}"></script>

  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('global/vendor/animsition/animsition.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/asscrollable/asScrollable.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/switchery/switchery.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/intro-js/introjs.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/slidepanel/slidePanel.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/flag-icon-css/flag-icon.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/waves/waves.minfd53.css?v4.0.1') }}">
  
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('assets/examples/css/dashboard/v1.minfd53.css?v4.0.1') }}">

  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('global/fonts/material-design/material-design.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/fonts/brand-icons/brand-icons.minfd53.css?v4.0.1') }}">
  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Scripts -->
  <script src=" {{ asset('global/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/jquery/jquery.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/breakpoints/breakpoints.minfd53.js?v4.0.1') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    Breakpoints();
  </script>
  @stack('head')
</head>
    <style>
      .invalid {
        color:#ff0000;
      }
    </style>
  <!-- Page -->
    @include("partials.navbar")

    @if($data->status == 'student')
      @include("partials.student_sidemenu")
    @else
      @include("partials.sidemenu")
    @endif

    @yield('content')
  <!-- End Page -->

  <!-- Footer -->
    @include("partials.footer")
  <!-- Core  -->
  <script data-cfasync="false" src=" {{ asset('global/js/email-decode.min.js') }}"></script>
  <script src=" {{ asset('global/vendor/popper-js/umd/popper.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/bootstrap/bootstrap.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/animsition/animsition.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/mousewheel/jquery.mousewheel.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/asscrollbar/jquery-asScrollbar.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/asscrollable/jquery-asScrollable.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/ashoverscroll/jquery-asHoverScroll.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/waves/waves.minfd53.js?v4.0.1') }}"></script>

  <!-- Plugins -->
  <script src=" {{ asset('global/vendor/switchery/switchery.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/intro-js/intro.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/screenfull/screenfull.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/slidepanel/jquery-slidePanel.minfd53.js?v4.0.1') }}"></script>

  <!-- Plugins For This Page -->
  <script src=" {{ asset('global/vendor/matchheight/jquery.matchHeight-minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/peity/jquery.peity.minfd53.js?v4.0.1') }}"></script>

  <!-- Scripts -->
  <script src=" {{ asset('global/js/State.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Component.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Base.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Config.minfd53.js?v4.0.1') }}"></script>

  <script src=" {{ asset('assets/js/Section/Menubar.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('assets/js/Section/Sidebar.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('assets/js/Section/PageAside.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('assets/js/Plugin/menu.minfd53.js?v4.0.1') }}"></script>

  <!-- Config -->
  <script src=" {{ asset('global/js/config/colors.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('assets/js/config/tour.minfd53.js?v4.0.1') }}"></script>
  <script>
    Config.set('assets', "{{ asset('assets') }}");
  </script>

  <!-- Page -->
  <script src=" {{ asset('assets/js/Site.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin/asscrollable.minfd53.js?v4.0.1') }}"></script>

  <script src=" {{ asset('global/js/Plugin/slidepanel.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin/switchery.minfd53.js?v4.0.1') }}"></script>

  <script src=" {{ asset('global/js/Plugin/matchheight.minfd53.js?v4.0.1') }}"></script>
  <!-- <script src=" {{ asset('global/js/Plugin/jvectormap.minfd53.js?v4.0.1') }}"></script> -->
  <script src=" {{ asset('global/js/Plugin/peity.minfd53.js?v4.0.1') }}"></script>


  <script src=" {{ asset('assets/examples/js/dashboard/v1.minfd53.js?v4.0.1') }}"></script>

  <!-- Google Analytics -->
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '{{ asset("global/js/analytics.js") }}',
      'ga');

    ga('create', 'UA-65522665-1', 'auto');
    ga('send', 'pageview');
  </script>
</html>