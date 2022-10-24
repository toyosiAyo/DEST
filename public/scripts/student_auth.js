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

    $("#btnStudentLogin").click(function () {
        $("#studentLoginForm").validate({
            submitHandler: submitLoginAccessForm,
        });

        function submitLoginAccessForm(e) {
            var formData = $("#studentLoginForm").serialize();
            var type = "POST";
            var ajaxurl = "student_login_access";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btnStudentLogin").html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                },
                success: function (response) {
                    console.log(response);
                    toastr["success"](response.message);
                    setTimeout(function () {
                        window.location.href = "/dashboard";
                    }, 2800);
                },
                error: function (response) {
                    console.log(response);
                    $("#btnStudentLogin").html("Login");
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });
});
