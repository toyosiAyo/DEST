$(document).ready(function ($) {
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

    $("#app_table").on("click", ".view", function () {
        $("#view_app").modal("show");
        var status = $(this).data("status");
        var appID = $(this).data("id");
        $("#details").html(status + appID);
        var encoded_link = window.btoa(appID);
        var _href = $("a.download_letter").attr("href");
        var link = `adms_letter?app_id=${encoded_link}`;
        $("a.download_letter").attr("href", _href + link);

        $("a").attr("href", `adms_letter?app_id=${encoded_link}`);
    });

    $("#courseRegForm").on("submit", function (e) {
        e.preventDefault();
        var formData = $("#courseRegForm").serialize();
        $.ajax({
            type: "POST",
            url: "submit_registration",
            data: formData,
            dataType: "json",
            beforeSend: function () {
                $("#btnSubmitRegForm").html(
                    '<i class="fa fa-spinner fa-spin"></i>'
                );
            },
            success: function (response) {
                $("#btnSubmitRegForm").html("Submit");
                toastr["success"](response.message);
                console.log(response);
            },
            error: function (response) {
                console.log(response);
                $("#btnSubmitRegForm").html("Submit");
                toastr["error"](response.responseJSON.message);
            },
        });
    });
});
