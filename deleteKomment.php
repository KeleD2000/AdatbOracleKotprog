<?php
require_once("init.php");
if (!isset($_GET["komment_id"]) && !isset($_GET["poszt_id"])) {
    header("location: index.php");
} else {
    $stmt = oci_parse($con, 'DELETE FROM komment WHERE id = :komment_id');
    oci_bind_by_name($stmt, ":komment_id", $_GET["komment_id"]);
    if(oci_execute($stmt)){
        header("location: komment.php?poszt_id=". $_GET["poszt_id"]);
    }
}