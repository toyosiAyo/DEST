@extends("layouts.master") 

  @section("title")
      Create application
  @endsection
    
  
  @section("content")
    <body class="animsition page-faq site-menubar-push site-menubar-open site-menubar-fixed">
      <!-- Page -->
      <div class="page">
        <div class="page-header">
          <h1 class="page-title">Create New Application</h1>
          <small>Select application type to proceed</small>
        </div>

        <div class="page-content container-fluid">
          <div class="row">
            <div class="col-xl-3 col-md-4">
              <!-- Panel -->
              <div class="panel">
                <div class="panel-body">
                  <div class="list-group faq-list" role="tablist">
                    <a class="list-group-item active" data-toggle="tab" href="#category-1" aria-controls="category-1"
                      role="tab">Foundation</a>
                    <a class="list-group-item" data-toggle="tab" href="#category-2" aria-controls="category-2"
                      role="tab">Pre-degree</a>
                    <a class="list-group-item" data-toggle="tab" href="#category-3" aria-controls="category-3"
                      role="tab">Part-Time</a>
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
                    <div class=" tab-pane active" id="category-1" role="tabpanel">
                      <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2"
                        aria-multiselectable="true" role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="question-1" role="tab">
                            <a class="panel-title" aria-controls="answer-1" aria-expanded="true" data-toggle="collapse"
                              href="#answer-1" data-parent="#accordion2">
                              Foundation Programme
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-1" aria-labelledby="question-1"
                            role="tabpanel">
                            <div class="panel-body">
                            Click the button below to create a new application or to continue with your unsubmitted application<br>
                              Application fee is (₦7,500)
                                <div class="animation-example animation-hover hover">
                                  <button type="submit" data-email="{{$data->email}}" data-amount="7500" data-paytype="foundation" class="btn btn-dark animation-scale-up pay">Create Application </button>
                                </div>
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
                              Pre-degree Programme
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-5" aria-labelledby="question-5"
                            role="tabpanel">
                            <div class="panel-body">
                            Click the button below to create a new application or to continue with your unsubmitted application<br>
                            Application fee is (₦7,500)
                                <div class="animation-example animation-hover hover">
                                  <button type="submit" data-email="{{$data->email}}" data-amount="7500" data-paytype="predegree" class="btn btn-dark animation-scale pay">Create Application </button>
                                </div>
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
                              HND Conversion/Part-Time Programme
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-8" aria-labelledby="question-8"
                            role="tabpanel">
                            <div class="panel-body">
                              Click the button below to create a new application or to continue with your unsubmitted application<br>
                            Application fee is (₦10,000)
                              <div class="animation-example animation-hover hover">
                                <button type="button" data-email="{{$data->email}}" data-amount="10000" data-paytype="part_time" class="btn btn-dark animation-shake pay">Create Application</button>
                              </div>
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

      <!-- Modal -->
      <div class="modal fade modal-newspaper" id="modal_teller" aria-hidden="true"
          aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-simple">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Payment Confirmation</h4>
                </div>
                <form method="post" id="form_teller">
                  @csrf
                  <input type="hidden" value="{{$data->email}}" name="email" id="email" />
                  <input type="hidden" value="" name="payType" id="payType" />
                  <input type="hidden" value="" name="amount" id="amount" />
                  <div class="modal-body">
                    <p>Pay the sum of ₦<span id="show_amount"></span> to (<span id="show_account"></span>) and enter Teller number here</p>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                      <input type="tel" class="form-control" id="rrr" name="rrr" required>
                      <label class="floating-label" for="rrr">Enter Teller Number</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSendteller" class="btn btn-primary">Send</button>
                  </div>
              </form>
              </div>
          </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha512/0.8.0/sha512.min.js"></script>
      <script src=" https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>
      <script src="{{ asset('assets/examples/js/pages/faq.minfd53.js?v4.0.1') }}"></script>
      <script src=" {{ asset('scripts/create_application.js') }}"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.cookie/1.3.1/jquery.cookie.js"></script>
    </body>
  @endsection
