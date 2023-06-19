@extends("admin.layouts.master") 

    @section("title")
    Settings
    @endsection

    @section("content")        
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Password Change</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">Password Settings <span class="text-muted fw-normal ms-2"></span></h5>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="modal-body">
                        <form method="post" id="update_password_form" >
                            @csrf
                            <li class="list-group-item">
                                <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="current_pass">Current Password</label>
                                    <input type="password" class="form-control empty" name="current_pass" id="current_pass" required>
                                </div>
                                <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="password">New Password</label>
                                    <input type="password" class="form-control empty" id="password" name="password" required>
                                    <input type="hidden" value="admin" class="form-control" id="user" name="user">
                                </div>
                                <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control empty" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </li>
                            <button type="submit" id="btn_pass" class="btn btn-block btn-secondary">Update Password</button>
                        </form>
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include("admin.partials.footer")            
        </div>

        <!-- init js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../scripts/validation.min.js"></script>
        <script src="../scripts/profile_update.js"></script>   
    @endsection
        

