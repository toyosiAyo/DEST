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
                                    <input type="password" class="form-control empty" name="current_pass" id="current_pass" required>
                                    <label class="floating-label" for="current_pass">Current Password</label>
                                </div>
                                <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <input type="password" class="form-control empty" id="password" name="password" required>
                                    <label class="floating-label" for="password">New Password</label>
                                </div>
                                <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <input type="password" class="form-control empty" id="password_confirmation" name="password_confirmation" required>
                                    <label class="floating-label" for="password_confirmation">Confirm New Password</label>
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

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="eventForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5>Create New Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Event title:</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="col-form-label">Body:</label>
                            <textarea class="form-control" name="body" id="body" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="col-form-label">Location:</label>
                            <input type="text" class="form-control" name="location" id="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="col-form-label">Date:</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="btnEventForm" type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- init js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../scripts/validation.min.js"></script>
        <script src="../scripts/profile_update.js"></script>   
    @endsection
        

