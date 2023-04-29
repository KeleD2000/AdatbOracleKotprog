<?php
//Eltünteti a warningokat
error_reporting(E_ALL & ~E_WARNING);
require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["csop_id"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");
$stmt = oci_parse($con, 'SELECT * FROM csoport WHERE id = :csop_id');
oci_bind_by_name($stmt, ":csop_id", $_GET["csop_id"]);
oci_execute($stmt);
$csoport = oci_fetch_object($stmt);
$err = "";
if (isset($_POST["csop_edit"])) {
    $update_stmt = oci_parse($con, "UPDATE csoport SET csop_leiras = :leiras, csop_nev = :nev WHERE id = :id");
    oci_bind_by_name($update_stmt, ":leiras", $_POST["csop_leiras"]);
    oci_bind_by_name($update_stmt, ":nev", $_POST["csop_nev"]);
    oci_bind_by_name($update_stmt, ":id", $_GET["csop_id"]);
    if (oci_execute($update_stmt)) {
        header("location: sajatcsoportok.php");
    } else {
        $error = oci_error($update_stmt);
        $errorMessage = $error["message"];
        $errorMessageParts = explode("ORA-", $errorMessage);
        $err = $errorMessageParts[1];
    }
}
?>
<form action="editCsoport.php?csop_id=<?php echo $csoport->ID ?>" method="post">
    <div class="container">
        <h1 class="title mt-6">Csoport módosítása</h1>
        <div class="field">
            <div class="control">
                <input type="text" class="input" name="csop_nev" value="<?php echo $csoport->CSOP_NEV; ?>" id="">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <input type="text" class="input" name="csop_leiras" value="<?php echo $csoport->CSOP_LEIRAS; ?>" id="">
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field mt-5">
                    <button type="submit" name="csop_edit" class="button">Csoport módosítása</button>
                </div>
            </div>
        </div>
        <div>
            <?php echo !empty($err) ? explode(":", $err)[1] : ""; ?>
        </div>
    </div>
</form>