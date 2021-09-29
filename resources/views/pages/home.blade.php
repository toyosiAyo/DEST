@extends("layouts.master") 

  @section("title")
      Home
  @endsection
    
  @section("content")
    <body class="animsition dashboard">
      <div class="page">
        <div class="page-content container-fluid">
          <div class="row" data-plugin="matchHeight" data-by-row="true">

            <div class="col-xl-4 col-md-6">
              <div class="card card-shadow" id="widgetLineareaOne">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>Applications
                    </div>
                    <span class="float-right grey-700 font-size-30">1</span>
                  </div>
                  <div class="mb-20 grey-500">
                    <i class="icon md-long-arrow-up green-500 font-size-16"></i> Create New
                  </div>
                  <div class="ct-chart h-50"></div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-shadow" id="widgetLineareaTwo">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>Pending Applications
                    </div>
                    <span class="float-right grey-700 font-size-30">0</span>
                  </div>
                  <div class="mb-20 grey-500">
                    <i class="icon md-long-arrow-up green-500 font-size-16"></i>View
                  </div>
                  <div class="ct-chart h-50"></div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-shadow" id="widgetLineareaThree">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>Approved Applications
                    </div>
                    <span class="float-right grey-700 font-size-30">1</span>
                  </div>
                  <div class="mb-20 grey-500">
                    <i class="icon md-long-arrow-down red-500 font-size-16"></i>View
                  </div>
                  <div class="ct-chart h-50"></div>
                </div>
              </div>
            </div>

            <div class="col-xxl-7 col-lg-7">
              <div class="panel" id="projects-status">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    Applications
                    <span class="badge badge-pill badge-info">1</span>
                  </h3>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td>App ID</td>
                        <td>Programme</td>
                        <td>Status</td>
                        <td class="text-left">Date</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>001</td>
                        <td>Foundation (LAW)</td>
                        <td>
                          <span class="badge badge-success">Approved</span>
                        </td>
                        <td>17/09/2021</td>
                      </tr>                     
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
                        <img src="../global/portraits/5.jpg" alt="">
                      </a>
                      <div class="float-left">
                        <div class="font-size-20">Robin Ahrens</div>
                        <p class="mb-20 text-nowrap">
                          <span class="text-break"><a href="https://getbootstrapadmin.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="98f5f9fbf0f1fcfdebf1fff6d8fff5f9f1f4">[email&#160;protected]</a></span>
                        </p>
                        <div class="text-nowrap font-size-18">
                          <a href="#" class="white mr-10">
                          <i class="icon bd-twitter"></i>
                        </a>
                          <a href="#" class="white mr-10">
                          <i class="icon bd-facebook"></i>
                        </a>
                          <a href="#" class="white">
                          <i class="icon bd-dribbble"></i>
                        </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-block py-0">
                  <ul class="list-group list-group-full list-group-dividered mb-0">
                    <li class="list-group-item">
                      <div class="media">
                        <div class="pr-20">
                          <a class="avatar avatar-lg" href="javascript:void(0)">
                            <img class="img-responsive" src="../global/portraits/1.jpg"
                              alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h5 class="mt-0 mb-5">Herman Beck</h5>
                          <small>San Francisco</small>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="pr-20">
                          <a class="avatar avatar-lg" href="javascript:void(0)">
                            <img class="img-responsive" src="../global/portraits/2.jpg"
                              alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h5 class="mt-0 mb-5">Mary Adams</h5>
                          <small>Salt Lake City, Utah</small>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="pr-20">
                          <a class="avatar avatar-lg" href="javascript:void(0)">
                            <img class="img-responsive" src="../global/portraits/3.jpg"
                              alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h5 class="mt-0 mb-5">Caleb Richards</h5>
                          <small>Basking Ridge, NJ</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <button type="button" class="btn-raised btn btn-danger btn-floating">
                    <i class="icon md-plus" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
  @endsection

