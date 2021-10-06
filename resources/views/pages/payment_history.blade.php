@extends("layouts.master") 

  @section("title")
      Payment History
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
                                <h3 class="panel-title">Payment History</h3>
                            </div>
                            <div class="table-responsive h-250" data-plugin="scrollable">
                                <div data-role="container">
                                    <div data-role="content">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>568968</td>
                                                    <td>7500</td>
                                                    <td>5/29/2017</td>
                                                    <td><span class="badge badge-warning">PENDING</span></td>
                                                    <td><button type="button" class="btn btn-danger"><i class="icon md-refresh" aria-hidden="true"></i> Requery</button></td>
                                                </tr>
                                                <tr>
                                                    <td>568968</td>
                                                    <td>7500</td>
                                                    <td>5/29/2017</td>
                                                    <td><span class="badge badge-warning">PENDING</span></td>
                                                    <td><button type="button" class="btn btn-danger"><i class="icon md-refresh" aria-hidden="true"></i> Requery</button></td>
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



  @endsection