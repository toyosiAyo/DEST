@extends("admin.layouts.master") 

    @section("title")
     View Lecturers
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
                                <h4 class="mb-sm-0 font-size-18">Lecturers</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row align-items-center d-flex">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">DEST Lecturers <span class="text-muted fw-normal ms-2">({{$count}})</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                <div>
                                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addLecturer"><i class="bx bx-plus me-1"></i> Add New</a>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive mb-4">
                        <table id="tblStudent" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Programme</th>
                                <th scope="col">Status</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($lecturers as $lecturer)
                                <tr>
                                    <td>{{ $i }} @php $i++ @endphp</td>
                                    <td>{{ $lecturer->name}}</td>
                                    <td>{{ $lecturer->email }}</td>
                                    <td>{{ $lecturer->role }}</td>
                                    <td>{{ $lecturer->active }}</td>
                                    <td>
                                        @if($lecturer->active == 0)
                                        <button type="button" data-id="{{$lecturer->id}}" class="btn btn-success">Approve</button>
                                        @else
                                        <button type="button" data-id="{{$lecturer->id}}" class="btn btn-danger">Disapprove</button>
                                        @endif
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

        <div class="modal fade" id="addLecturer" tabindex="-1" aria-labelledby="addLecturerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="lecturerForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5>Create New Lecturer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="programme" class="col-form-label">Programme:</label>
                            <select class="form-control" name="programme" id="programme" required>
                            </select>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="btnLecturerForm" type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
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
        

