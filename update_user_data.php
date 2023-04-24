<?php
require("init.php");
$stmt_user = oci_parse($con, "SELECT * FROM felhasznalo WHERE id = :userid");
oci_bind_by_name($stmt_user, ":userid", $_SESSION["id"]);
oci_execute($stmt_user);
$user = oci_fetch_object($stmt_user);


if (isset($_POST["edit_user"])) {
    $date = date("y-M-d", strtotime($_POST["szulido"]));
    $stmt_insert = oci_parse($con, "UPDATE felhasznalo SET kernev = :kernev, veznev = :veznev, szulido = :szulido, felhasznalonev = :felhasznalonev, jelszo = :jelszo, email = :email WHERE id = :user_id");
    oci_bind_by_name($stmt_insert, ":kernev", $_POST["kernev"]);
    oci_bind_by_name($stmt_insert, ":veznev", $_POST["veznev"]);
    oci_bind_by_name($stmt_insert, ":szulido", $date);
    oci_bind_by_name($stmt_insert, ":felhasznalonev", $_POST["felhasznalonev"]);
    oci_bind_by_name($stmt_insert, ":jelszo", $_POST["jelszo"]);
    oci_bind_by_name($stmt_insert, ":email", $_POST["email"]);
    oci_bind_by_name($stmt_insert, ":user_id", $_SESSION["id"]);
    if (oci_execute($stmt_insert)) {
        header("location: profile.php?id=". $_SESSION["id"]);
    }
}
