<?php
require_once("init.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["felhasznalo_id"])) {
    $sql = "SELECT poszt.*, felhasznalo.* FROM poszt, felhasznalo WHERE poszt.felhasznalo_id = felhasznalo.id AND csoportposzt = 0";
    if (isset($_POST["felhasznalo_id"]) && $_POST["felhasznalo_id"] > 0) {
        $sql .= " AND felhasznalo.id = " . $_POST["felhasznalo_id"];
    }
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
