<?php
require_once("init.php");
if (!isset($_GET["poszt.felhasznalo_id"])) {
    header("location: home.php?id=".$_SESSION["id"]);
} else {
    $poszt_id = $_GET["poszt.felhasznalo_id"];
    $stmt = oci_parse($con, 'DELETE FROM poszt WHERE felhasznalo_id = :felhasznalo_id AND id = :poszt_id');
    oci_bind_by_name($stmt, ":poszt_id", $poszt_id);
    if(oci_execute($stmt)){
        header("location: profile.php?id=".$_SESSION["id"]);
    }
}