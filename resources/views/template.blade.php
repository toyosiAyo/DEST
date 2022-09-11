@extends("admin.layouts.master") 

    @section("title")
       Profile
    @endsection

    @section("content")    
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">{Name}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="programme" class="form-label font-size-13 text-muted">Email</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="degree" class="form-label font-size-13 text-muted">Address</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="year" class="form-label font-size-13 text-muted">Date of Birth</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="programme" class="form-label font-size-13 text-muted">City of Residence</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="degree" class="form-label font-size-13 text-muted">Nationality</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="year" class="form-label font-size-13 text-muted">State of Origin</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="programme" class="form-label font-size-13 text-muted">LGA</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="degree" class="form-label font-size-13 text-muted">Religion</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="year" class="form-label font-size-13 text-muted">Marital Status</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="year" class="form-label font-size-13 text-muted">Name of Next of Kin</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                   
                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include("admin.partials.footer")            
        </div>
    @endsection