$(document).ready(function(){
    $(document).on("click","#csop_box",function(){
        window.location.href = "viewcsoport.php?csop_id=" +  $(this).attr("data-id");
    });
});