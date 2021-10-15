@extends("layouts.master") 

  @section("title")
      Applications
  @endsection

  @section("content")
    <body class="animsition site-menubar-push site-menubar-open site-menubar-fixed">
        <div class="page">
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
                                        <table class="table table-responsive-sm table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>App ID</th>
                                                    <th>Programme</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>56</td>
                                                    <td>Foundation (CMP)</td>
                                                    <td>5/29/2017</td>
                                                    <td><span class="badge badge-warning">PENDING</span></td>
                                                    <td><button type="button" class="btn btn-info" data-target="#exampleNiftyNewspaper" data-toggle="modal"><i class="icon md-trending-up" aria-hidden="true"></i> View</button></td>
                                                </tr>
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
    <div class="modal fade modal-newspaper" id="exampleNiftyNewspaper" aria-hidden="true"
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
                <span>Your application is still pending</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
        <!-- End Modal -->



  @endsection