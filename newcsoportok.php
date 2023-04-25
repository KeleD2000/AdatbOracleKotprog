<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");

if (isset($_POST["create_csoport"])) {
    /*$insert_stmt = oci_parse($con, "INSERT INTO csoport (csop_leiras, csop_nev) VALUES(:csop_leiras, :csop_nev) RETURNING ID INTO :csop_id");
    oci_bind_by_name($insert_stmt, ":csop_leiras", $_POST["csop_leiras"]);
    oci_bind_by_name($insert_stmt, ":csop_nev", $_POST["csop_nev"]);
    oci_bind_by_name($insert_stmt, ":csop_id", $last_csop_id);
    oci_execute($insert_stmt);

    $kapcsolat_stmt = oci_parse($con, "INSERT INTO tartozik (felhasznalo_id, csoport_id) VALUES(:felhasznalo_id, :csoport_id)");
    oci_bind_by_name($kapcsolat_stmt, ":felhasznalo_id", $_SESSION["id"]);
    oci_bind_by_name($kapcsolat_stmt, ":csoport_id", $last_csop_id);
    oci_execute($kapcsolat_stmt);*/

    $stmt = oci_parse($con, "BEGIN create_csoport(:csop_nev, :csop_leiras, :user_id); END;");
    oci_bind_by_name($stmt, ":csop_leiras", $_POST["csop_leiras"]);
    oci_bind_by_name($stmt, ":csop_nev", $_POST["csop_nev"]);
    oci_bind_by_name($stmt, ":user_id", $_SESSION["id"]);
    oci_execute($stmt);
    header("location: csoportok.php");
}
?>
<form action="newcsoportok.php" method="post">
    <div class="container">
        <h1 class="title mt-6">Csoport létrehozása</h1>
        <div class="field">
            <div class="control">
                <label>Csoport neve</label>
                <input class="input is-large" name="csop_nev" type="text" placeholder="Csoport neve">
            </div>
        </div>
        <div class="control">
            <label>Csoport leírása</label>
            <input class="input is-large" name="csop_leiras" type="text" placeholder="Csoport leírása">
        </div>
        <div class="columns">
            <div class="column mt-5">
                <div class="field mt-5">
                    <button type="submit" name="create_csoport" class="button">Csoport létrehozása</button>
                </div>
            </div>
        </div>
</form>