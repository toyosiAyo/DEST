@extends("admin.layouts.master") 

    @section("title")
       Curriculum
    @endsection

    @section("content")    
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Curriculum</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Curriculum</h4>
                                    <p class="card-title-desc">Select courses for programmes from the dropdown below </p>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="font-size-14 mb-3">Create Curriculum</h3>
                                            <div class="mb-3">
                                                <label for="choices-multiple-default" class="form-label font-size-13 text-muted">Select Courses</label>
                                                <select class="form-control" data-trigger
                                                    name="course[]" id="choices-multiple-default"
                                                    placeholder="This is a placeholder" multiple>
                                                    @foreach($courses as $course)
                                                    <option value="{{ $course->course_code }}">{{ $course->course_code }}</option>
                                                    @endforeach  
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="programme" class="form-label font-size-13 text-muted">Select Program</label>
                                                <select class="form-control" data-trigger name="programme"
                                                    id="programme"
                                                    placeholder="Search for programmes">
                                                    @foreach($programmes as $program)
                                                    <option value="{{ $program->programme_id }}">{{ $program->programme }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="degree" class="form-label font-size-13 text-muted">Select Degree</label>
                                                <select class="form-control" data-trigger name="degree"
                                                    id="degree"
                                                    placeholder="Search for degree">
                                                    <option value="pre-degree">Pre-degree</option>
                                                    <option value="foundation">Foundation</option>
                                                    <option value="conversion">HND Conversion</option>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Save</button>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <h3 class="font-size-14 mb-3">View Curriculum</h3>
                                                <div class="d-flex flex-wrap gap-2">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end card body -->
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