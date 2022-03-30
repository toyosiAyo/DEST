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
            url: "/api/create_curriculum",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btnCurr").html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function (response) {
                console.log(response);
                $("#btnCurr").html("Submit");
                toastr["success"](response.success);
            },
            error: function (response) {
                console.log(response);
                $("#btnCurr").html("Submit");
                toastr["error"](response.responseJSON.error);
            },
        });
    };

    const submitEventForm = (formData) => {
        var type = "POST";
        var ajaxurl = "/create_event";

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btnEventForm").html(
                    '<i class="fa fa-spinner fa-spin"></i>'
                );
            },
            success: function (response) {
                console.log(response);
                $("#btnEventForm").html("Create");
                toastr["success"](response.message);
                setTimeout(function () {
                    window.location.href = "/admin/events";
                }, 2800);
            },
            error: function (response) {
                console.log(response);
                $("#btnEventForm").html("Create");
                toastr["error"](response.responseJSON.message);
            },
        });
    };

    $("#formCurr").on("submit", function (e) {
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

    $("#eventForm").on("submit", function (e) {
        formData = new FormData(this);
        submitEventForm(formData);
    });
});
