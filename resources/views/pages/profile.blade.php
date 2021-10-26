@extends("layouts.master") 

  @section("title")
      Profile
  @endsection

  @push('head')
    <link rel="stylesheet" href="../assets/examples/css/pages/profile.minfd53.css?v4.0.1">
  @endpush

  @section("content")
    <body class="animsition page-profile site-menubar-push site-menubar-open site-menubar-fixed">
        <div class="page">
            <div class="page-content container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Page Widget -->
                        <div class="card card-shadow text-center">
                            <div class="card-block">
                                <a class="avatar avatar-lg" href="javascript:void(0)">
                                @if($data->profile_pix)
                                    <img src="{{asset('storage/'. $data->profile_pix) }}" alt="">
                               @else <img src="../global/portraits/default.png" alt="...">
                                 @endif
               
                                </a>
                                <h4 class="profile-user">{{$data->surname.' '.$data->first_name}}</h4>
                                <form method="post" action="/uploadProfileImage" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="profileImage" required> <hr>
                                    <button type="submit" class="btn btn-primary">Update Profile Image</button>
                                </form>
                            </div>
                        </div>
                        <!-- End Page Widget -->
                    </div>

                    <div class="col-lg-9">
                        <!-- Panel -->
                        <div class="panel">
                            <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                    <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#activities"
                                        aria-controls="activities" role="tab">Profile</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active animation-slide-left" id="activities" role="tabpanel">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Email</label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icon md-email" aria-hidden="true"></i>
                                                        </span>
                                                        <input type="email" value="{{$data->email}}" class="form-control" name="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Phone number</label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icon md-phone" aria-hidden="true"></i>
                                                        </span>
                                                        <input type="tel" value="{{$data->phone}}" class="form-control" name="phone" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <button class="btn btn-block btn-default">Update</button>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Panel -->
                    </div>
                </div>
            </div>
        </div>
    </body>


  @endsection