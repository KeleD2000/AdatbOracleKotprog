<?php
require_once("init.php");
if (!isset($_GET["baratid"])) {
    header("location: profile.php?id=".$_SESSION["id"]);
} else {
    $barat_id = $_GET["baratid"];
    $stmt = oci_parse($con, 'DELETE FROM baratok WHERE userid = :barat_id');
    oci_bind_by_name($stmt, ":barat_id", $barat_id);
    if(oci_execute($stmt)){
        header("location: profile.php?id=".$_SESSION["id"]);
    }
}
