$(document).ready(function($){ 
    $("#app_table").on("click",".view", function(){
        $('#view_app').modal('show')
        var status = $(this).data('status')
        var appID = $(this).data('id')
        $('#details').html(status + appID)


    })

})