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

    $("#btn_pass").click(function () {
        $("#update_password_form").validate({
            submitHandler: submitFormPassword,
            errorClass: "invalid",
        });

        function submitFormPassword(e) {
            var formData = $("#update_password_form").serialize();
            var type = "POST";
            var ajaxurl = "/password_reset";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btn_pass").html(
                        '<i class="fa fa-spinner fa-spin"></i> &nbsp; processing'
                    );
                },
                success: function (response) {
                    console.log(response);
                    $("#btn_pass").html("Update Password");
                    toastr["success"](response.msg);
                },
                error: function (response) {
                    console.log(response);
                    $("#btn_pass").html("Update Password");
                    toastr["error"](response.msg);
                },
            });
        }
    });

    $("#btn_profile").click(function () {
        $("#update_profile_form").validate({
            submitHandler: submitFormProfile,
            errorClass: "invalid",
        });

        function submitFormProfile(e) {
            var formData = $("#update_profile_form").serialize();
            var type = "POST";
            var ajaxurl = "update_profile";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btn_profile").html(
                        '<i class="fa fa-spinner fa-spin"></i> &nbsp; processing'
                    );
                    $("#btn_profile").prop("disabled", true);
                },
                success: function (response) {
                    console.log(response);
                    $("#btn_profile").html("Update Profile");
                    toastr["success"](response.message);
                    $("#btn_profile").prop("disabled", false);
                },
                error: function (response) {
                    console.log(response);
                    $("#btn_profile").html("Update Profile");
                    toastr["error"](response.responseJSON.message);
                    $("#btn_profile").prop("disabled", false);
                },
            });
        }
    });
});
