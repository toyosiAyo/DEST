@extends("layouts.master") 

  @section("title")
      Application Form
  @endsection

  @push('head')
  <link rel="stylesheet" href="{{ asset('global/vendor/bootstrap-select/bootstrap-select.minfd53.css?v4.0.1') }}">
  <link rel="stylesheet" href="{{ asset('global/vendor/select2/select2.minfd53.css?v4.0.1') }}">


  <script src=" {{ asset('global/vendor/bootstrap-select/bootstrap-select.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/vendor/select2/select2.full.minfd53.js?v4.0.1') }}"></script>

  <script src=" {{ asset('global/js/Plugin/bootstrap-select.minfd53.js?v4.0.1') }}"></script>
  <script src=" {{ asset('global/js/Plugin/select2.minfd53.js?v4.0.1') }}"></script>
  <script src="{{ asset('scripts/misc.js') }}"></script>
  <script src="{{ asset('scripts/save_application.js') }}"></script>
  <script src="{{ asset('scripts/validation.min.js') }}"></script>
  @endpush

  @section("content")
    <style>
      .invalid {
        color:#ff0000;
      }
    </style>
    <body class="animsition page-faq site-menubar-push site-menubar-open site-menubar-fixed">
      <!-- Page -->
      <div class="page">
        <div class="page-header">
          <h1 class="page-title">Application Form (Foundation)</h1>
          <small>NOTE: Fill in all details correctly, also, fields marked <span class="required" style="color:red">*</span> are required </small>
        </div>

        <div class="page-content container-fluid">
          <div class="row">
            <div class="col-xl-3 col-md-4">
              <!-- Panel -->
              <div class="panel">
                <div class="panel-body">
                  <div class="list-group faq-list" role="tablist">
                    <button id="basic_info" class="btn btn-primary list-group-item" data-target="#category-1" data-toggle="tab" aria-controls="category-1"
                      role="tab">Basic Information</button><br>
                    <button id="academic_info" class="btn btn-dark list-group-item" data-target="#category-2" data-toggle="tab" aria-controls="category-2"
                      role="tab" disabled>Academic Information</button><br>
                    <button id="declaration_info" class="btn btn-info list-group-item" data-target="#category-3" data-toggle="tab" aria-controls="category-3"
                      role="tab" disabled>Declaration</button>
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
                    <div class="tab-pane active" id="category-1" role="tabpanel">
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
                                        <form id="form_basic" method="post" autocomplete="off">
                                            @csrf
                                            <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Full name
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" value="Orieye Adamu" name="fullname" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Email
                                                        <span class="required" style="color:red">*</span>
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
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icon md-pin" aria-hidden="true"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="address_resident" name="address_resident" 
                                                            required="">
                                                          <input type="hidden" class="form-control" value="basic" id="check_step" name="check_step">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material example">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Date of Birth
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <input type="date" data-plugin="datepicker" class="form-control" id="dob" name="dob" 
                                                        required="" />
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">City of Residence 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="city_resident" name="city_resident" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Nationality
                                                        <span class="required" style="color:red">*</span>
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
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <select class="form-control" id="state_origin" name="state_origin" required="">
                                                            <option value="">Choose a State</option>
                                                            <option value="Abia">Abia</option>
                                                            <option value="Adamawa">Adamawa</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">LGA
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class="col-xl-12 col-md-9">
                                                        <select class="form-control" id="lga_origin" name="lga_origin" required="">
                                                            <option value="">Choose LGA</option>
                                                            <option value="Alimosho">Alimosho</option>
                                                            <option value="Somolu">Somolu</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Religion
                                                        <span class="required" style="color:red">*</span>
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
                                            </div>

                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Marital Status
                                                        <span class="required" style="color:red">*</span>
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
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="next_of_kin" name="next_of_kin" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Phone number of Next of Kin 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="tel" class="form-control" id="nok_phone" name="nok_phone" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Relationship with Next of Kin 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="nok_relationship" name="nok_relationship" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Address of Next of Kin 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="next_of_kin_address" name="next_of_kin_address" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Name of Sponsor 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="text" class="form-control" id="sponsor_name" name="sponsor_name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Email address of Sponsor 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="email" class="form-control" id="sponsor_email" name="sponsor_email" required>
                                                    </div>
                                                </div> 

                                                <div class="form-group row form-material">
                                                    <label class="col-xl-12 col-md-3 form-control-label">Phone number of Sponsor 
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class=" col-xl-12 col-md-9">
                                                        <input type="tel" class="form-control" id="sponsor_phone" name="sponsor_phone" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-material col-xl-12 text-right padding-top-m">
                                                <button type="submit" class="btn btn-primary" id="btn_basic">Next</button>
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
                    <div class="tab-pane" id="category-2" role="tabpanel">
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
                                        <form method="post" id="form_academic" autocomplete="off">
                                            @csrf
                                             <div class="row row-lg">
                                               <div class="col-xl-12 form-horizontal">
                                                 <div class="form-group row form-material">
                                                    <button id="addSchool" type="button" class="btn btn-sm btn-dark">
                                                      <i class="icon md-plus text" aria-hidden="true"></i>
                                                      <span class="text">Add</span>
                                                    </button>
                                                    <label class="col-xl-12 col-md-3 form-control-label">Secondary school(s) attended with dates
                                                        <span class="required" style="color:red">*</span>
                                                    </label>
                                                    <div class="example col-xl-6 col-md-6">
                                                      <input type="text" class="form-control"  name="sec_school[]" placeholder="Enter school name" required>
                                                      <input type="hidden" class="form-control" value="academic" id="check_step" name="check_step">
                                                    </div>
                                                    <div class="example col-xl-6 col-md-3 row">
                                                      <div class="input-daterange" data-plugin="datepicker">
                                                        <div class="input-group">
                                                          <input type="date" class="form-control" name="school_start[]" required/>
                                                          <span class="input-group-addon">to</span>
                                                          <input type="date" class="form-control" name="school_end[]" required/>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div id="newSchool"></div> 

                                                <div class="form-group row form-material">
                                                  <label class="col-xl-12 col-md-3 form-control-label">Examinations taken
                                                    <span class="required" style="color:red">*</span>
                                                  </label>
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
                                                            <select class="form-control" name="exam[]" required>
                                                                <option>Select Exam</option>
                                                                <option value="WAEC">WAEC</option>
                                                                <option value="NECO">NECO</option>
                                                            </select>
                                                          </td>
                                                          <td><select class="form-control" name="subject[]" required>
                                                            <option>Choose Subject</option>
                                                            <option value="English">English</option>
                                                            <option value="Mathematics">Further Mathematics</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <select class="form-control" name="grade[]" required>
                                                              <option>Choose Grade</option>
                                                              <option value="A1">A1</option>
                                                              <option value="B2">B2</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <select class="form-control" name="year[]" required>
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

                                                <div class="form-group row form-material">
                                                  <button id="addQualification" type="button" class="btn btn-sm btn-dark">
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
                                                        <input type="date" class="form-control" name="inst_start[]" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="date" class="form-control" name="inst_end[]" />
                                                      </div>
                                                  </div>
                                                </div>
                                                <div id="newQulalification"></div>

                                            </div>
                                            <div class="form-group form-material col-xl-12 text-right padding-top-m">
                                                <button type="submit" class="btn btn-primary" id="btn_academic">Next</button>
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
                    <div class="tab-pane" id="category-3" role="tabpanel">
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
                              <!-- Panel Full Example -->
                              <form method="post" id="form_declaration" autocomplete="off">
                                @csrf
                                <div class="col-xl-12 form-horizontal">
                                  <div class="form-group row form-material">
                                    <label class="col-xl-12 col-md-3 form-control-label">(First Choice) Information on Programme of Study
                                      <span class="required" style="color:red">*</span>
                                    </label>
                                  <div class="example col-xl-3 col-md-3">
                                  <input type="hidden" class="form-control" value="declaration" id="check_step" name="check_step">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="faculty" id="faculty" data-live-search="true" data-allow-clear="true">
                                      <option>Select Faculty</option>
                                      <option value="Science">Natural Science</option>
                                      <option value="Humanities">Humanities</option>
                                    </select>
                                  </div>
                                  <div class="example col-xl-3 col-md-3 ">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="department" id="department" data-live-search="true" data-allow-clear="true">
                                      <option>Select Department</option>
                                      <option value="CMP">Computer Science</option>
                                      <option value="LAW">LAW</option>
                                    </select>
                                  </div>
                                  <div class="example col-xl-3 col-md-3">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="programme" id="programme" data-live-search="true" data-allow-clear="true">
                                      <option>Select programme</option>
                                      <option value="CMP">Computer Science</option>
                                      <option value="LAW">LAW</option>
                                    </select>
                                  </div>
                                  <div class="example col-xl-3 col-md-3">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="combination" id="combination" data-live-search="true" data-allow-clear="true">
                                      <option>Select JUPEB Combination</option>
                                      <option value="CMP">Mathematics-Physics-Chemistry</option>
                                      <option value="LAW">Litrature-Government-CRS</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-xl-12 form-horizontal">
                                  <div class="form-group row form-material">
                                    <label class="col-xl-12 col-md-3 form-control-label">(Second choice) Information on Programme of Study
                                      <span class="required" style="color:red">*</span>
                                    </label>
                                  <div class="example col-xl-3 col-md-3">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="faculty2" id="faculty2" data-live-search="true" data-allow-clear="true">
                                      <option>Select Faculty</option>
                                      <option value="Science">Natural Science</option>
                                      <option value="Humanities">Humanities</option>
                                    </select>
                                  </div>
                                  <div class="example col-xl-3 col-md-3 ">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="department2" id="department2" data-live-search="true" data-allow-clear="true">
                                      <option>Select Department</option>
                                      <option value="CMP">Computer Science</option>
                                      <option value="LAW">LAW</option>
                                    </select>
                                  </div>
                                  <div class="example col-xl-3 col-md-3">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="programme2" id="programme2" data-live-search="true" data-allow-clear="true">
                                      <option>Select programme</option>
                                      <option value="CMP">Computer Science</option>
                                      <option value="LAW">LAW</option>
                                    </select>
                                  </div>
                                  <div class="example col-xl-3 col-md-3">
                                    <select class="form-control" data-plugin="selectpicker" required
                                      name="combination2" id="combination2" data-live-search="true" data-allow-clear="true">
                                      <option>Select JUPEB Combination</option>
                                      <option value="CMP">Mathematics-Physics-Chemistry</option>
                                      <option value="LAW">Litrature-Government-CRS</option>
                                    </select>
                                  </div>
                                </div>
                                  
                                <div class="col-xl-12 form-horizontal">
                                  <div class="form-group row form-material">
                                    <div class="example col-xl-6 col-md-3">
                                      <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input type="text" class="form-control" placeholder="Upload Signature" readonly="">
                                        <span class="input-group-btn">
                                          <span class="btn btn-primary btn-file">
                                            <i class="icon md-upload" aria-hidden="true"></i>
                                            <input type="file" id="signature" name="signature" required> 
                                          </span>
                                        </span>
                                      </div>
                                    </div>
                                    <div class="example col-xl-6 col-md-3">
                                      <select class="form-control" data-plugin="selectpicker" required
                                        name="screening_date" id="screening_date" data-live-search="true" data-allow-clear="true">
                                        <option>Select Screening Date</option>
                                        <option value="17/10/2021">17/10/2021</option>
                                        <option value="20/10/2021">20/10/2021</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="checkbox-custom checkbox-success">
                                  <input type="checkbox" id="accept_terms" name="accept_terms" required />
                                  <label for="accept_terms"><small>I declare that I wish to enter the Redeemer's University Foundation degree Programme in the 2021/2022 session.
                                    The credentials given in this form are correct to the best of my knowledge. If admitted to the University,
                                    I shall regard myself bound by the ordinance, code of conduct, statuses and regulations of the University as
                                    far as they affect me.
                                    I understand that withholding any information requested or giving false information may make me ineligible for 
                                    admission, registration, matriculation or expulsion from the University.
                                    If discovered at any time that I do not possess any of the qualifications which I claim to have obtained, I will
                                    be expelled from the University and shall not be re-admitted for the same or any other programme, even if I have
                                    upgraded my previous qualifications or possess additional qualifications.</small>
                                  </label>
                                </div>
                                <div class="form-group form-material col-xl-12 text-right padding-top-m">
                                  <button type="submit" class="btn btn-primary" id="btn_declaration">Submit Application</button>
                                </div>
                              </form>
                            </div>
                            <!-- End Panel Full Example -->
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
    </body>
  @endsection
