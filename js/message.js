$(document).ready(function(){
    $(document).on('click','#message',function(){
        $.post("ajax_poszt.php", {kuldo: $(this).attr("data-id"), fogado: $("#logged_user_id").val()}, function(data){
            $("#message_column").html(data);
        });
    });
});