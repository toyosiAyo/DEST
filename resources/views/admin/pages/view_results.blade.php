@extends("admin.layouts.master") 

    @section("title")
       Results
    @endsection

    @section("content")    
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Results</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">View Results</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">                                            
                                            <form method="POST" id="form_resullt">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="degree" class="form-label font-size-13 text-muted">Select Degree</label>
                                                <select class="form-control" name="degree" id="degree">
                                                    <option value="foundation">Foundation</option>
                                                    <option value="part_time">Part TIme</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="faculty" class="form-label font-size-13 text-muted">Select Faculty</label>
                                                <select class="form-control" name="faculty" id="faculty">
                                                    @foreach($faculty as $fac)
                                                        <option value="{{$fac->college}}">{{$fac->college}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="session" class="form-label font-size-13 text-muted">Select Session</label>
                                                <select class="form-control" name="session" id="session">
                                                    <option value="2022/2023">2022/2023</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="semester" class="form-label font-size-13 text-muted">Select Semester</label>
                                                <select class="form-control" name="semester" id="semester">
                                                    <option value="1">First Semester</option>
                                                    <option value="2">Second Semester</option>
                                                </select>
                                            </div>
                                            <button id="btn_result" type="submit" class="btn btn-danger"><i data-feather="printer"></i> Download</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->

                   
                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include("admin.partials.footer")            
        </div>
        <script src="../assets_admin/scripts/utility.js"></script>
    @endsection