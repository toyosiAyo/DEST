@extends("admin.layouts.master") 

    @section("title")
    Applications
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
                                <h4 class="mb-sm-0 font-size-18">Applications</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">Application List <span class="text-muted fw-normal ms-2">({{$count}})</span></h5>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive mb-4">
                        <table id="tblapplications" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Programme</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($applications as $application)
                                <tr>
                                    <td>{{ $i }} @php $i++ @endphp</td>
                                    <td>
                                        {{ $application->surname.' '.$application->first_name }}
                                    </td>
                                    <td>{{ $application->submitted_by }}</td>
                                    <td>{{ $application->Programme }}</td>
                                    <td>{{ $application->app_type }}</td>
                                    <td>{{ date("d M Y", strtotime($application->updated_at)) }}</td>
                                    <td>
                                        @if($application->status == 'pending')
                                        <div class="d-flex gap-2">
                                            <a href="#" class="badge badge-soft-danger">{{ $application->status }}</a>
                                        </div>
                                        @else
                                        <div class="d-flex gap-2">
                                            <a href="#" class="badge badge-soft-primary">{{ $application->status }}</a>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                            @if($application->status == 'success')
                                                <li><a class="dropdown-item" href="#">View</a></li>
                                                <li><button data-email="{{$application->submitted_by}}" data-action="download" data-app_id="{{$application->id}}" class="dropdown-item downloadApp">Download</button></li>
                                                <li><button data-email="{{$application->submitted_by}}" data-action="approve" data-app_id="{{$application->id}}" class="dropdown-item approveApp">Approve</button></li>
                                            @endif
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

        <div class="modal fade" id="viewApplication" tabindex="-1" aria-labelledby="viewApplicationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Send Matric Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="col-lg-12">
                        <div class="card border border-primary">
                            <div class="card-body">
                                <label for="name" class="col-form-label">Fullname: <span id="name"></span></label><hr>
                                <label for="email" class="col-form-label">Email: <span id="email"></span></label><hr>
                                <label for="phone" class="col-form-label">Phone number: <span id="phone"></span></label><hr>
                                <label for="program" class="col-form-label">Programme: <span id="program"></span></label><hr>
                                <label for="graduation" class="col-form-label">Year of Graduation: <span id="graduation"></span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="approveApplication" tabindex="-1" aria-labelledby="approveApplicationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Approve Application</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="col-lg-12">
                        <div class="card border border-primary">
                            <div class="card-body">
                                <form method="post">
                                    <label for="duration" class="col-form-label">Duration</label>
                                    <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter Programme Duration" required><br>
                                    <input type="date" class="form-control" id="resumption" name="resumption" placeholder="Select resumption date" required><br>
                                    <input type="text" class="form-control" id="degree" name="degree" placeholder="Enter degree" required><br>
                                    <button type="submit" class="btn btn-primary" id="btn_approve">Submit</button>  
                                </form>
                            </div>
                        </div>
                    </div>
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
        

