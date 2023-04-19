$(document).ready(function () {
  $(document).on("click", "#message", function () {
    let kuldo = $(this).attr("data-id");
    let fogado = $("#logged_user_id").val();
    request(kuldo, fogado);
  });

  $(document).on("click", ".send_msg_btn", function () {
    let kuldo_id = $(this).attr("id");
    let fogado_id = $(this).attr("data-id");
    let uzenet = $(".msg_area").val();
    //console.log("kuldo:" + kuldo_id, "fogado:" + fogado_id, "uzenet: " + uzenet);
    $.post(
      "ajax_poszt.php",
      { kuldo: kuldo_id, fogado: fogado_id, uzenet: uzenet },
      function (data) {
        request(fogado_id, kuldo_id);
      }
    );
  });
});

function request(kuldo, fogado) {
  $.post("ajax_poszt.php", { kuldo: kuldo, fogado: fogado }, function (data) {
    $("#message_column").html(data);
  });
}
