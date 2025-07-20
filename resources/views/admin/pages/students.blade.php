@extends("admin.layouts.master") 

    @section("title")
      Students
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
                                <h4 class="mb-sm-0 font-size-18">Students</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">Students List <span class="text-muted fw-normal ms-2">({{$count}})</span></h5>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive mb-4">
                        <table class="table align-middle datatable dt-responsive table-check nowrap students" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Programme</th>
                                <th scope="col">Degree</th>
                                <th scope="col">Session Admitted</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $i }} @php $i++ @endphp</td>
                                    <td>
                                        <a href="#" class="text-body">{{ $student->surname.' '.$student->first_name }}</a>
                                    </td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>
                                        {{$student->programme}}
                                    </td>
                                    <td>{{ $student->app_type }}</td>
                                    <td>{{ $student->session_admitted }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item reset" data-firstname="{{$student->first_name}}" data-student_id="{{$student->id}}" href="#">Reset Password</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>   
                                @endforeach                            
                            </tbody>
                        </table>
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
        

