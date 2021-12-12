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
                      role="tab">Per Time</a>
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
                              Foundation Programme description here
                              <form method="post" id="foundation_payment">
                                @csrf
                                <input type="hidden" value="{{$data->email}}" name="email" id="email" />
                                <input type="hidden" value="foundation" name="payType" id="payType" />
                                <input type="hidden" value="10000" name="amount" id="amount" />
                                <div class="animation-example animation-hover hover">
                                  <button type="submit" id="btn_foundation" class="btn btn-dark animation-scale-up">Create Application </button>
                                </div>
                              </form>
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
                            Pre-degree Programme description Here
                              <div class="animation-example animation-hover hover">
                                <button type="button" class="btn btn-dark animation-scale">Create Application</button>
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
                              HND Conversion Programme
                            </a>
                          </div>
                          <div class="panel-collapse collapse show" id="answer-8" aria-labelledby="question-8"
                            role="tabpanel">
                            <div class="panel-body">
                            HND Conversion Programme description Here
                              <div class="animation-example animation-hover hover">
                                <button type="button" class="btn btn-dark animation-shake">Create Application</button>
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
                  <h4 class="modal-title">Teller ID</h4>
              </div>
              <div class="modal-body">
                  <!-- <p>My applicatioon details</p> -->
                  <span id="details"></span>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
              </div>
          </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha512/0.8.0/sha512.min.js"></script>
      <script src=" https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>
      <script src="{{ asset('assets/examples/js/pages/faq.minfd53.js?v4.0.1') }}"></script>
      <script src=" {{ asset('scripts/create_application.js') }}"></script>
      <script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.cookie/1.3.1/jquery.cookie.js"></script>
    </body>
  @endsection
