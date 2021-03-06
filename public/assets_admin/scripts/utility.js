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
                    toastr.options;
                    toastr["success"](response.message);
                    setTimeout(function () {
                        window.location.href = "/events";
                    }, 2800);
                },
                error: function (response) {
                    console.log(response);
                    $("#btnEventForm").html("Create");
                    toastr.options;
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
});
