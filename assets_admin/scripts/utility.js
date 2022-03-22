$(document).ready(function ($) {
    $("#tblCurr").hide();

    const createCurriculum = (formData) => {
        $.ajax({
            type: "POST",
            url: "",
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

    $("#form_curr").on("submit", function (e) {
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
