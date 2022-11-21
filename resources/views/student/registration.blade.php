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
                            <div class="panel-heading">
                                <h3 class="panel-title">Course Registration</h3>
                            </div>
                            <form id="courseRegForm" method="POST">
                                @csrf
                            <div class="table-responsive h-250" data-plugin="scrollable">
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

                                                @if($course->course_status == 'C')
                                                    $required = 'required'
                                                <!-- @else
                                                    $required = '' -->
                                                @endif
                                                <tr>
                                                    <td style="width: 50px;">
                                                        <input type="checkbox" value="{{$course->course_code.'_'.$course->course_title.'_'.$course->unit.'_'.$course->course_status}}" name="course[]" {{$required}}>
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
                            <button type="submit" id="btnSubmitRegForm" class="btn btn-primary btn-block">Submit</button>
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