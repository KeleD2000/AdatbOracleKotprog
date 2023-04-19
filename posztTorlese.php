<?php
require_once("init.php");
if (!isset($_GET["poszt_id"])) {
    header("location: home.php");
} else {
    echo $_GET["poszt_id"];
    $poszt_id = $_GET["poszt_id"];
    $stmt = oci_parse($con, 'DELETE FROM poszt WHERE id = :poszt_id');
    oci_bind_by_name($stmt, ":poszt_id", $poszt_id);
    if(oci_execute($stmt)){
        header("location: home.php");
    }
}