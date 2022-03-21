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

    $("#btnCurr").click(function () {
        alert("hey");
        $("#formCurr").validate({
            submitHandler: submitEventForm,
            errorClass: "invalid",
        });

        function submitEventForm(e) {
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
                    // setTimeout(function () {
                    //     window.location.href = "/events";
                    // }, 2800);
                },
                error: function (response) {
                    console.log(response);
                    $("#btnCurr").html("Create");
                    toastr["error"](response.responseJSON.message);
                },
            });
        }
    });
});
