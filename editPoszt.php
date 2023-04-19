<?php
require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["poszt_id"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");
$stmt = oci_parse($con, 'SELECT * FROM poszt WHERE id = :poszt_id');
oci_bind_by_name($stmt, ":poszt_id", $_GET["poszt_id"]);
oci_execute($stmt);
$poszt = oci_fetch_object($stmt);

if(isset($_POST["poszt_edit"])){
    $update_stmt = oci_parse($con, "UPDATE poszt SET szoveg = :szoveg WHERE id = :id");
    oci_bind_by_name($update_stmt, ":szoveg", $_POST["szoveg"]);
    oci_bind_by_name($update_stmt, ":id", $_GET["poszt_id"]);
    if(oci_execute($update_stmt)){
        header("location: home.php");
    }
}
?>
<form action="editPoszt.php?poszt_id=<?php echo $poszt->ID ?>" method="post">
    <div class="container">
        <h1 class="title mt-6">Poszt módosítása</h1>
        <div class="field">
            <div class="control">
                <textarea style="resize: none;" class="textarea" name="szoveg" id="new_poszt" placeholder=""><?php echo $poszt->SZOVEG; ?></textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field mt-5">
                    <button type="submit" name="poszt_edit" class="button">Poszt módosítása</button>
                </div>
            </div>
        </div>
</form>