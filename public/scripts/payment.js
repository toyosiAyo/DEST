$(document).ready(function () {
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
    
    $(".pay").click(function (e) {
        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
        var payType = $(this).data("paytype");
        var email = $(this).data("email");
        var amount = $(this).data("amount");
        var surname = $(this).data("surname");
        var first_name = $(this).data("firstname");
        
        $.ajax({
            type: "POST",
            url: "init-application-payment",
            data: {payType:payType,email:email,surname:surname,first_name:first_name,amount:amount},
            dataType: "json",
            success: function (response) {
                $(".pay").html("Create Application");
                toastr["success"](response.message);
                window.location.href = response.url;
                console.log(response);
            },
            error: function (response) {
                console.log(response);
                $(".pay").html("Create Application");
                toastr.options;
                toastr["error"](response.responseJSON.message);
            },
        });
    })
    
})