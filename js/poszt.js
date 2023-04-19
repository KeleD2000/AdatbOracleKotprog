$(document).ready(function () {
  loadPoszt(0);
});
$("[name=poszt_select]").change(function () {
  loadPoszt($(this).val());
});

function loadPoszt(value) {
  $("#new_poszt").val("");
  $("#poszt_box").empty();
  ajaxRequest(value);
}
function ajaxRequest(select_id) {
  $.post("ajax_poszt.php", { felhasznalo_id: select_id }, function (data) {
    var json_response = JSON.parse(data);
    var html = "";
    if (Array.isArray(json_response) && !json_response.length) {
      $("#poszt_box").append("<div><strong>Nincsenek posztok.</strong></div>");
    } else {
      for (const key in json_response) {

        let img_src =
          json_response[key]["KEP"] == undefined
            ? "image/profileavatar.webp"
            : "uploads/" + json_response[key]["KEP"];
        html +=
          '<div class="box"><article class="media">' +
          '<div class="media-left">' +
          '<figure class="image is-64x64">' +
          '<img class="is-rounded" src="' +
          img_src +
          '" alt="Image">' +
          "</figure>" +
          "</div>" +
          '<div class="media-content">' +
          '<div class="content">' +
          "<p>" +
          "<strong>" +
          json_response[key]["VEZNEV"] +
          " " +
          json_response[key]["KERNEV"] +
          "</strong> <small>" +
          json_response[key]["FELHASZNALONEV"] +
          "</small>" +
          "<br>" +
          json_response[key]["SZOVEG"] +
          "</p>" +
          "</div>" +
          '<nav class="level is-mobile">' +
          '<div class="level-left">' +
          '<a class="level-item" aria-label="retweet">' +
          '<span class="icon is-small">' +
          '<i class="fa-regular fa-heart"></i>' +
          "</span>" +
          "</a>" +
          '<a class="level-item" aria-label="like">' +
          '<span class="icon is-small">' +
          '<i class="fa-solid fa-heart"></i>' +
          "</span>" +
          "</a>" +
          '<a class="level-item" aria-label="like" href="komment.php?poszt_id='+json_response[key]["ID"]+'">' +
          '<span class="icon is-small">' +
          '<i class="fa-regular fa-comment"></i>' +
          "</span>" +
          "</a>" +
          "</div>" +
          "</nav>" +
          "</div>";

          if(select_id > 0){
            html += 
            '<a class="level-item" aria-label="like" href="editPoszt.php?poszt_id='+json_response[key]["ID"]+'">' +
            '<span class="icon is-small">' +
            '<i class="fa-regular fa-pen-to-square"></i>' +
            "</span>" +
            "</a>" +
            '<div class="media-right">' +
            '<a href="posztTorlese.php?poszt_id='+json_response[key]["ID"]+'">'+
            '<button class="delete">' +
            "</button>"+
            "</a>"+
            '</div>';
          }
          
         html += "</article></div>";
      }
      $("#poszt_box").append(html);
    }
  });
}

function createPost() {
  var textarea = document.getElementById("new_poszt");
  if (textarea.value == "") {
    return;
  }
  $.post("ajax_poszt.php", { poszt_szoveg: textarea.value }, function (data) {
    loadPoszt(0);
  });
}
