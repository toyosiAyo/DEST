@extends("admin.layouts.master") 

    @section("title")
     Score Input
    @endsection

    @section("content")
        <link href="../assets_admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Score Input</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">Student List for {{$data->role}} <span class="text-muted fw-normal ms-2">({{$count}})</span></h5>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive mb-4">
                    <form method="post" id="inputScoreForm">
                        <table id="tblScoreInput" class="table align-middle datatable dt-responsive table-check nowrap scoreTable" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Programme</th>
                                <th scope="col">Degree</th>
                                <th scope="col">Score</th>
                                <th scope="col">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $i }} </td>
                                    <td>{{ $student->surname.' '.$student->first_name }}</td>
                                    <td>{{ $student->course_code }}</td>
                                    <td>{{ $student->programme }}</td>
                                    <td>{{ $student->app_type }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <input class="form-control form-control-md score" data-id="{{$i}}" value="{{ $student->score }}" name="{{$student->stud_id}}" type="text" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <input id="{{$i}}" class="form-control form-control-md grade" value="{{ $student->grade }}" type="text" size="1" readonly>
                                        </div>
                                    </td>
                                </tr> 
                                @php $i++ @endphp  
                                @endforeach                            
                            </tbody>
                        </table>
                        <div class="btn-group" role="group">
                            <input type="text" name="course_code" value="{{$student->course_code}}" hidden>
                            <button type="submit" id="btnScoreInput" class="btn btn-danger">Submit</button>    
                            <hr>
                        </div>
                        </form>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->
                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include("admin.partials.footer")            
        </div>

        <!-- Required datatable js -->
        <script src="../assets_admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets_admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="../assets_admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets_admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- init js -->
        <script src="../assets_admin/js/pages/datatable-pages.init.js"></script>
        <script src="../assets_admin/scripts/utility.js"></script>
        
    @endsection
        

