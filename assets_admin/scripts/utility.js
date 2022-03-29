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

    $("#tblCurr").hide();

    const createCurriculum = (formData) => {
        $.ajax({
            type: "POST",
            url: "create_curriculum",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btn_curr").html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function (response) {
                console.log(response);
                $("#btn_curr").html("Submit");
                alert(response.success);
            },
            error: function (response) {
                console.log(response);
                $("#btn_curr").html("Submit");
            },
        });
    };

    $("#btnCurr").on("submit", function (e) {
        e.preventDefault();
        if ($("#programme").val() == "") {
            alert("Enter Programme");
            return false;
        }

        const formData = new FormData(this);
        createCurriculum(formData);
    });

    $("#programme").change(function () {
        this.value !== "" ? $("#tblCurr").show() : $("#tblCurr").hide();
    });
});
