<?php
require_once("init.php");
if (!isset($_GET["poszt_id"]) || !isset($_SESSION["id"])) {
    header("location: home.php");
}

/*$stmt_like = oci_parse($con, "SELECT * FROM likes WHERE poszt_id = :poszt_id AND felhasznalo_id = :felhasznalo_id");
oci_bind_by_name($stmt_like, ":poszt_id", $_GET["poszt_id"]);
oci_bind_by_name($stmt_like, ":felhasznalo_id", $_SESSION["id"]);
oci_execute($stmt_like);
$like = oci_fetch_object($stmt_like);
if ($like) {
    $stmt_delete = oci_parse($con, "DELETE FROM likes WHERE poszt_id = :poszt_id AND felhasznalo_id = :felhasznalo_id");
    oci_bind_by_name($stmt_delete, ":poszt_id", $_GET["poszt_id"]);
    oci_bind_by_name($stmt_delete, ":felhasznalo_id", $_SESSION["id"]);
    oci_execute($stmt_delete);
    header("location: home.php");
} else {
    $stmt_insert = oci_parse($con, "INSERT INTO likes(poszt_id, felhasznalo_id) VALUES (:poszt_id, :felhasznalo_id)");
    oci_bind_by_name($stmt_insert, ":poszt_id", $_GET["poszt_id"]);
    oci_bind_by_name($stmt_insert, ":felhasznalo_id", $_SESSION["id"]);
    oci_execute($stmt_insert);
    header("location: home.php");
}*/

$stmt = oci_parse($con, "BEGIN like_procedure(:poszt_id, :felhasznalo_id); END;");
oci_bind_by_name($stmt, ":poszt_id", $_GET["poszt_id"]);
oci_bind_by_name($stmt, ":felhasznalo_id", $_SESSION["id"]);
oci_execute($stmt);
header("location: home.php");