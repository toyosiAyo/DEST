$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn_basic").click(function(){ 
        $("#form_basic").validate({
            submitHandler: submitFormBasic,
            errorClass: "invalid"
        });

        function submitFormBasic(e) { 
            var formData = $("#form_basic").serialize();
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
                    $("#btn_basic").html('Next')
                    $("#basic_info").prop("disabled", true)
                    $("#academic_info").prop("disabled", false)
                    $("#academic_info").trigger("click")
                },
                error: function (response) {
                    console.log(response);
                    $("#btn_basic").html('Next');
                }
            });

        }
    })

    $("#btn_academic").click(function(){ 
        $("#form_academic").validate({
            submitHandler: submitFormAcademic,
            errorClass: "invalid" 
        });

        function submitFormAcademic(e) { 
            var formData = $("#form_academic").serialize();
            var type = "POST";
            var ajaxurl = 'save/app/form';

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                beforeSend: function() { 
                    $("#btn_academic").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; processing');
                },
                success: function (response) {
                    console.log(response);
                    $("#btn_academic").html('Next')
                    $("#academic_info").prop("disabled", true)
                    $("#declaration_info").prop("disabled", false)
                    $("#declaration_info").trigger("click")
                },
                error: function (response) {
                    console.log(response);
                    $("#btn_academic").html('Next');
                }
            });

        }
    })

    // $("#btn_declaration").click(function(){ 
    //     $("#form_declaration").validate({
    //         submitHandler: submitFormDeclaration,
    //         errorClass: "invalid" 
    //     });

    //     function submitFormDeclaration(e) { 
    //         var formData = $("#form_declaration").serialize();
    //         var type = "POST";
    //         var ajaxurl = 'save/app/form';

    //         $.ajax({
    //             type: type,
    //             url: ajaxurl,
    //             data: formData,
    //             dataType: 'json',
    //             beforeSend: function() { 
    //                 $("#btn_declaration").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; processing');
    //             },
    //             success: function (response) {
    //                 console.log(response);
    //                 $("#btn_declaration").html('Next')
    //                 window.location.href ='application'
    //             },
    //             error: function (response) {
    //                 console.log(response);
    //                 $("#btn_declaration").html('Next');
    //             }
    //         });

    //     }
    // })
})