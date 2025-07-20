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
    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

    $("#app_table").on("click", ".view", function () {
        $("#view_app").modal("show");
        var status = $(this).data("status");
        var appID = $(this).data("id");
        $("#details").html(`You have been Admitted!`);
        var encoded_link = window.btoa(appID);
        var _href = $("a.download_letter").attr("href");
        var link = `adms_letter?app_id=${encoded_link}`;
        $("a.download_letter").attr("href", _href + link);

        $("a").attr("href", `adms_letter?app_id=${encoded_link}`);
    });

    $("#app_table").on("click", ".view_schedule", function () {
        var degree = $(this).data("app_type");
        var app_id = $(this).data("app_id");
        var type = "admission";
        $.ajax({
            url: "get-payment-schedule",
            method: "GET",
            data: { app_type: degree, type: type, app_id: app_id },
            dataType: "json",
            success: function (response) {
                let rows = "";
                response.payload.forEach(function (item) {
                    rows += `
            <tr>
              <td><input type="checkbox" checked disabled></td>
              <td>${item.item}</td>
              <td>${item.amount}</td>
            </tr>
          `;
                });
                $("#paymentBody").html(rows);
                if (response.payment_status == "success") {
                    $("#btn_proceed_to_payment").html("PAID");
                    $("#btn_proceed_to_payment").prop("disabled", true);
                } else {
                    $("#btn_proceed_to_payment").html(
                        `Proceed to Payment (₦ ${response.total})`
                    );
                }

                $("#payment_modal").modal("show");
            },
            error: function (response) {
                toastr["error"](response.responseJSON.message);
                console.log(xhr.responseText);
            },
        });
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
