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

    $("#login-submit").click(function () {
        $("#login-form").validate({
            submitHandler: submitLoginForm,
            errorClass: "invalid",
        });

        function submitLoginForm(e) {
            var formData = $("#login-form").serialize();
            var type = "POST";
            var ajaxurl = "admin_login_auth";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#login-submit").html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                },
                success: function (response) {
                    console.log(response);
                    $("#login-submit").html("Login");
                    toastr.options;
                    toastr["success"](response.message);
                    setTimeout(function () {
                        window.location.href = "admin/dashboard";
                    }, 2800);
                },
                error: function (response) {
                    console.log(response);
                    $("#login-submit").html("Login");
                    toastr.options;
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });
});
