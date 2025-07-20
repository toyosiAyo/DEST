@extends("layouts.master_student") 

  @section("title")
      Course Registration
  @endsection

  @section("content")
    <body class="animsition site-menubar-push site-menubar-open site-menubar-fixed">
            <div class="page-content container-fluid">
                <div class="row" data-plugin="masonry">
                    <div class="col-lg-12 masonry-item">
                        <!-- Panel Tasks -->
                        <div class="panel">
                            <div class="panel-heading d-flex">
                                <h3 class="panel-title">Course Registration</h3>
                                <h3 class="panel-title">Semester - {{$settings->semester_name}}</h3>
                                <h3 class="panel-title">Session - {{$settings->session}}</h3>
                            </div>
                            <form id="courseRegForm" method="POST">
                                @csrf
                            <div class="table-responsive" data-plugin="scrollable">
                                <div data-role="container">
                                    <div data-role="content">
                                        <table id="reg_table" class="table table-responsive-sm table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>S/N</th>
                                                    <th>Course Code</th>
                                                    <th>Course Title</th>
                                                    <th>Unit</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php 
                                                    $i = 1; 
                                                @endphp
                                                @foreach($courses as $course) 
                                                <tr>
                                                    <td style="width: 50px;">
                                                        @if($course->course_status == 'C')
                                                        <input type="checkbox" value="{{$course->course_code.'_'.$course->course_title.'_'.$course->unit.'_'.$course->course_status.'_'.$course->course_id}}" name="course[]" required>
                                                        @else
                                                        <input type="checkbox" value="{{$course->course_code.'_'.$course->course_title.'_'.$course->unit.'_'.$course->course_status}}" name="course[]">
                                                        @endif  
                                                    </td>
                                                    <td>{{ $i }} @php $i++ @endphp</td>
                                                    <td>{{ $course->course_code }}</td>
                                                    <td>{{ $course->course_title }}</td>
                                                    <td>{{ $course->unit }}</td>
                                                    <td>@php echo $course->course_status == 'C' ? 
                                                        '<span class="badge badge-danger">'.$course->course_status.'</span>' :
                                                        '<span class="badge badge-success">'.$course->course_status.'</span>' @endphp
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if(count($courses) > 0)<hr><button type="submit" id="btnSubmitRegForm" class="btn btn-primary btn-block">Submit</button>@endif
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