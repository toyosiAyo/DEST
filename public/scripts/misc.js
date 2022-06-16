$(document).ready(function () {
    $(".disability").hide();

    $('input[type="checkbox"]').click(function () {
        if ($("#disability_check").prop("checked") == true) {
            $(".disability").show();
        } else {
            $(".disability").hide();
        }
    });

    // add row
    $("#addSchool").click(function () {
        var html = "";
        html += '<div id="sec_school" class="col-xl-12 form-horizontal">';
        html += '<div class="form-group row form-material">';
        html += '<div class="example col-xl-6 col-md-6">';
        html +=
            '<input type="text" class="form-control" name="sec_school[]" placeholder="Enter school name" required>';
        html += "</div>";
        html += '<div class="example col-xl-6 col-md-3 row">';
        html += '<div class="input-daterange" data-plugin="datepicker">';
        html += '<div class="input-group">';
        html +=
            '<input type="date" class="form-control" name="school_start[]" required />';
        html += '<span class="input-group-addon">to</span>';
        html +=
            '<input type="date" class="form-control" name="school_end[]" required />';
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html +=
            '<button id="removeSchool" type="button" class="btn btn-sm btn-danger text-left">';
        html += '<i class="icon md-minus text-active" aria-hidden="true"></i>';
        html += '<span class="text">Remove</span>';
        html += "</button>";
        html += "</div>";
        html += "</div>";
        $("#newSchool").append(html);
    });

    $("#addQualification").click(function () {
        var html = "";
        html += '<div id="qualification" class="col-xl-12 form-horizontal">';
        html += '<div class="form-group row form-material">';
        html += '<div class="example col-xl-3 col-md-3">';
        html +=
            '<input type="text" class="form-control" name="institution_name[]" placeholder="Name of institution">';
        html += "</div>";
        html += '<div class="example col-xl-2 col-md-3">';
        html +=
            '<input type="text" class="form-control" name="institution_address[]" placeholder="Address">';
        html += "</div>";
        html += '<div class="example col-xl-2 col-md-3">';
        html +=
            '<input type="text" class="form-control" name="degree[]" placeholder="Grade/Degree">';
        html += "</div>";
        html += '<div class="example col-xl-5 col-md-3 row">';
        html += '<div class="input-group">';
        html +=
            '<input type="date" class="form-control" name="inst_start[]" />';
        html += '<span class="input-group-addon">to</span>';
        html += '<input type="date" class="form-control" name="inst_end[]" />';
        html += "</div>";
        html += "</div>";
        html +=
            '<button id="removeQualification" type="button" class="btn btn-sm btn-danger text-left">';
        html += '<i class="icon md-minus text-active" aria-hidden="true"></i>';
        html += '<span class="text">Remove</span>';
        html += "</button>";
        html += "</div>";
        html += "</div>";
        $("#newQulalification").append(html);
    });

    // remove row
    $(document).on("click", "#removeSchool", function () {
        $(this).closest("#sec_school").remove();
    });

    $(document).on("click", "#removeQualification", function () {
        $(this).closest("#qualification").remove();
    });

    $("#faculty").change(function () {
        $.ajax({
            url: "college_dept_prog",
            data: { faculty: this.value },
            type: "get",
            success: function (response) {
                $("#department")
                    .empty()
                    .append("<option>Select Department</option>");
                $("#programme").empty();
                $("#combination").empty();
                response.dept.forEach((element) => {
                    $("#department").append(
                        $("<option>", {
                            value: element.department_id,
                            text: element.department,
                        })
                    );
                });
            },
        });
    });

    $("#department").change(function () {
        $.ajax({
            url: "college_dept_prog",
            data: { department: this.value },
            type: "get",
            success: function (response) {
                $("#programme")
                    .empty()
                    .append("<option>Select Programme</option>");
                $("#combination").empty();
                response.prog.forEach((element) => {
                    $("#programme").append(
                        $("<option>", {
                            value: element.programme_id,
                            text: element.programme,
                        })
                    );
                });
            },
        });
    });

    $("#programme").change(function () {
        $.ajax({
            url: "college_dept_prog",
            data: { programme: this.value },
            type: "get",
            success: function (response) {
                console.log(response);
                $("#combination")
                    .empty()
                    .append("<option>Select JUPEB Combination</option>");
                response.combinations.forEach((element) => {
                    $("#combination").append(
                        $("<option>", {
                            value: element.subjects,
                            text: element.subjects,
                        })
                    );
                });
            },
        });
    });

    $("#faculty2").change(function () {
        $.ajax({
            url: "college_dept_prog",
            data: { faculty: this.value },
            type: "get",
            success: function (response) {
                $("#department2")
                    .empty()
                    .append("<option>Select Department</option>");
                $("#programme2").empty();
                $("#combination2").empty();
                response.dept.forEach((element) => {
                    $("#department2").append(
                        $("<option>", {
                            value: element.department_id,
                            text: element.department,
                        })
                    );
                });
            },
        });
    });

    $("#department2").change(function () {
        $.ajax({
            url: "college_dept_prog",
            data: { department: this.value },
            type: "get",
            success: function (response) {
                $("#programme2")
                    .empty()
                    .append("<option>Select Programme</option>");
                $("#combination2").empty();
                response.prog.forEach((element) => {
                    $("#programme2").append(
                        $("<option>", {
                            value: element.programme_id,
                            text: element.programme,
                        })
                    );
                });
            },
        });
    });

    $("#programme2").change(function () {
        $.ajax({
            url: "college_dept_prog",
            data: { programme: this.value },
            type: "get",
            success: function (response) {
                console.log(response);
                $("#combination2")
                    .empty()
                    .append("<option>Select JUPEB Combination</option>");
                response.combinations.forEach((element) => {
                    $("#combination2").append(
                        $("<option>", {
                            value: element.subjects,
                            text: element.subjects,
                        })
                    );
                });
            },
        });
    });

    var form_stat = $("#form_status").val();
    var sliced = form_stat.slice(1, -1);
    if (sliced == 0) {
        $("#category-1").addClass("active");
        $("#academic_info").prop("disabled", true);
        $("#declaration_info").prop("disabled", true);
    } else if (sliced == 1) {
        $("#category-2").addClass("active");
        $("#basic_info").prop("disabled", true);
        $("#declaration_info").prop("disabled", true);
    } else {
        $("#category-3").addClass("active");
        $("#basic_info").prop("disabled", true);
        $("#academic_info").prop("disabled", true);
    }

    const getCountryLists = () => {
        $.ajax({
            url: "/get_country",
            method: "GET",
            success: function (response) {
                $.each(response, function (i, item) {
                    $("#country").append(
                        $("<option>", {
                            value: item.name,
                            text: item.name,
                        })
                    );
                });
            },
        });
    };

    const getStates = () => {
        $.ajax({
            url: "/get_state",
            method: "GET",
            success: function (response) {
                $.each(response, function (i, item) {
                    $("#state_origin").append(
                        $("<option>", {
                            value: item.id,
                            text: item.name,
                        })
                    );
                });
            },
        });
    };

    $("#state_origin").change(function () {
        $.ajax({
            url: "get_lga_via_state",
            data: { state_origin: this.value },
            type: "get",
            success: function (response) {
                $("#lga_origin").empty().append("<option>Choose LGA</option>");
                response.forEach((element) => {
                    $("#lga_origin").append(
                        $("<option>", {
                            value: element.name,
                            text: element.name,
                        })
                    );
                });
            },
        });
    });

    getCountryLists();
    getStates();
});
