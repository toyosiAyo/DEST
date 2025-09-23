@extends('layouts.master_student')

@section('title')
    Student Dashboard
@endsection

@push('head')
    <script src="{{ asset('scripts/previewImage.js') }}"></script>
@endpush

@section('content')

    <body class="animsition dashboard site-menubar-push site-menubar-open site-menubar-fixed">
        <div class="page">
            <div class="page-content container-fluid">
                @if (Session::get('success'))
                    <p>{{ Session::get('success') }}</p>
                @endif

                @if (Session::get('fail'))
                    <p>{{ Session::get('fail') }}</p>
                @endif

                <div class="row" data-by-row="true">
                    <div class="col-xl-4 col-md-6" style="height: 140px;">
                        <div class="card card-shadow">
                            <div class="card-block p-20 pt-10">
                                <div class="clearfix">
                                    <div class="grey-800 float-left py-10">
                                        Total Fees
                                    </div>
                                    <span class="float-right grey-700 font-size-30">{{ $total_fees }}</span>
                                </div>
                                <div class="mb-20 grey-500">
                                    <a href="fee_schedule">View Breakdown</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6" style="height: 140px;">
                        <div class="card card-shadow">
                            <div class="card-block p-20 pt-10">
                                <div class="clearfix">
                                    <div class="grey-800 float-left py-10">
                                        Amount Paid
                                    </div>
                                    <span class="float-right grey-700 font-size-30">{{ $total_paid }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6" style="height: 140px;">
                        <div class="card card-shadow">
                            <div class="card-block p-20 pt-10">
                                <div class="clearfix">
                                    <div class="grey-800 float-left py-10">
                                        Session: {{ $settings->session }}
                                    </div>
                                </div>
                                <div class="grey-800 float-left py-10">
                                    Semester: {{ $settings->semester_name }}
                                </div>
                                <div class="ct-chart h-50"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7 col-lg-7">
                        <div class="panel" id="projects-status">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Transactions
                                    <span class="badge badge-pill badge-info">{{ $count }}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td><strong>S/N</strong></td>
                                            <td><strong>Amount</strong></td>
                                            <td><strong>Trans Ref</strong></td>
                                            <td><strong>Status</strong></td>
                                            <td class="text-left"><strong>Date</strong></td>
                                            <td><strong>Action</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($transactions as $trans)
                                            <tr>
                                                <td>{{ $i }} @php $i++ @endphp</td>
                                                <td>{{ $trans->amount }}</td>
                                                <td>{{ $trans->trans_ref }}</td>
                                                <td>
                                                    <span class="badge badge-info">{{ $trans->status }}</span>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($trans->created_at)) }}</td>
                                                <td>

                                                </td>
                                            </tr>
                                            @if ($i > 5)
                                                @break
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-5 col-lg-5">
                        <div class="card" id="widgetUserList">
                            <div class="card-header cover overlay">
                                <img class="cover-image h-200" src="assets/examples/images/dashboard-header.jpg"
                                    alt="..." />
                                <div class="overlay-panel vertical-align overlay-background">
                                    <div class="vertical-align-middle">
                                        <a class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                                            @if ($data->profile_pix)
                                                <img src="{{ asset('storage/' . $data->profile_pix) }}" alt="">
                                            @else
                                                <img src="../global/portraits/default.png" alt="...">
                                            @endif
                                        </a>
                                        <div class="float-left">
                                            <div class="font-size-20">{{ $data->surname . ' ' . $data->first_name }}</div>
                                            <p class="mb-20 text-nowrap">
                                                <span class="text-break">{{ $data->email }}</span><br>
                                                <span class="text-break">{{ $data->phone }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block py-0">
                                <ul class="list-group list-group-full list-group-dividered mb-0">
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-5">Department</h5>
                                                <small>{{ $_COOKIE['prog_id'] }}</small>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-5">Programme</h5>
                                                <small>{{ $_COOKIE['degree'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="profile" class="btn-raised btn btn-danger btn-floating">
                                    <i class="icon md-edit" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Picture Upload</h5>
                </div>
                <div class="modal-body">
                    <p class="text-danger"><i
                            class="icon md-alert-triangle red-600 font-size-24 vertical-align-bottom mr-5"></i>
                        <small>You need to upload your passport photo to continue.</small>
                    </p>
                    <form method="post" action="/uploadProfileImage" enctype="multipart/form-data">
                        @csrf
                        <img class="avatar avatar-100" id="previewImg" src="../global/portraits/default.png"
                            alt="Placeholder">
                        <hr>
                        <p><input type="file" name="profileImage" accept="image/*" onchange='previewFile(this)' required>
                        </p>
                        <input type="hidden" value="{{ $data->profile_pix }}" id="check_picture" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var pic = $("#check_picture").val()
            if (pic == "") {
                $("#myModal").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.cookie/1.3.1/jquery.cookie.js"></script>
@endsection
