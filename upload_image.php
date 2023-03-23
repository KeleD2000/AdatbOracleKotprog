<?php 
require_once("init.php");
if(isset($_FILES)){
    if (isset($_FILES["kep"]) && !empty($_FILES["kep"]["name"])) {
        $imgName = time() . '_' . $_FILES["kep"]["name"];
        $target = 'uploads/' . $imgName;
        move_uploaded_file($_FILES["kep"]["tmp_name"], $target);

        $upload_stmt = oci_parse($con, "UPDATE felhasznalo SET kep = :kep WHERE id = :id");
        oci_bind_by_name($upload_stmt, ":kep", $imgName);
        oci_bind_by_name($upload_stmt, ":id", $_SESSION["id"]);
        if(oci_execute($upload_stmt)){
            header("location: profile.php?id=".$_SESSION["id"]);
        }else{
            header("location: profile.php?id=".$_SESSION["id"]. "&error=Sikertelen képfeltöltés");
        }
    }
}
?>
