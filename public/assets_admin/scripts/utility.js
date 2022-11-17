$(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

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
                toastr["error"](response.responseJSON.message);
            },
        });
    };

    const viewRegCourses = (id, name) => {
        $.ajax({
            type: "GET",
            url: "viewRegCourses",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#exampleModal").modal("show");
                $("#studentLabel").html(name);
                $("#bodylist").empty();
                response.forEach((element) => {
                    $("#courselist").append(
                        `<tr><td>${element.course_title}</td><td>${element.course_code}</td><td>${element.course_unit}</td></tr>`
                    );
                });
            },
            error: function (response) {
                console.log(response);
            },
        });
    };
});
