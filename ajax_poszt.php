<?php
require_once("init.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["felhasznalo_id"])) {
    $sql = "SELECT poszt.*, felhasznalo.kep, felhasznalo.veznev, felhasznalo.kernev, felhasznalo.felhasznalonev, (SELECT COUNT(*) FROM likes WHERE poszt_id = poszt.id) as like_count FROM poszt, felhasznalo WHERE poszt.felhasznalo_id = felhasznalo.id AND csoportposzt IS NULL";
    if (isset($_POST["felhasznalo_id"]) && $_POST["felhasznalo_id"] > 0) {
        $sql .= " AND poszt.felhasznalo_id = " . $_POST["felhasznalo_id"];
    }
    $sql .= " ORDER BY poszt.id DESC";
    $stmt_poszt = oci_parse($con, $sql);
    //oci_bind_by_name($stmt_poszt, ":userid", $_SESSION["id"]);
    oci_execute($stmt_poszt);
    $posztok = [];
    while (($row = oci_fetch_array($stmt_poszt, OCI_ASSOC)) != false) {
        $posztok[] = $row;
    }
    $stmt_like = oci_parse($con, "SELECT * FROM likes WHERE poszt_id = :poszt_id AND felhasznalo_id = :felhasznalo_id");
    foreach($posztok as $key => $p){
        oci_bind_by_name($stmt_like, ":poszt_id", $posztok[$key]["ID"]);
        oci_bind_by_name($stmt_like, ":felhasznalo_id", $_SESSION["id"]);
        oci_execute($stmt_like);
        $like = oci_fetch_object($stmt_like);
        if($like){
            $posztok[$key]["like"] = "1";
        }else{
            $posztok[$key]["like"] = "0";
        }
    }
  
    //echo "<pre>" . print_r($posztok, true) . "</pre>";
    echo json_encode($posztok);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["poszt_szoveg"])) {
    $szoveg = $_POST["poszt_szoveg"];
    $date = date("y-M-d", strtotime(Date("Y-m-d")));
    $stmt = oci_parse($con, 'INSERT INTO poszt (szoveg, datum, felhasznalo_id) VALUES(:szoveg, :datum, :felhasznalo_id)');
    oci_bind_by_name($stmt, ":szoveg", $szoveg);
    oci_bind_by_name($stmt, ":felhasznalo_id", $_SESSION["id"]);
    oci_bind_by_name($stmt, ":datum", $date);
    oci_execute($stmt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kuldo"]) && isset($_POST["fogado"])) {
    $stmt_message = oci_parse($con, "SELECT uzenet.*, uzenetkuldes.* FROM uzenet, uzenetkuldes WHERE uzenet.id = uzenetkuldes.uzenet_id AND ((kuldo = :kuldo AND fogado = :fogado) OR (kuldo = :fogado AND fogado = :kuldo)) ORDER BY uzenet.id ASC");
    oci_bind_by_name($stmt_message, ":kuldo", $_POST["kuldo"]);
    oci_bind_by_name($stmt_message, ":fogado", $_POST["fogado"]);
    oci_execute($stmt_message);
    $output = '<h1 class="title mt-6">Üzenetek</h1>
    <div class="box" id="message_box">';
    $messages = [];
    while (($row = oci_fetch_array($stmt_message, OCI_ASSOC)) != false) {
        if ($row["KULDO"] == $_POST["kuldo"]) {
            $output .= '<div class="chat-container">
            <p style="text-align: right;">' . $row["TARTALOM"] . '</p>';
            $output .= '</div>';
        } else {
            $output .= '<div class="chat-container darker">
            <p>' . $row["TARTALOM"] . '</p>';
            $output .= '<div style="text-align: right">
    <a href="deleteUzenet.php?uzenet_id=' . $row["UZENET_ID"] . '" class="delete"></a>
</div>';
            $output .= '</div>';
        }
    }

    $img_src = (!is_null($_SESSION["img"])) ? "uploads/" . $_SESSION["img"] : "image/profileavatar.webp";
    $output .= '</div><article class="media">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="' . $img_src . '">
        </p>
    </figure>
    <div class="media-content">
        <div class="field">
            <p class="control">
                <textarea style="resize: none;" class="textarea msg_area" placeholder="Írj ide egy üzenetet...."></textarea>
            </p>
        </div>
        <div class="field">
            <p class="control">
                <button id="' . $_POST["fogado"] . '" data-id="' . $_POST["kuldo"] . '" class="button send_msg_btn">Küldés</button>
            </p>
        </div>
    </div>
</article>';
    echo $output;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kuldo"]) && isset($_POST["fogado"]) && isset($_POST["uzenet"])) {
    $date = date("y-M-d", strtotime(Date("Y-m-d")));
    $stmt = oci_parse($con, 'INSERT INTO uzenet (tartalom, datum) VALUES(:tartalom, :datum) RETURNING ID INTO :last_msg_id');
    oci_bind_by_name($stmt, ":tartalom", $_POST["uzenet"]);
    oci_bind_by_name($stmt, ":datum", $date);
    oci_bind_by_name($stmt, ":last_msg_id", $last_msg_id);
    if (oci_execute($stmt)) {
        $stmt_uzenetkuldes = oci_parse($con, 'INSERT INTO uzenetkuldes (kuldo, fogado, uzenet_id) VALUES(:kuldo, :fogado, :uzenet_id)');
        oci_bind_by_name($stmt_uzenetkuldes, ":kuldo", $_POST["kuldo"]);
        oci_bind_by_name($stmt_uzenetkuldes, ":fogado", $_POST["fogado"]);
        oci_bind_by_name($stmt_uzenetkuldes, ":uzenet_id", $last_msg_id);
        if (oci_execute($stmt_uzenetkuldes)) {
            echo "1";
        }
    }
}
