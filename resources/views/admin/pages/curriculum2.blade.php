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
                                <form method="POST" id="formCurr">
                                    @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="programme" class="form-label font-size-13 text-muted">Select Program</label>
                                                <select class="form-control" data-trigger name="programme"
                                                    id="programme" placeholder="Search for programmes">
                                                    <option value="" selected>Select Programme</option>
                                                    @foreach($programmes as $program)
                                                    <option value="{{ $program->id }}">{{ $program->programme }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="degree" class="form-label font-size-13 text-muted">Select Degree</label>
                                                <select class="form-control" id="degree" required>
                                                    <option value="pre-degree">Pre-degree</option>
                                                    <option value="foundation">Foundation</option>
                                                    <option value="conversion">HND Conversion</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="year" class="form-label font-size-13 text-muted">Select Session</label>
                                                <select class="form-control" id="year" name="year" required>
                                                    <option value="" selected disabled>Select Session</option>
                                                    <option value="1">First Year</option>
                                                    <option value="2">Second Year</option>
                                                    <option value="3">Third Year</option>
                                                    <option value="4">Fourth Year</option>
                                                </select>
                                                <input type="hidden" name="user" value="{{$data->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <table id="tblCurr" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i = 1; $i < 11; $i++)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>
                                                    <select class="form-control" data-trigger
                                                        name="row{{$i}}[]">
                                                        <option value="" selected>Select Course</option>
                                                        @foreach($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->code }}</option>
                                                        @endforeach  
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="row{{$i}}[]">
                                                        <option value="" selected>Select Course Status</option>
                                                        <option value="C">Compulsory</option>
                                                        <option value="E">Elective</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="row{{$i}}[]">
                                                        <option value="" selected>Select Semester</option>
                                                        <option value="1">First Semester</option>
                                                        <option value="2">Second Semester</option>
                                                    </select>
                                                </td>
                                            </tr>   
                                            @endfor
                                        </tbody>
                                    </table>
                                    <button id="btnCurr" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
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
        <script src="../assets_admin/scripts/utility.js"></script>
    @endsection