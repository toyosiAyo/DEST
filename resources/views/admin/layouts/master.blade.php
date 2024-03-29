<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="RUN DEST" name="description" />
        <meta content="DEST" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/run_logo.png">
        <!-- choices css -->
        <link href="../assets_admin/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="../assets_admin/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="../assets_admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets_admin/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets_admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- JAVASCRIPT -->
        <script src="../assets_admin/libs/jquery/jquery.min.js"></script>
        <script src="../assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets_admin/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets_admin/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets_admin/libs/node-waves/waves.min.js"></script>
        <script src="../assets_admin/libs/feather-icons/feather.min.js"></script>
        <script src="../assets_admin/libs/pace-js/pace.min.js"></script>
        <!-- choices js -->
        <script src="../assets_admin/libs/choices.js/public/assets/scripts/choices.min.js"></script>
        <!-- init js -->
        <script src="../assets_admin/js/pages/form-advanced.init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js" integrity="sha512-QSb5le+VXUEVEQbfljCv8vPnfSbVoBF/iE+c6MqDDqvmzqnr4KL04qdQMCm0fJvC3gCWMpoYhmvKBFqm1Z4c9A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    </head>
    <style>
      .invalid {
        color:#ff0000;
      }
    </style>
    <body>
        <div id="layout-wrapper">
            @include("admin.partials.navbar")
            @include("admin.partials.sidebar")

            @yield('content')

            @include("admin.partials.rightbar")
        </div>
        <script src="../assets_admin/js/app.js"></script>
    </body>
    

</html>