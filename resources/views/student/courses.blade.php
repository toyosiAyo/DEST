@extends("layouts.master_student") 

  @section("title")
      Courses
  @endsection

  @section("content")
    <body class="animsition site-menubar-push site-menubar-open site-menubar-fixed">
            <div class="page-content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Panel Tasks -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Registered Courses</h3>
                            </div>
                            <div class="table-responsive">
                                <div data-role="container">
                                    <div data-role="content">
                                        <table id="reg_table" class="table table-responsive-sm table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Course Code</th>
                                                    <th>Course Title</th>
                                                    <th>Unit</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1; @endphp
                                                @foreach($courses as $course)
                                                <tr>
                                                    <td>{{ $i }} @php $i++ @endphp</td>
                                                    <td>{{ $course->course_code }}</td>
                                                    <td>{{ $course->course_title }}</td>
                                                    <td>{{ $course->unit }}</td>
                                                    <td>@php echo $course->status == 'C' ? 
                                                        '<span class="badge badge-danger">'.$course->status.'</span>' :
                                                        '<span class="badge badge-success">'.$course->status.'</span>' @endphp
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