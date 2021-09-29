@extends("layouts.master") 

  @section("title")
      Application Form
  @endsection
    
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
                                                        <input type="text" class="form-control" value="Orieye Adamu" id="fullname" name="fullname" 
                                                        required="">
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
                                                    <input type="email" class="form-control" name="email" placeholder="email@email.com"
                                                        required="">
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">Password
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-xl-12 col-md-9">
                                                    <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="icon md-lock" aria-hidden="true"></i>
                                                    </span>
                                                    <input type="password" class="form-control" name="password" placeholder="Min length 8"
                                                        required="">
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">Birthday
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-xl-12 col-md-9">
                                                    <input type="text" class="form-control" name="birthday" placeholder="YYYY/MM/DD"
                                                    required="" />
                                                </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">GitHub</label>
                                                <div class="col-xl-12 col-md-9">
                                                    <input type="url" class="form-control" name="github" placeholder="https://github.com/amazingSurge">
                                                </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">Company</label>
                                                <div class="col-xl-12 col-md-9">
                                                    <select class="form-control" id="company" name="company" required="">
                                                    <option value="">Choose a Company</option>
                                                    <option value="apple">Apple</option>
                                                    <option value="google">Google</option>
                                                    <option value="microsoft">Microsoft</option>
                                                    <option value="yahoo">Yahoo</option>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">Remark Admin is
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-xl-12 col-md-9">
                                                    <div class="d-flex flex-column">
                                                    <div class="radio-custom radio-primary">
                                                        <input type="radio" id="inputAwesome" name="porto_is" value="awesome" required="">
                                                        <label for="inputAwesome">Awesome</label>
                                                    </div>

                                                    <div class="radio-custom radio-primary">
                                                        <input type="radio" id="inputVeryAwesome" name="porto_is" value="very-awesome">
                                                        <label for="inputVeryAwesome">Very Awesome</label>
                                                    </div>

                                                    <div class="radio-custom radio-primary">
                                                        <input type="radio" id="inputUltraAwesome" name="porto_is" value="ultra-awesome">
                                                        <label for="inputUltraAwesome">Ultra Awesome</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">I will use it for
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-xl-12 col-md-9">
                                                    <div class="d-flex flex-column">
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" id="inputForProject" name="for[]" value="project" required="">
                                                        <label for="inputForProject">My Project</label>
                                                    </div>

                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" id="inputForWebsite" name="for[]" value="website">
                                                        <label for="inputForWebsite">My Website</label>
                                                    </div>

                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" id="inputForAll" name="for[]" value="all">
                                                        <label for="inputForAll">All things I do</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">Skills
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-xl-12 col-md-9">
                                                    <textarea class="form-control" name="skills" rows="3" placeholder="Describe your skills"
                                                    required=""></textarea>
                                                </div>
                                                </div>
                                                <div class="form-group row form-material">
                                                <label class="col-xl-12 col-md-3 form-control-label">Browsers</label>
                                                <div class="col-xl-12 col-md-9">
                                                    <select class="form-control" id="browsers" name="browsers" title="Please select at least one browser"
                                                    size="5" multiple="multiple" required="">
                                                    <option value="chrome">Chrome / Safari</option>
                                                    <option value="ff">Firefox</option>
                                                    <option value="ie">Internet Explorer</option>
                                                    <option value="opera">Opera</option>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-material col-xl-12 text-right padding-top-m">
                                                <button type="submit" class="btn btn-primary" id="validateButton1">Submit</button>
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
                              Payment Widget Here
                              
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
                              Payment Widget Here
                              
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

      <script src="../assets/examples/js/pages/faq.minfd53.js?v4.0.1"></script>
    </body>
  @endsection
