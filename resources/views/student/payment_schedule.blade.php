@extends('layouts.master_student')

@section('title')
    Payments Breakdown
@endsection

@section('content')

    <body class="animsition site-menubar-push site-menubar-open site-menubar-fixed">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="masonry">
                <div class="col-lg-12 masonry-item">
                    <!-- Panel Tasks -->
                    <div class="panel">
                        <div class="panel-heading d-flex">
                            <h3 class="panel-title">Payment</h3>
                            <h3 class="panel-title">Semester - {{ $settings->semester_name }}</h3>
                            <h3 class="panel-title">Session - {{ $settings->session }}</h3>
                        </div>
                        <form id="schoolfeesForm" method="POST">
                            @csrf
                            <div class="table-responsive" data-plugin="scrollable">
                                <div data-role="container">
                                    <div data-role="content">
                                        <table id="reg_table" class="table table-responsive-sm table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Item</th>
                                                    <th>Total Amount</th>
                                                    <th>Amount Paid</th>
                                                    <th>Amount Due</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payload as $payment)
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <input type="checkbox" name="item[]"
                                                                value="{{ $payment->id }}" required>
                                                        </td>
                                                        <td>{{ $payment->item }}</td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>{{ $payment->amount_paid }}</td>
                                                        <td><input type="text" name="amount[]" size="6"
                                                                class="form-control" value="{{ $payment->amount_due }}"
                                                                required></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="email" value="{{ $data->email }}" hidden>
                            <input type="text" name="settings" value="{{ $settings }}" hidden>
                            <input type="text" name="surname" value="{{ $data->surname }}" hidden>
                            <input type="text" name="first_name" value="{{ $data->first_name }}" hidden>
                            <hr><button type="submit" id="btn_schoolfee" class="btn btn-primary btn-block">Proceed to
                                Payment</button>
                        </form>
                    </div>
                    <!-- End Panel Tasks -->
                </div>
            </div>
        </div>
        </div>
    </body>

    <script src="{{ asset('scripts/view_application.js') }}"></script>
@endsection
