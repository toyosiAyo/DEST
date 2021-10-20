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
                                        <table class="table table-responsive-sm table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Transaction ID</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1; @endphp
                                                @foreach($payments as $payment)
                                                <tr>
                                                    <td>{{ $i }} @php $i++ @endphp</td>
                                                    <td>{{ $payment->trans_ref }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ date("d M Y", strtotime($payment->updated_at)) }}</td>
                                                    <td>@php echo $payment->status_msg == 'pending' ?
                                                        '<span class="badge badge-warning"> '.$payment->status_msg.'</span>' :
                                                        '<span class="badge badge-success">'.$payment->status_msg.'</span>' @endphp
                                                    </td>
                                                    <td>@php echo $payment->status_msg == 'pending' ?
                                                        '<button type="button" class="btn btn-danger">
                                                            <i class="icon md-refresh" aria-hidden="true"></i> Requery
                                                        </button>' :
                                                        '<button type="button" class="btn btn-success">
                                                            <i class="icon md-print" aria-hidden="true"></i> Print Receipt
                                                        </button>' @endphp
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



  @endsection