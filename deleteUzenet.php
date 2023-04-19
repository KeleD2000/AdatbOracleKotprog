<?php
require_once("init.php");
if (!isset($_GET["uzenet_id"])) {
    header("location: uzenetek.php");
} else {
    $stmt = oci_parse($con, 'DELETE FROM uzenet WHERE id = :uzenet_id');
    oci_bind_by_name($stmt, ":uzenet_id", $_GET["uzenet_id"]);
    if(oci_execute($stmt)){
        header("location: uzenetek.php");
    }
}