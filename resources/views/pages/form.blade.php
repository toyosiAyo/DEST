@extends("layouts.master") 

  @section("title")
      Application Form
  @endsection

  @push('head')
  <link rel="stylesheet" href="{{ asset('global/vendor/bootstrap-select/bootstrap-select.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/forms/advanced.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/select2/select2.minfd53.css?v4.0.1') }}">

  <link rel="stylesheet" href="{{ asset('global/vendor/editable-table/editable-table.minfd53.css?v4.0.1') }}">

  <script src=" {{ asset('global/vendor/bootstrap-select/bootstrap-select.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/jquery-placeholder/jquery.placeholder.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/select2/select2.full.minfd53.js?v4.0.1') }}"></script>

  <script src=" {{ asset('global/js/Plugin/jquery-placeholder.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('assets/examples/js/forms/advanced.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin/bootstrap-select.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin/select2.minfd53.js?v4.0.1') }}"></script>

  <script src=" {{ asset('global/vendor/editable-table/mindmup-editabletablefd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin/editable-table.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('assets/examples/js/tables/editable.minfd53.js?v4.0.1') }}"></script>
  @endpush

  @section("content")
    <body class="animsition page-faq site-menubar-push site-menubar-open site-menubar-fixed">
      <!-- Page -->
      <div class="page">
        <div class="page-header">
          <h1 class="page-title">Application Form (Foundation)</h1>
          <small>NOTE: Fill in all details correctly</small>
        </div>

        <div class="page-content container-fluid">
          <div class="row">
            <div class="col-xl-3 col-md-4">
              <!-- Panel -->
              <div class="panel">
                <div class="panel-body">
                  <div class="list-group faq-list" role="tablist">
                    <a class="list-group-item active" data-toggle="tab" href="#category-1" aria-controls="category-1"
                      role="tab">Basic Information</a>
                    <a class="list-group-item" data-toggle="tab" href="#category-2" aria-controls="category-2"
                      role="tab">Academic Information</a>
                    <a class="list-group-item" data-toggle="tab" href="#category-3" aria-controls="category-3"
                      role="tab">Declaration</a>
                  </div>
                </div>
              </div>
              <!-- End Panel -->
            </div>

            <div class="col-xl-9 col-md-8">
              <!-- Panel -->
              <div class="panel">
                <div class="panel-body">
                  <div class="tab-content">
                    <!-- Categroy 1 -->
                    <div class=" tab-pane animation-fade active" id="category-1" role="tabpanel">
                      <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2"
                        aria-multiselectable="true" role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="question-1" role="tab">
                            <a class="panel-title" aria-controls="answer-1" aria-expanded="true" data-toggle="collapse"
                              href="#answer-1" data-parent="#accordion2">
                              Basic Information
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-1" aria-labelledby="question-1"
                            role="tabpanel">
                            <div class="panel-body">
                              <!-- Panel Full Example -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <form id="exampleFullForm" autocomplete="off">
                                            <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Full name
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" value="Orieye Adamu" name="fullname" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Email
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icon md-email" aria-hidden="true"></i>
                                                        </span>
                                                        <input type="email" value="orieye@gmail.com" class="form-control" name="email" readonly >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Address
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icon md-pin" aria-hidden="true"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="address" name="address" 
                                                            required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material example">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Date of Birth
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <input type="date" data-plugin="datepicker" class="form-control" id="dob" name="dob" 
                                                        required="" />
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Nationality
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <select class="form-control" id="country" name="country" required="">
                                                            <option value="">Choose Country</option>
                                                            <option value="apple">Nigeria</option>
                                                            <option value="google">USA</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">State of Origin
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <select class="form-control" id="state" name="state" required="">
                                                            <option value="">Choose a State</option>
                                                            <option value="apple">Abia</option>
                                                            <option value="google">Adamawa</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Name of Sponsor 
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="sponsor" name="sponsor" required>
                                                    </div>
                                                </div>                                                
                                            </div>

                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Marital Status
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="d-flex flex-column">
                                                        <div class="radio-custom radio-primary">
                                                            <input type="radio" id="single" name="marital" value="single" checked>
                                                            <label for="single">Single</label>
                                                        </div>

                                                        <div class="radio-custom radio-primary">
                                                            <input type="radio" id="married" name="marital" value="married">
                                                            <label for="married">Married</label>
                                                        </div>

                                                        <div class="radio-custom radio-primary">
                                                            <input type="radio" id="widowed" name="marital" value="widowed">
                                                            <label for="widowed">Widowed</label>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Religion
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <select class="form-control" id="religion" name="religion" required="">
                                                            <option value="">Choose Religion</option>
                                                            <option value="Christianity"> Christianity</option>
                                                            <option value="Islamic"> Islamic</option>
                                                            <option value="Other"> Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Physical Disability?</label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="d-flex flex-column">
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" id="disability_check" name="disability_check" value="yes">
                                                                <label for="disability_check">Yes</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material disability">
                                                    <label class="col-xl-12 col-md-3 form-control-label">State your disability</label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="disability" name="disability">
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Name of Next of Kin 
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="next_of_kin" name="next_of_kin" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Address of Next of Kin 
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="next_of_kin_address" name="next_of_kin_address" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Address of Sponsor 
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="sponsor_address" name="sponsor_address" required>
                                                    </div>
                                                </div> 
                                            </div>

                                            <div class="form-group form-material col-xl-12 text-right padding-top-m">
                                                <button type="submit" class="btn btn-primary" id="validateButton1">Next</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <!-- End Panel Full Example -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Categroy 1 -->

                    <!-- Categroy 2 -->
                    <div class="tab-pane animation-fade" id="category-2" role="tabpanel">
                      <div class="panel-group panel-group-simple panel-group-continuous" id="accordion"
                        aria-multiselectable="true" role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="question-5" role="tab">
                            <a class="panel-title" aria-controls="answer-5" aria-expanded="true" data-toggle="collapse"
                              href="#answer-5" data-parent="#accordion">
                              Academic Information
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-5" aria-labelledby="question-5"
                            role="tabpanel">
                            <div class="panel-body">
                                <!-- Panel Full Example -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <form id="exampleFullForm" autocomplete="off">
                                             <div class="row row-lg">
                                               <div class="col-xl-12 form-horizontal">
                                                 <div class="form-group row form-material">
                                                    <button id="addSchool" type="button" class="btn btn-sm btn-dark">
                                                      <i class="icon md-plus text" aria-hidden="true"></i>
                                                      <span class="text">Add</span>
                                                    </button>
                                                    <label class="col-xl-12 col-md-3 form-control-label">Secondary school(s) attended with dates
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="example col-xl-6 col-md-6">
                                                      <input type="text" class="form-control" name="sec_school[]" placeholder="Enter school name" required>
                                                    </div>
                                                    <div class="example col-xl-6 col-md-3 row">
                                                      <div class="input-daterange" data-plugin="datepicker">
                                                        <div class="input-group">
                                                          <input type="date" class="form-control" name="start[]" />
                                                          <span class="input-group-addon">to</span>
                                                          <input type="date" class="form-control" name="end[]" />
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div id="newSchool"></div>

                                                <div class="form-group row form-material">
                                                  <button id="addExam" type="button" class="btn btn-sm btn-dark">
                                                    <i class="icon md-plus text" aria-hidden="true"></i>
                                                    <span class="text">Add</span>
                                                  </button>
                                                  <label class="col-xl-12 col-md-3 form-control-label">Examinations taken
                                                      <span class="required">*</span>
                                                  </label>
                                                  <div class="example col-xl-3 col-md-3">
                                                    <select class="form-control" data-plugin="selectpicker" 
                                                      name="exam[]" data-live-search="true" data-allow-clear="true" data-placeholder="Select Exam">
                                                        <option value="WAEC">WAEC</option>
                                                        <option value="NECO">NECO</option>
                                                    </select>
                                                  </div>
                                                  <div class="example col-xl-3 col-md-3 ">
                                                    <select class="form-control" data-plugin="selectpicker" 
                                                      name="subject[]" data-live-search="true" data-allow-clear="true">
                                                      <option>Choose Subject</option>
                                                      <option value="English">English</option>
                                                      <option value="Mathematics">Further Mathematics</option>
                                                    </select>
                                                  </div>
                                                  <div class="example col-xl-3 col-md-3">
                                                    <select class="form-control" data-plugin="selectpicker" name="grade[]" 
                                                      data-live-search="true" data-placeholder="Select a Grade">
                                                      <option>Choose Grade</option>
                                                      <option value="A1">A1</option>
                                                      <option value="B2">B2</option>
                                                    </select>
                                                  </div>
                                                  <div class="example col-xl-3 col-md-3">
                                                    <select class="form-control" data-plugin="selectpicker" name="year[]" data-live-search="true" data-placeholder="Select a Year">
                                                      <option>Choose Year</option>
                                                      <option value="2021">2021</option>
                                                      <option value="2020">2020</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div id="newExam"></div>

                                                <div class="form-group row form-material">
                                                  <button id="addQulaification" type="button" class="btn btn-sm btn-dark">
                                                    <i class="icon md-plus text" aria-hidden="true"></i>
                                                    <span class="text">Add</span>
                                                  </button>
                                                  <label class="col-xl-12 col-md-3 form-control-label">Other Qualifications</label>
                                                  <div class="example col-xl-3 col-md-3">
                                                    <input type="text" class="form-control" name="institution_name[]" placeholder="Name of institution">
                                                  </div>
                                                  <div class="example col-xl-2 col-md-3">
                                                    <input type="text" class="form-control" name="institution_address[]" placeholder="Address">
                                                  </div>
                                                  <div class="example col-xl-2 col-md-3">
                                                    <input type="text" class="form-control" name="degree[]" placeholder="Grade/Degree">
                                                  </div>
                                                  <div class="example col-xl-5 col-md-3 row">
                                                      <div class="input-group">
                                                        <input type="date" class="form-control" name="start[]" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="date" class="form-control" name="end[]" />
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                  <label class="col-xl-12 col-md-3 form-control-label">Examinations taken</label>
                                                  <div class="example col-xl-12 col-md-3">
                                                    <table class="editable-table table table-striped" id="editableTable">
                                                      <thead>
                                                        <tr>
                                                          <th>Exam</th>
                                                          <th>Subject</th>
                                                          <th>Grade</th>
                                                          <th>Year</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      @for($i = 1; $i < 10; $i++)
                                                        <tr>
                                                          <td>
                                                            <select class="form-control" data-plugin="selectpicker" 
                                                              name="exam[]" data-live-search="true" data-allow-clear="true" data-placeholder="Select Exam">
                                                                <option value="WAEC">WAEC</option>
                                                                <option value="NECO">NECO</option>
                                                            </select>
                                                          </td>
                                                          <td><select class="form-control" data-plugin="selectpicker" 
                                                            name="subject[]" data-live-search="true" data-allow-clear="true">
                                                            <option>Choose Subject</option>
                                                            <option value="English">English</option>
                                                            <option value="Mathematics">Further Mathematics</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <select class="form-control" data-plugin="selectpicker" name="grade[]" 
                                                              data-live-search="true" data-placeholder="Select a Grade">
                                                              <option>Choose Grade</option>
                                                              <option value="A1">A1</option>
                                                              <option value="B2">B2</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <select class="form-control" data-plugin="selectpicker" name="year[]" data-live-search="true" data-placeholder="Select a Year">
                                                              <option>Choose Year</option>
                                                              <option value="2021">2021</option>
                                                              <option value="2020">2020</option>
                                                            </select>
                                                          </td>
                                                        </tr>
                                                      @endfor
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>

                                            </div>
                                            <div class="form-group form-material col-xl-12 text-right padding-top-m">
                                                <button type="submit" class="btn btn-primary" id="validateButton1">Next</button>
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            <!-- End Panel Full Example -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Categroy 2 -->

                    <!-- Categroy 3 -->
                    <div class="tab-pane animation-fade" id="category-3" role="tabpanel">
                      <div class="panel-group panel-group-simple panel-group-continuous" id="accordion1"
                        aria-multiselectable="true" role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="question-8" role="tab">
                            <a class="panel-title" aria-controls="answer-8" aria-expanded="true" data-toggle="collapse"
                              href="#answer-8" data-parent="#accordion1">
                              Declaration and File Upload
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-8" aria-labelledby="question-8"
                            role="tabpanel">
                            <div class="panel-body">
                              <table class="editable-table table table-striped" id="editableTable">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Cost</th>
                                    <th>Profit</th>
                                    <th>Fun</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>0</td>
                                  </tr>
                                  <tr>
                                    <td>Bike</td>
                                    <td>330</td>
                                    <td>240</td>
                                    <td>1</td>
                                  </tr>
                                  <tr>
                                    <td>Plane</td>
                                    <td>430</td>
                                    <td>540</td>
                                    <td>3</td>
                                  </tr>
                                  <tr>
                                    <td>Yacht</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>0</td>
                                  </tr>
                                  <tr>
                                    <td>Segway</td>
                                    <td>330</td>
                                    <td>240</td>
                                    <td>1</td>
                                  </tr>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th>
                                      <strong>Total</strong>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Categroy 3 -->
                  </div>
                </div>
              </div>
              <!-- End Panel -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Page -->

      <script> 
        $(document).ready(function(){
          $(".disability").hide();
          $('input[type="checkbox"]').click(function(){
            if($("#disability_check").prop('checked') == true){
              $(".disability").show();
            } 
            else {
              $(".disability").hide();
            }
          }) 

            // add row
          $("#addSchool").click(function () {              
              var html = '';
              html += '<div id="sec_school" class="col-xl-12 form-horizontal">';
              html += '<div class="form-group row form-material">';
              html += '<div class="example col-xl-6 col-md-6">';                         
              html += '<input type="text" class="form-control" name="sec_school[]" placeholder="Enter school name" required>';
              html += '</div>';
              html += '<div class="example col-xl-6 col-md-3 row">';
              html += '<div class="input-daterange" data-plugin="datepicker">';
              html += '<div class="input-group">';
              html += '<input type="date" class="form-control" name="start[]" />';
              html += '<span class="input-group-addon">to</span>';
              html += '<input type="date" class="form-control" name="end[]" />';
              html += '</div>';
              html += '</div>';
              html += '</div>';
              html += '<button id="removeSchool" type="button" class="btn btn-sm btn-danger text-left">';
              html += '<i class="icon md-minus text-active" aria-hidden="true"></i>';
              html += '<span class="text">Remove</span>';
              html += '</button>';
              html += '</div>';
              html += '</div>';
              $('#newSchool').append(html);
          });   

          $("#addExam").click(function () {              
              var html = '';
              html += '<div id="exam" class="col-xl-12 form-horizontal">';
              html += '<div class="form-group row form-material">';
              html += '<div class="example col-xl-3 col-md-3">';                         
              html += '<select class="form-control" data-plugin="selectpicker" name="exam[]" data-live-search="true" data-allow-clear="true" data-placeholder="Select Exam">';
              html += '<option value="WAEC">WAEC</option>';
              html += '<option value="NECO">NECO</option>';
              html += '</select>';
              html += '</div>';
              html += '<div class="example col-xl-3 col-md-3">';                         
              html += '<select class="form-control" data-plugin="selectpicker" name="subject[]" data-live-search="true" data-allow-clear="true">';
              html += '<option>Choose Subject</option>';
              html += '<option value="Mathematics">Further Mathematics</option>';
              html += '<option value="Mathematics">Mathematics</option>';
              html += '</select>';
              html += '</div>';
              html += '<div class="example col-xl-3 col-md-3">';                         
              html += '<select class="form-control" data-plugin="selectpicker" name="grade[]" data-live-search="true" data-placeholder="Select a Grade">';
              html += '<option>Choose Grade</option>';
              html += '<option value="A1">A1</option>';
              html += '<option value="B2">B2</option>';
              html += '</select>';
              html += '</div>';
              html += '<div class="example col-xl-3 col-md-3">';
              html += '<select class="form-control" data-plugin="selectpicker" name="year[]" data-live-search="true" data-placeholder="Select a Year">';
              html += '<option>Choose Year</option>';
              html += '<option value="2021">2021</option>';
              html += '<option value="2020">2020</option>';
              html += '</select>';
              html += '</div>';
              html += '<button id="removeExam" type="button" class="btn btn-sm btn-danger text-left">';
              html += '<i class="icon md-minus text-active" aria-hidden="true"></i>';
              html += '<span class="text">Remove</span>';
              html += '</button>';
              html += '</div>';
              html += '</div>';
              $('#newExam').append(html);
          });      
                                                                                                              
                                                             
          // remove row
          $(document).on('click', '#removeSchool', function () {
            $(this).closest('#sec_school').remove();
          });
          $(document).on('click', '#removeExam', function () {
            $(this).closest('#exam').remove();
          });
        })
      </script>

  <script src="../assets/examples/js/tables/editable.minfd53.js?v4.0.1"></script>
      
    </body>
  @endsection
