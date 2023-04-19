<?php
require_once("init.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["felhasznalo_id"])) {
    $sql = "SELECT poszt.*, felhasznalo.kep, felhasznalo.veznev, felhasznalo.kernev, felhasznalo.felhasznalonev FROM poszt, felhasznalo WHERE poszt.felhasznalo_id = felhasznalo.id AND csoportposzt = 0";
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
    $stmt_message = oci_parse($con, "SELECT uzenet.*, uzenetkuldes.* FROM uzenet, uzenetkuldes WHERE uzenet.id = uzenetkuldes.uzenet_id AND ((kuldo = :kuldo AND fogado = :fogado) OR (kuldo = :fogado AND fogado = :kuldo)) ORDER BY uzenet.id DESC");
    oci_bind_by_name($stmt_message, ":kuldo", $_POST["kuldo"]);
    oci_bind_by_name($stmt_message, ":fogado", $_POST["fogado"]);
    oci_execute($stmt_message);
    $output = '<h1 class="title mt-6">Üzenetek</h1>
    <div class="box" id="message_box">';
    $messages = [];
    while (($row = oci_fetch_array($stmt_message, OCI_ASSOC)) != false) {
        if ($row["KULDO"] == $_POST["kuldo"]) {
            $output .= '<div class="chat-container">
            <p style="text-align: right;">' . $row["TARTALOM"] . '</p>
        </div>';
        } else {
            $output .= '<div class="chat-container darker">
            <p>' . $row["TARTALOM"] . '</p>
        </div>';
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
                <textarea style="resize: none;" class="textarea" placeholder="Írj ide egy üzenetet...."></textarea>
            </p>
        </div>
        <div class="field">
            <p class="control">
                <button class="button">Küldés</button>
            </p>
        </div>
    </div>
</article>';
    echo $output;
}
