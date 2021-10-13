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
        html += '<input type="date" class="form-control" name="school_start[]" required />';
        html += '<span class="input-group-addon">to</span>';
        html += '<input type="date" class="form-control" name="school_end[]" required />';
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

    $("#addQualification").click(function () {              
        var html = '';
        html += '<div id="qualification" class="col-xl-12 form-horizontal">';
        html += '<div class="form-group row form-material">';
        html += '<div class="example col-xl-3 col-md-3">';                         
        html += '<input type="text" class="form-control" name="institution_name[]" placeholder="Name of institution">';
        html += '</div>';
        html += '<div class="example col-xl-2 col-md-3">';
        html += '<input type="text" class="form-control" name="institution_address[]" placeholder="Address">';
        html += '</div>';
        html += '<div class="example col-xl-2 col-md-3">';
        html += '<input type="text" class="form-control" name="degree[]" placeholder="Grade/Degree">';
        html += '</div>';
        html += '<div class="example col-xl-5 col-md-3 row">';
        html += '<div class="input-group">';
        html += '<input type="date" class="form-control" name="inst_start[]" />';
        html += '<span class="input-group-addon">to</span>';
        html += '<input type="date" class="form-control" name="inst_end[]" />';
        html += '</div>';
        html += '</div>';
        html += '<button id="removeQualification" type="button" class="btn btn-sm btn-danger text-left">';
        html += '<i class="icon md-minus text-active" aria-hidden="true"></i>';
        html += '<span class="text">Remove</span>';
        html += '</button>';
        html += '</div>';
        html += '</div>';
        $('#newQulalification').append(html);
    });   
                                                                                                        
    // remove row
    $(document).on('click', '#removeSchool', function () {
    $(this).closest('#sec_school').remove();
    });
    
    $(document).on('click', '#removeQualification', function () {
    $(this).closest('#qualification').remove();
    });
})