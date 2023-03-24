<?php
require_once("init.php");
if (!isset($_GET["baratid"])) {
    header("location: baratok.php");
} else {
    $felhasznalo_id = $_SESSION["id"];
    $barat_id = $_GET["baratid"];
    $date = date("y-M-d", strtotime(Date("Y-m-d")));
    $stmt = oci_parse($con, 'INSERT INTO baratok(userid, datum) VALUES(:userid, :datum) RETURNING ID INTO :p_val');
    oci_bind_by_name($stmt, ":userid", $barat_id);
    oci_bind_by_name($stmt, ":datum", $date);
    oci_bind_by_name($stmt, ":p_val", $last_id);
    oci_execute($stmt);

    $kapcsolat_stmt = oci_parse($con, "INSERT INTO kapcsolat(felhasznalo_id, baratok_userid) VALUES(:felhasznalo_id, :baratok_userid)");
    oci_bind_by_name($kapcsolat_stmt, ":felhasznalo_id", $felhasznalo_id);
    oci_bind_by_name($kapcsolat_stmt, ":baratok_userid", $last_id);
    oci_execute($kapcsolat_stmt);

    if(oci_execute($kapcsolat_stmt)){
        header("location: baratok.php");
    }
}
