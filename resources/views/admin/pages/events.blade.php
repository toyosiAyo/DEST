@extends("admin.layouts.master") 

    @section("title")
    News/Events
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
                                <h4 class="mb-sm-0 font-size-18">News/Events</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="card-title">Event List <span class="text-muted fw-normal ms-2">({{$count}})</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                <div>
                                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bx bx-plus me-1"></i> Add New</a>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive mb-4">
                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Location</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($events as $event)
                                <tr>
                                    <td>{{ $i }} @php $i++ @endphp</td>
                                    <td>
                                        {{ $event->title }}
                                    </td>
                                    <td>{{ $event->body }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>{{ date("d M Y", strtotime($event->date)) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="badge badge-soft-success">{{ $event->status }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
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

        <!-- Required datatable js -->
        <script src="../assets_admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets_admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="../assets_admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets_admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- init js -->
        <script src="../assets_admin/js/pages/datatable-pages.init.js"></script>
        <script src="../assets_admin/js/pages/modal.init.js"></script>
        <script src="../scripts/validation.min.js"></script>
        <script src="../assets_admin/scripts/utility.js"></script>

        
    @endsection
        

