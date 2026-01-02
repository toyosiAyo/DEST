@extends('layouts.master')

@section('title')
    Application Form
@endsection

@push('head')
    <link rel="stylesheet" href="{{ asset('global/vendor/bootstrap-select/bootstrap-select.minfd53.css?v4.0.1') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/select2/select2.minfd53.css?v4.0.1') }}">


    <script src=" {{ asset('global/vendor/bootstrap-select/bootstrap-select.minfd53.js?v4.0.1') }}"></script>
    <script src=" {{ asset('global/vendor/select2/select2.full.minfd53.js?v4.0.1') }}"></script>

    {{-- <script src=" {{ asset('global/js/Plugin/bootstrap-select.minfd53.js?v4.0.1') }}"></script>
    <script src=" {{ asset('global/js/Plugin/select2.minfd53.js?v4.0.1') }}"></script> --}}

    <script src="{{ asset('scripts/misc.js') }}"></script>
    <script src="{{ asset('scripts/save_application.js') }}"></script>
    <script src="{{ asset('scripts/validation.min.js') }}"></script>
@endpush

@section('content')

    <body class="animsition page-faq site-menubar-push site-menubar-open site-menubar-fixed">
        <!-- Page -->
        <div class="page">
            <div class="page-header">
                <h1 class="page-title">Application Form ({{ $_COOKIE['app_type'] }})</h1>
                <small>NOTE: Fill in all details correctly, also, fields marked <span class="required"
                        style="color:red">*</span> are required </small>
            </div>
            <div class="page-content container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <!-- Panel -->
                        <div class="panel">
                            <div class="panel-body">
                                <div class="list-group faq-list" role="tablist">
                                    <button id="basic_info" class="btn btn-primary list-group-item"
                                        data-target="#category-1" data-toggle="tab" aria-controls="category-1"
                                        role="tab">Basic Information</button><br>
                                    <button id="academic_info" class="btn btn-dark list-group-item"
                                        data-target="#category-2" data-toggle="tab" aria-controls="category-2"
                                        role="tab">Academic Information</button><br>
                                    <button id="declaration_info" class="btn btn-info list-group-item"
                                        data-target="#category-3" data-toggle="tab" aria-controls="category-3"
                                        role="tab">Declaration</button>
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
                                    <div class="tab-pane" id="category-1" role="tabpanel">
                                        <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2"
                                            aria-multiselectable="true" role="tablist">
                                            <div class="panel">
                                                <div class="panel-heading" id="question-1" role="tab">
                                                    <a class="panel-title" aria-controls="answer-1" aria-expanded="true"
                                                        data-toggle="collapse" href="#answer-1" data-parent="#accordion2">
                                                        Basic Information
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-1"
                                                    aria-labelledby="question-1" role="tabpanel">
                                                    <div class="panel-body">
                                                        <!-- Panel Full Example -->
                                                        <div class="panel">
                                                            <div class="panel-body">
                                                                <form id="form_basic" method="post" autocomplete="off">
                                                                    @csrf
                                                                    <div class="row row-lg">
                                                                        <div class="col-xl-6 form-horizontal">
                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Full
                                                                                    name
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        value="{{ $data->surname . ' ' . $data->first_name }}"
                                                                                        name="fullname" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Email
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon">
                                                                                            <i class="icon md-email"
                                                                                                aria-hidden="true"></i>
                                                                                        </span>
                                                                                        <input type="email"
                                                                                            value="{{ $data->email }}"
                                                                                            class="form-control"
                                                                                            name="email" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Address
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon">
                                                                                            <i class="icon md-pin"
                                                                                                aria-hidden="true"></i>
                                                                                        </span>
                                                                                        <input type="text"
                                                                                            value="{{ $data->address_resident }}"
                                                                                            class="form-control"
                                                                                            id="address_resident"
                                                                                            name="address_resident"
                                                                                            required="">
                                                                                        <input type="hidden"
                                                                                            class="form-control"
                                                                                            value="basic" id="check_step"
                                                                                            name="check_step">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                class="form-group row form-material example">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Date
                                                                                    of Birth
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <input type="date"
                                                                                        value="{{ $data->dob }}"
                                                                                        data-plugin="datepicker"
                                                                                        class="form-control"
                                                                                        id="dob" name="dob"
                                                                                        required="" />
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">City
                                                                                    of Residence
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        value="{{ $data->city_resident }}"
                                                                                        id="city_resident"
                                                                                        name="city_resident" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">State
                                                                                    of Residence
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <select class="form-control state"
                                                                                        id="state_resident"
                                                                                        name="state_resident"
                                                                                        required="">
                                                                                        <option value="">Choose a
                                                                                            State</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Nationality
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <select class="form-control"
                                                                                        id="country" name="country"
                                                                                        required="">
                                                                                        @if ($data->country_resident == null)
                                                                                            <option value="">Choose
                                                                                                Country</option>
                                                                                        @else
                                                                                            <option
                                                                                                value="{{ $data->country_resident }}"
                                                                                                selected>
                                                                                                {{ $data->country_resident }}
                                                                                            </option>
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">State
                                                                                    of Origin
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <select class="form-control state"
                                                                                        id="state_origin"
                                                                                        name="state_origin"
                                                                                        required="">
                                                                                        <option value="">Choose a
                                                                                            State</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">LGA
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <select class="form-control"
                                                                                        id="lga_origin" name="lga_origin"
                                                                                        required="">
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Religion
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <select class="form-control"
                                                                                        id="religion" name="religion"
                                                                                        required="">
                                                                                        <option value="">Choose
                                                                                            Religion</option>
                                                                                        <option value="Christianity">
                                                                                            Christianity</option>
                                                                                        <option value="Islamic"> Islamic
                                                                                        </option>
                                                                                        <option value="Other"> Other
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-6 form-horizontal">
                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Marital
                                                                                    Status
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <div class="d-flex flex-column">
                                                                                        <div
                                                                                            class="radio-custom radio-primary">
                                                                                            <input type="radio"
                                                                                                id="single"
                                                                                                name="marital"
                                                                                                value="single" checked>
                                                                                            <label
                                                                                                for="single">Single</label>
                                                                                        </div>

                                                                                        <div
                                                                                            class="radio-custom radio-primary">
                                                                                            <input type="radio"
                                                                                                id="married"
                                                                                                name="marital"
                                                                                                value="married">
                                                                                            <label
                                                                                                for="married">Married</label>
                                                                                        </div>

                                                                                        <div
                                                                                            class="radio-custom radio-primary">
                                                                                            <input type="radio"
                                                                                                id="widowed"
                                                                                                name="marital"
                                                                                                value="widowed">
                                                                                            <label
                                                                                                for="widowed">Widowed</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Physical
                                                                                    Disability?</label>
                                                                                <div class="col-xl-12 col-md-9">
                                                                                    <div class="d-flex flex-column">
                                                                                        <div
                                                                                            class="checkbox-custom checkbox-primary">
                                                                                            <input type="checkbox"
                                                                                                id="disability_check"
                                                                                                name="disability_check"
                                                                                                value="yes">
                                                                                            <label
                                                                                                for="disability_check">Yes</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                class="form-group row form-material disability">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">State
                                                                                    your disability</label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="disability" name="disability">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Name
                                                                                    of Next of Kin
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="next_of_kin"
                                                                                        name="next_of_kin" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Phone
                                                                                    number of Next of Kin
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="tel"
                                                                                        class="form-control"
                                                                                        id="nok_phone" name="nok_phone"
                                                                                        required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Relationship
                                                                                    with Next of Kin
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <select class="form-control"
                                                                                        name="nok_relationship"
                                                                                        id="nok_relationship" required>
                                                                                        <option value="Father">Father
                                                                                        </option>
                                                                                        <option value="Mother">Mother
                                                                                        </option>
                                                                                        <option value="Spouse">Spouse
                                                                                        </option>
                                                                                        <option value="Sibling">Sibling
                                                                                        </option>
                                                                                        <option value="Others">Others
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Address
                                                                                    of Next of Kin
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="next_of_kin_address"
                                                                                        name="next_of_kin_address"
                                                                                        required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Name
                                                                                    of Sponsor
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="sponsor_name"
                                                                                        name="sponsor_name" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Email
                                                                                    address of Sponsor
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="email"
                                                                                        class="form-control"
                                                                                        id="sponsor_email"
                                                                                        name="sponsor_email" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Phone
                                                                                    number of Sponsor
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class=" col-xl-12 col-md-9">
                                                                                    <input type="tel"
                                                                                        class="form-control"
                                                                                        id="sponsor_phone"
                                                                                        name="sponsor_phone" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="form-group form-material col-xl-12 text-right padding-top-m">
                                                                            <button type="submit" class="btn btn-primary"
                                                                                id="btn_basic">Next</button>
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
                                                    <a class="panel-title" aria-controls="answer-5" aria-expanded="true"
                                                        data-toggle="collapse" href="#answer-5" data-parent="#accordion">
                                                        Academic Information
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-5"
                                                    aria-labelledby="question-5" role="tabpanel">
                                                    <div class="panel-body">
                                                        <!-- Panel Full Example -->
                                                        <div class="panel">
                                                            <div class="panel-body">
                                                                <form method="post" id="form_academic"
                                                                    autocomplete="off">
                                                                    @csrf

                                                                    <div class="row row-lg">
                                                                        <div class="col-xl-12 form-horizontal">
                                                                            <div class="form-group row form-material">
                                                                                <button id="addSchool" type="button"
                                                                                    class="btn btn-sm btn-dark">
                                                                                    <i class="icon md-plus text"
                                                                                        aria-hidden="true"></i>
                                                                                    <span class="text">Add</span>
                                                                                </button>
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Secondary
                                                                                    school(s) attended with dates
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="example col-xl-6 col-md-6">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="sec_school[]"
                                                                                        placeholder="Enter school name"
                                                                                        required>
                                                                                    <input type="hidden"
                                                                                        class="form-control"
                                                                                        value="academic" id="check_step"
                                                                                        name="check_step">
                                                                                </div>
                                                                                <div class="example col-xl-6 col-md-3 row">
                                                                                    <div class="input-daterange"
                                                                                        data-plugin="datepicker">
                                                                                        <div class="input-group">
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="school_start[]"
                                                                                                required />
                                                                                            <span
                                                                                                class="input-group-addon">to</span>
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="school_end[]"
                                                                                                required />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="newSchool"></div>

                                                                            <div class="form-group row form-material">
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Examinations
                                                                                    taken
                                                                                    <span class="required"
                                                                                        style="color:red">*</span>
                                                                                </label>
                                                                                <div class="example col-xl-12 col-md-3">
                                                                                    <table
                                                                                        class="editable-table table table-striped"
                                                                                        id="editableTable">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Exam</th>
                                                                                                <th>Subject</th>
                                                                                                <th>Grade</th>
                                                                                                <th>Year</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @for ($i = 1; $i < 10; $i++)
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            name="exam[]"
                                                                                                            required>
                                                                                                            <option
                                                                                                                value="">
                                                                                                                Select Exam
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="WAEC">
                                                                                                                WAEC
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="NECO">
                                                                                                                NECO
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="GCE">
                                                                                                                GCE</option>
                                                                                                            <option
                                                                                                                value="NABTEB">
                                                                                                                NABTEB
                                                                                                            </option>
                                                                                                        </select>
                                                                                                    </td>
                                                                                                    <td><select
                                                                                                            class="form-control"
                                                                                                            name="subject[]"
                                                                                                            required>
                                                                                                            <option
                                                                                                                value="">
                                                                                                                Choose
                                                                                                                Subject
                                                                                                            </option>
                                                                                                            @foreach ($o_level as $sub)
                                                                                                                <option
                                                                                                                    value="{{ $sub->subject }}">
                                                                                                                    {{ $sub->subject }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            name="grade[]"
                                                                                                            required>
                                                                                                            <option
                                                                                                                value="">
                                                                                                                Choose Grade
                                                                                                            </option>
                                                                                                            @foreach ($sub_grade as $grade)
                                                                                                                <option
                                                                                                                    value="{{ $grade }}">
                                                                                                                    {{ $grade }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        @php
                                                                                                            $currentYear = date(
                                                                                                                'Y',
                                                                                                            );
                                                                                                            $endYear = 1960;
                                                                                                            $yearArray = range(
                                                                                                                $currentYear,
                                                                                                                $endYear,
                                                                                                            );
                                                                                                        @endphp
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            name="year[]"
                                                                                                            id="year"
                                                                                                            required>
                                                                                                            <option
                                                                                                                value="">
                                                                                                                Choose Year
                                                                                                            </option>
                                                                                                            @foreach ($yearArray as $year)
                                                                                                                <option
                                                                                                                    value="{{ $year }}">
                                                                                                                    {{ $year }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endfor
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row form-material">
                                                                                <button id="addQualification"
                                                                                    type="button"
                                                                                    class="btn btn-sm btn-dark">
                                                                                    <i class="icon md-plus text"
                                                                                        aria-hidden="true"></i>
                                                                                    <span class="text">Add</span>
                                                                                </button>
                                                                                <label
                                                                                    class="col-xl-12 col-md-3 form-control-label">Other
                                                                                    Qualifications</label>
                                                                                <div class="example col-xl-3 col-md-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="institution_name[]"
                                                                                        placeholder="Name of institution">
                                                                                </div>
                                                                                <div class="example col-xl-2 col-md-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="institution_address[]"
                                                                                        placeholder="Address">
                                                                                </div>
                                                                                <div class="example col-xl-2 col-md-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="degree[]"
                                                                                        placeholder="Grade/Degree">
                                                                                </div>
                                                                                <div class="example col-xl-5 col-md-3 row">
                                                                                    <div class="input-group">
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            name="inst_start[]" />
                                                                                        <span
                                                                                            class="input-group-addon">to</span>
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            name="inst_end[]" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="newQulalification"></div>

                                                                        </div>
                                                                        <div
                                                                            class="form-group form-material col-xl-12 text-right padding-top-m">
                                                                            <button type="submit" class="btn btn-primary"
                                                                                id="btn_academic">Next</button>
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
                                                    <a class="panel-title" aria-controls="answer-8" aria-expanded="true"
                                                        data-toggle="collapse" href="#answer-8"
                                                        data-parent="#accordion1">
                                                        Declaration and File Upload
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-8"
                                                    aria-labelledby="question-8" role="tabpanel">
                                                    <div class="panel-body">
                                                        <!-- Panel Full Example -->
                                                        <form method="post" action="{{ route('save.app.form') }}"
                                                            id="form_declaration" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-xl-12 form-horizontal">
                                                                <div class="form-group row form-material">
                                                                    <label
                                                                        class="col-xl-12 col-md-3 form-control-label">(First
                                                                        Choice) Information on Programme of Study
                                                                        <span class="required" style="color:red">*</span>
                                                                    </label>
                                                                    <div class="example col-xl-3 col-md-3">
                                                                        <input type="hidden" class="form-control"
                                                                            value="declaration" id="check_step"
                                                                            name="check_step">
                                                                        <input type="hidden" value="{{ $pin }}"
                                                                            id="pin" class="form-control">
                                                                        <input type="hidden" value="{{ $form_status }}"
                                                                            id="form_status" class="form-control">
                                                                        <select class="form-control" required
                                                                            name="faculty" id="faculty">
                                                                            <option value="">Select Faculty</option>
                                                                            @foreach ($faculties as $faculty)
                                                                                <option
                                                                                    value="{{ $faculty->college_id }}">
                                                                                    {{ $faculty->college }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="example col-xl-3 col-md-3 ">
                                                                        <select class="form-control" required
                                                                            name="department" id="department">
                                                                            <option value="">Select Department
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="example col-xl-3 col-md-3">
                                                                        <select class="form-control" required
                                                                            name="programme" id="programme">
                                                                            <option value="">Select Programme
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    @if ($_COOKIE['app_type'] == 'foundation')
                                                                        <div class="example col-xl-3 col-md-3">
                                                                            <select class="form-control" required
                                                                                name="combination" id="combination">
                                                                                <option value="">Select JUPEB
                                                                                    Combination</option>
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="col-xl-12 form-horizontal">
                                                                    <div class="form-group row form-material">
                                                                        <label
                                                                            class="col-xl-12 col-md-3 form-control-label">(Second
                                                                            choice) Information on Programme of Study
                                                                            <span class="required"
                                                                                style="color:red">*</span>
                                                                        </label>
                                                                        <div class="example col-xl-3 col-md-3">
                                                                            <select class="form-control" required
                                                                                name="faculty2" id="faculty2">
                                                                                <option>Select Faculty</option>
                                                                                @foreach ($faculties as $faculty)
                                                                                    <option
                                                                                        value="{{ $faculty->college_id }}">
                                                                                        {{ $faculty->college }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="example col-xl-3 col-md-3 ">
                                                                            <select class="form-control" required
                                                                                name="department2" id="department2">
                                                                                <option>Select Department</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="example col-xl-3 col-md-3">
                                                                            <select class="form-control" required
                                                                                name="programme2" id="programme2">
                                                                                <option>Select programme</option>
                                                                            </select>
                                                                        </div>
                                                                        @if ($_COOKIE['app_type'] == 'foundation')
                                                                            <div class="example col-xl-3 col-md-3">
                                                                                <select class="form-control" required
                                                                                    name="combination2" id="combination2">
                                                                                    <option>Select JUPEB Combination
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <div class="col-xl-12 form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="example col-xl-6 col-md-3">
                                                                                <label for="signature"
                                                                                    class="form-label">Upload
                                                                                    Signature</label>
                                                                                <input type="file" class="form-control"
                                                                                    id="signature" name="signature"
                                                                                    placeholder="Upload Signature"
                                                                                    accept="image/*" required>
                                                                                <small style="color: red">(png/jpg max
                                                                                    500kb)</small>
                                                                            </div>
                                                                            @php
                                                                                $non_eligible_states = [
                                                                                    30,
                                                                                    31,
                                                                                    28,
                                                                                    29,
                                                                                    25,
                                                                                    13,
                                                                                ];
                                                                            @endphp
                                                                            <div class="example col-xl-6 col-md-3">
                                                                                <label for="screening_date"
                                                                                    class="form-label">Select Screening
                                                                                    Date</label>
                                                                                <select class="form-control"
                                                                                    data-plugin="selectpicker" required
                                                                                    name="screening_date"
                                                                                    id="screening_date"
                                                                                    data-live-search="true"
                                                                                    data-allow-clear="true">
                                                                                    {{-- @if (!in_array($data->state_resident, $non_eligible_states)) --}}
                                                                                    @if ($_COOKIE['app_type'] == 'foundation')
                                                                                        <option value="20/10/2025">
                                                                                            20/10/2025
                                                                                            (Main Campus EDE)
                                                                                        </option>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12 form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="example col-xl-6 col-md-3">
                                                                                <label for="olevel"
                                                                                    class="form-label">Upload
                                                                                    O' Level Result</label>
                                                                                <input type="file" id="olevel"
                                                                                    name="olevel" class="form-control"
                                                                                    accept="image/*" required>
                                                                                <small style="color: red">(png/jpg max
                                                                                    500kb)</small>
                                                                            </div>
                                                                            <div class="example col-xl-6 col-md-3">
                                                                                <label for="birth_cert"
                                                                                    class="form-label">Upload
                                                                                    Birth Certificate</label>
                                                                                <input type="file" id="birth_cert"
                                                                                    name="birth_cert" class="form-control"
                                                                                    accept="image/*" required>
                                                                                <small style="color: red">(png/jpg max
                                                                                    500kb)</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="checkbox-custom checkbox-success">
                                                                        <input type="checkbox" id="accept_terms"
                                                                            name="accept_terms" required />
                                                                        <label for="accept_terms"><small>I declare that I
                                                                                wish to enter the Redeemer's University
                                                                                @if ($_COOKIE['app_type'] == 'foundation')
                                                                                    Foundation
                                                                                @else
                                                                                    Part-Time
                                                                                @endif degree Programme
                                                                                in this current session.
                                                                                The credentials given in this form are
                                                                                correct to the best of my knowledge. If
                                                                                admitted to the University,
                                                                                I shall regard myself bound by the
                                                                                ordinance, code of conduct, statuses and
                                                                                regulations of the University as
                                                                                far as they affect me.
                                                                                I understand that withholding any
                                                                                information requested or giving false
                                                                                information may make me ineligible for
                                                                                admission, registration, matriculation or
                                                                                expulsion from the University.
                                                                                If discovered at any time that I do not
                                                                                possess any of the qualifications which I
                                                                                claim to have obtained, I will
                                                                                be expelled from the University and shall
                                                                                not be re-admitted for the same or any other
                                                                                programme, even if I have
                                                                                upgraded my previous qualifications or
                                                                                possess additional qualifications.
                                                                            </small>
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="form-group form-material col-xl-12 text-right padding-top-m">
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btn_declaration">Submit
                                                                            Application</button>
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
