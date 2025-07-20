$(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "5000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    $("#btnCurr").click(function (e) {
        e.preventDefault();
        $("#formCurr").validate({
            submitHandler: submitCurrForm,
        });

        function submitCurrForm() {
            var formData = $("#formCurr").serialize();
            var type = "POST";
            var ajaxurl = "/create_curriculum";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btnCurr").html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    console.log(response);
                    $("#btnCurr").html("Create");
                    toastr["success"](response.message);
                },
                error: function (response) {
                    console.log(response);
                    $("#btnCurr").html("Submit");
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });

    $("#btnEventForm").click(function () {
        $("#eventForm").validate({
            submitHandler: submitEventForm,
            errorClass: "invalid",
        });

        function submitEventForm(e) {
            var formData = $("#eventForm").serialize();
            var type = "POST";
            var ajaxurl = "/create_event";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btnEventForm").html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                },
                success: function (response) {
                    console.log(response);
                    $("#btnEventForm").html("Create");
                    toastr["success"](response.message);
                    setTimeout(function () {
                        window.location.href = "/events";
                    }, 2800);
                },
                error: function (response) {
                    console.log(response);
                    $("#btnEventForm").html("Create");
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });

    $(".approve").click(function () {
        var id = $(this).data("id");
        var rrr = $(this).data("rrr");
        var email = $(this).data("email");
        var pay_type = $(this).data("pay_type");
        approvePayment(id, rrr, email, pay_type);
    });
    
    $(".students").on("click", ".reset", function () {
        var id = $(this).data("student_id");
        var firstname = $(this).data("firstname")
        adminResetPassword(id, firstname);
    });

    $("#tblapplications").on("click", ".downloadApp", function () {
        var id = $(this).data("app_id");
        var action = $(this).data("action");
        var email = $(this).data("email");
        var duration = "";
        var resumption = "";
        var closing = "";
        var degree = "";
        var session = "";
        handleApplication(
            id,
            action,
            email,
            duration,
            resumption,
            degree,
            session,
            closing
        );
    });

    $("#tblapplications").on("click", ".approveApp", function () {
        $("#approveApplication").modal("show");
        var id = $(this).data("app_id");
        var action = $(this).data("action");
        var email = $(this).data("email");
        $("#btn_approve").click(function (e) {
            e.preventDefault();
            $("#btn_approve").html('<i class="fa fa-spinner fa-spin"></i>');
            var duration = $("#duration").val();
            var resumption = $("#resumption").val();
            var closing = $("#registration_closing").val();
            var degree = $("#degree").val();
            var session = $("#session").val();
            if (duration === "") return false;
            handleApplication(
                id,
                action,
                email,
                duration,
                resumption,
                degree,
                session,
                closing
            );
        });
    });

    const approvePayment = (id, rrr, email, pay_type) => {
        $.ajax({
            type: "POST",
            url: "/approve_payments",
            data: { pay_id: id, email: email, rrr: rrr, pay_type: pay_type },
            dataType: "json",
            beforeSend: function () {
                if (confirm("Approve Payment?") == false) return false;
                $.blockUI();
            },
            success: function (response) {
                console.log(response);
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2800);
            },
            error: function (response) {
                $.unblockUI();
                toastr["error"](response.responseJSON.message);
            },
        });
    };
    
    const adminResetPassword = (id, firstname) => {
        $.ajax({
            type: "POST",
            url: "/admin-reset-password",
            data: { id: id },
            dataType: "json",
            beforeSend: function () {
                if (confirm(`Reset ${firstname}'s password to 123456?`) == false) return false;
                $.blockUI();
            },
            success: function (response) {
                console.log(response);
                $.unblockUI();
                toastr["success"](response.message);
            },
            error: function (response) {
                $.unblockUI();
                toastr["error"](response.responseJSON.message);
            },
        });
        
    }

    $(".viewForgotMatric").click(function () {
        $("#forgotMatric").modal("show");
        $("#sendMatricForm").trigger("reset");
        $("#matric_number")
            .empty()
            .append("<option value=''>Select Matric Number</option>");
        email = $(this).data("email");
        suggestions = $(this).data("suggestions");
        $("#name").html(
            $(this).data("surname") +
                " " +
                $(this).data("firstname") +
                " " +
                $(this).data("othername")
        );
        $("#email").html($(this).data("email"));
        $("#phone").html($(this).data("phone"));
        $("#program").html($(this).data("program"));
        $("#graduation").html($(this).data("date_left"));
    });

    $("#tblStudent").on("click", ".viewStudent", function () {
        var id = $(this).data("id");
        var name = $(this).data("name");
        $.cookie("student_id", id);
        viewRegCourses(id, name);
    });

    const handleApplication = (
        id,
        action,
        email,
        duration,
        resumption,
        degree,
        session,
        closing
    ) => {
        $.ajax({
            type: "POST",
            url: "/app_actions",
            data: {
                email: email,
                action: action,
                app_id: id,
                duration: duration,
                resumption_date: resumption,
                degree: degree,
                session: session,
                registration_closing: closing,
            },
            dataType: "json",
            beforeSend: function () {
                if (confirm(`${action} application?`) == false) return false;
                $.blockUI();
            },
            success: function (response) {
                console.log(response);
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2800);
            },
            error: function (response) {
                $.unblockUI();
                $("#btn_approve").html("Submit");
                toastr["error"](response.responseJSON.message);
            },
        });
    };

    const viewRegCourses = (id, name) => {
        $.ajax({
            type: "GET",
            url: `/viewRegCourses`,
            data: { id: id },
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#exampleModal").modal("show");
                $("#studentLabel").html(name);
                $("#bodylist").empty();
                response.forEach((element) => {
                    $("#courselist").append(
                        `<tr><td>${element.course_title}</td><td>${element.course_code}</td><td>${element.unit}</td></tr>`
                    );
                });
            },
            error: function (response) {
                console.log(response);
            },
        });
    };

    $("#btnLecturerForm").click(function () {
        $("#lecturerForm").validate({
            submitHandler: submitlecturerForm,
            errorClass: "invalid",
        });

        function submitlecturerForm(e) {
            var formData = $("#lecturerForm").serialize();
            var type = "POST";
            var ajaxurl = "/create_lecturer";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btnLecturerForm").html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                },
                success: function (response) {
                    console.log(response);
                    $("#btnLecturerForm").html("Create");
                    toastr["success"](response.message);
                    setTimeout(function () {
                        window.location.href = "lecturers";
                    }, 2800);
                },
                error: function (response) {
                    console.log(response);
                    $("#btnLecturerForm").html("Create");
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });
    
    $(".score").on("input", function (e) {
        var keyCode = e.which;
        if (keyCode < 48 || keyCode > 57) {
            e.preventDefault();
        }
        var value = $(this).val();
        
        if (value.includes('.') || value.startsWith('0')) {
            alert('Invalid Input')
            $(this).val(0);
        }
    });

    $("#inputScoreForm").on("submit", function (e) {
        var table = $("#tblScoreInput").DataTable();
        var form = this;
        var params = table.$("input").serializeArray();
        e.preventDefault();

        $.each(params, function () {
            if (!$.contains(document, form[this.name])) {
                $(form).append(
                    $("<input>")
                        .attr("type", "hidden")
                        .attr("name", this.name)
                        .val(this.value)
                );
            }
        });
        //$("#example-console-form").text($(form).serialize());
        console.log(form);
        var mydata = $(form).serialize();
        console.log(mydata);
        var type = "POST";
        var ajaxurl = "/enter_score";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: mydata,
            dataType: "json",
            beforeSend: function () {
                $("#btnScoreInput").html(
                    '<i class="fa fa-spinner fa-spin"></i>'
                );
                $("#btnScoreInput").prop("disabled", true);
            },
            success: function (response) {
                console.log(response);
                alert(response.message);
                $("#btnScoreInput").html("Submit");
                $("#btnScoreInput").prop("disabled", false);
                location.reload();
            },
            error: function (response) {
                console.log(response);
                $("#btnScoreInput").html("Submit");
                $("#btnScoreInput").prop("disabled", false);
                alert(response.responseJSON.message);
            },
        });
    });

    $(".scoreTable").on("focusout", ".score", function () {
        if ($(this).val() > 100) {
            alert("No scores above 100");
            $(this).val("100");
        }
        const id = $(this).data("id");
        const score = $(this).val();
        const grade = getGrade(score);
        //const tr = $(this).closest("tr");
        //const current_row = tr.index() + 1;
        $("#" + id).val(grade);
    });

    const getGrade = (score) => {
        if (score >= 70) {
            return "A";
        } else if (score < 70 && score > 59) {
            return "B";
        } else if (score < 60 && score > 49) {
            return "C";
        } else if (score < 50 && score > 44) {
            return "D";
        } else if (score < 45 && score > 39) {
            return "E";
        } else {
            return "F";
        }
    };

    $("#btn_result").click(function () {
        $("#form_resullt").validate({
            submitHandler: submitformresullt,
            errorClass: "invalid",
        });

        function submitformresullt(e) {
            var formData = $("#form_resullt").serialize();
            var type = "POST";
            var ajaxurl = "/view_result";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btn_result").html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                },
                success: function (response) {
                    console.log(response);
                    $("#btn_result").html(
                        "<i data-feather='printer'></i> Download"
                    );
                    toastr["success"](response.message);
                    $("#viewResultModal").modal("show");
                    $(".result_html").html(response.html);
                },
                error: function (response) {
                    console.log(response);
                    $("#btn_result").html(
                        "<i data-feather='printer'></i> Download"
                    );
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });

    $("#print_result").click(function () {
        $(".page").printThis({
            debug: false,
            importCSS: true,
            importStyle: true,
            printContainer: true,
            loadCSS: "../css/run_style3.css",
            pageTitle: "DEST Result",
            removeInline: false,
            printDelay: 333,
            header: null,
            formValues: true,
        });
    });
});
