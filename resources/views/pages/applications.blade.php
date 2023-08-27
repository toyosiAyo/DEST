@extends("layouts.master") 

  @section("title")
      Applications
  @endsection

  @section("content")
    <body class="animsition site-menubar-push site-menubar-open site-menubar-fixed">
        <div class="page">
        @if(Session::get('appSubmit'))
        <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon md-close" aria-hidden="true"></i> {{Session::get('appSubmit')}}
        </div>
         @endif
            <div class="page-content container-fluid">
                <div class="row" data-plugin="masonry">
                    <div class="col-lg-12 masonry-item">
                        <!-- Panel Tasks -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Application(s)</h3>
                            </div>
                            <div class="table-responsive h-250" data-plugin="scrollable">
                                <div data-role="container">
                                    <div data-role="content">
                                        <table id="app_table" class="table table-responsive-sm table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Programme</th>
                                                    <th>Type</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1; @endphp
                                                @foreach($apps as $app)
                                                <tr>
                                                    <td>{{ $i }} @php $i++ @endphp</td>
                                                    <td>{{ $app->Programme }}</td>
                                                    <td>{{ $app->app_type }}</td>
                                                    <td>{{ date("d M Y", strtotime($app->updated_at)) }}</td>
                                                    <td>@php echo $app->status == 'pending' ? 
                                                        '<span class="badge badge-warning">'.$app->status.'</span>' :
                                                        '<span class="badge badge-success">'.$app->status.'</span>' @endphp
                                                    </td>
                                                    <td>
                                                        @if($app->status == 'pending')
                                                        <button type="submit" data-email="{{$app->submitted_by}}" data-amount="7500" data-paytype="{{$app->app_type}}" class="btn btn-dark animation-scale-up pay">Continue Application</button>
                                                        @elseif($app->status == 'admitted')
                                                        <button type="button" class="btn btn-info view" data-id="{{$app->id}}" 
                                                            data-status="{{$app->status}}">
                                                            <i class="icon md-trending-up" aria-hidden="true"></i> View
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Panel Tasks -->
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- Modal -->
    <div class="modal fade modal-newspaper" id="view_app" aria-hidden="true"
        aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Application details</h4>
            </div>
            <div class="modal-body">
                <!-- <p>My applicatioon details</p> -->
                <span id="details"></span><hr>
                Click <a href="#" class="download_letter">here</a> to download admission letter
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
        <!-- End Modal -->
    <script src="{{ asset('scripts/view_application.js') }}"></script>
    <script src=" {{ asset('scripts/create_application.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.cookie/1.3.1/jquery.cookie.js"></script>
  @endsection