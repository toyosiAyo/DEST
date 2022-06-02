$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    const getRemitaConfig = (callback) => {
        $.ajax({
            url: `get_remita_config?email=${email}&payType=${payType}`,
            type: "GET",
            success: callback,
        });
    };

    const makePayment = () => {
        var paymentEngine = RmPaymentEngine.init({
            key: "QzAwMDAxNTY4NzN8OTU3M3w1OWUwZmVmMmUxYWYwZTlhMjk3MTU5MzIwNzcxNjc1NWYwYmI5ZWNkZWYyYzcwYWZiZGIwOGZkYmViYzhiYjI3MTkyYzA3MGRhOWZkZDgxNDhlMjdjNmVkMGI0ZjgwYjQ4ZDM1OTkwMzhmNzU4OTJmN2NjMTUxMTljZDY1NjA1NQ==",
            customerId: email,
            firstName: firstname,
            lastName: surname,
            email: email,
            narration: "Application Payment",
            amount: amount,
            processRrr: true,
            extendedData: {
                customFields: [
                    {
                        name: "rrr",
                        value: rrr,
                    },
                ],
            },
            onSuccess: function (response) {
                console.log(response);
                console.log(response.amount);
                if (
                    response.amount !== "" &&
                    response.transactionId !== "" &&
                    response.paymentReference !== ""
                ) {
                    $.ajax({
                        type: "POST",
                        url: `update_applicant_payment?paymentReference=${response.paymentReference}&desc=${payType}&transactionId=${response.transactionId}&amount=${response.amount}&email=${email}`,
                        beforeSend: function () {
                            $("#btn_foundation").html(
                                '<i class="fa fa-spinner fa-spin"></i> Logging Payment...'
                            );
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.status == "ok") {
                                toastr.options;
                                toastr["success"]("Transaction Successful");
                                $("#btn_foundation").html("Create Application");
                                window.location.href = "app_form";
                            } else {
                                toastr.options;
                                toastr["error"]("Payment Logging Failed");
                                $("#btn_foundation").html("Create Application");
                            }
                        },
                        error: function (response) {
                            $("#btn_foundation").html("Create Application");
                            toastr.options;
                            toastr["error"](response.responseJSON.msg);
                        },
                    });
                } else {
                    $("#btn_foundation").html("Create Application");
                    toastr.options;
                    toastr["error"]("Transaction Failed");
                }
            },

            onError: function (response) {
                console.log(response);
                toastr.options;
                toastr["error"]("Network error, Try again later!");
                $("#btn_foundation").html("Create Application");
            },

            onClose: function () {
                $("#btn_foundation").html("Create Application");
            },
        });

        paymentEngine.showPaymentWidget();
    };

    const processPayment = () => {
        toHash = merchantId + serviceTypeId + orderId + amount + apiKey;
        apiHash = sha512(toHash);
        settings = {
            url: "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit",
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/json",
                Authorization:
                    "remitaConsumerKey=" +
                    merchantId +
                    ",remitaConsumerToken=" +
                    apiHash,
            },
            data: JSON.stringify({
                serviceTypeId: serviceTypeId,
                amount: amount,
                orderId: orderId,
                payerName: fullname,
                payerEmail: email,
                payerPhone: phone,
                description: desc,
            }),
        };
        console.log(settings);

        $.ajax({
            type: "GET",
            url: `check_pend_rrr?email=${email}&payType=${payType}`,
            beforeSend: function () {
                $("#btn_foundation").html(
                    '<i class="fa fa-spinner fa-spin"></i> Processing...'
                );
            },
            success: function (response) {
                console.log(response.status);
                if (response.status == "ok") {
                    rrr = response.p_rrr;
                    console.log(rrr);
                    $("#btn_foundation").html(
                        '<i class="fa fa-spinner fa-spin"></i> Processing Payment...'
                    );
                    makePayment();
                } else if (response.status == "Nok") {
                    $.ajax(settings).done(function (res) {
                        var obj = res.substring(7, res.length - 1);
                        var objJson = JSON.parse(obj);
                        rrr = objJson.RRR;
                        console.log(rrr);
                        $.ajax({
                            type: "POST",
                            url: `log_new_rrr?email=${email}&rrr=${rrr}&amount=${amount}&payerName=${fullname}&payType=${payType}&statuscode=${objJson.statuscode}&statusMsg=${objJson.status}&orderID=${orderId}`,
                            beforeSend: function () {
                                $("#btn_foundation").html(
                                    '<i class="fa fa-spinner fa-spin"></i> Logging RRR...'
                                );
                            },
                            success: function (response) {
                                console.log(response);
                                if (response.status == "ok") {
                                    alert("Proceed to Pay");
                                    $("#btn_foundation").html(
                                        '<i class="fa fa-spinner fa-spin"></i> Processing Payment...'
                                    );
                                    makePayment();
                                } else {
                                    $("#btn_foundation").html(
                                        "Create Application"
                                    );
                                    toastr.options;
                                    toastr["error"](response.msg);
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                $("#btn_foundation").html("Create Application");
                                toastr.options;
                                toastr["error"](response.responseJSON.msg);
                            },
                        });
                    });
                } else {
                    $("#btn_foundation").html("Create Application");
                    toastr.options;
                    toastr["error"]("Network Error!, Try again later");
                }
            },
            error: function (response) {
                console.log(response);
                $("#btn_foundation").html("Create Application");
                toastr.options;
                toastr["error"](response.responseJSON.msg);
            },
        });
    };

    $(".pay").click(function (e) {
        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
        payType = $(this).data("paytype");
        console.log(payType);
        desc = "Application Payment";
        email = $(this).data("email");
        amount = $(this).data("amount");

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

        getRemitaConfig(function (response) {
            if (response.msg === "No pin") {
                $(".pay").html("Create Application");
                $("#modal_teller").modal("show");
                $("#form_teller").trigger("reset");
                $("#show_amount").html(amount);
                $("#email").val($("#email").val() + email);
                $("#payType").val($("#payType").val() + payType);
                // merchantId = response.merchantId;
                // serviceTypeId = response.serviceTypeID;
                // apiKey = response.apiKey;
                // orderId = response.orderID;
                // phone = response.data[0].phone;
                // firstname = response.data[0].first_name;
                // surname = response.data[0].surname;
                // fullname = firstname + ' ' + surname;
                // setTimeout(function() {
                //     processPayment();
                // }, 5000);
            } else if (response.msg === "success") {
                var pin = response.rsp;
                $.cookie("pin", pin);
                $.cookie("app_type", payType);
                window.location.href = "app_form";
            } else if (response.msg === "pending") {
                $("#modal_teller").modal("show");
                var pin = response.rsp;
                $(".pay").html("Create Application");
                toastr["error"](
                    `Payment with teller number ${pin} is still pending approval`
                );
            } else {
                $(".pay").html("Create Application");
                toastr["error"](response.msg);
                return false;
            }
        });
    });

    $("#form_teller").on("submit", function (e) {
        e.preventDefault();
        var formData = $("#form_teller").serialize();
        $.ajax({
            type: "POST",
            url: "log_new_teller",
            data: formData,
            dataType: "json",
            beforeSend: function () {
                $("#btnSendteller").html(
                    '<i class="fa fa-spinner fa-spin"></i>'
                );
            },
            success: function (response) {
                $("#btnSendteller").html("Send");
                $("#modal_teller").modal("hide");
                toastr["success"](response.msg);
                console.log(response);
            },
            error: function (response) {
                console.log(response);
                $("#btnSendteller").html("Send");
                toastr.options;
                toastr["error"](response.responseJSON.msg);
            },
        });
    });
});
