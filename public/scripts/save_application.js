$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn_basic").click(function(){ 
        alert('hey')
        $("#form_basic").validate({
            submitHandler: submitFormBasic 
        });

        function submitFormBasic(e) { 
            var formData = $("#editVendorForm").serialize();
            var type = "POST";
            var ajaxurl = 'save/app/form';

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                beforeSend: function() { 
                    $("#btn_basic").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; processing');
                },
                success: function (response) {
                    console.log(response);
                    $("#btn_basic").html('Next');
                },
                error: function (response) {
                    console.log(response);
                    $("#btn_basic").html('Next');
                }
            });

        }
    })
})