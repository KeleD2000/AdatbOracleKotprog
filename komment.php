<?php
require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["poszt_id"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");

$stmt_barat = oci_parse($con, "SELECT felhasznalo.veznev, felhasznalo.kernev, felhasznalo.felhasznalonev, felhasznalo.kep, komment.szoveg, komment.id as kommentid FROM komment, felhasznalo WHERE komment.felhasznalo_id = felhasznalo.id AND komment.poszt_id = :poszt_id");
oci_bind_by_name($stmt_barat, ":poszt_id", $_GET["poszt_id"]);
oci_execute($stmt_barat);
$kommentek = [];
while (($row = oci_fetch_array($stmt_barat, OCI_ASSOC)) != false) {
    $kommentek[] = $row;
}
if(isset($_POST["komment"])){
    $stmt = oci_parse($con, "INSERT INTO komment (poszt_id, felhasznalo_id, szoveg) VALUES (:poszt_id, :felhasznalo_id, :szoveg)");
    oci_bind_by_name($stmt,":poszt_id", $_GET["poszt_id"]);
    oci_bind_by_name($stmt,":felhasznalo_id", $_SESSION["id"]);
    oci_bind_by_name($stmt,":szoveg", $_POST["szoveg"]);
    if(oci_execute($stmt)){
        header("location: komment.php?poszt_id=". $_GET["poszt_id"]);
    }
}
?>
<section class="container">
    <h1 class="title mt-3">Kommentek</h1>
    <?php if (!empty($kommentek)) : foreach($kommentek as $komment): ?>
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="<?php echo (!is_null($komment["KEP"])) ? "uploads/". $komment["KEP"] : "image/profileavatar.webp"; ?>">
                </p>
            </figure>
            <div class="media-content">
                <div class="content" style="display: flex; align-items: center; justify-content: space-between;">
                    <p>
                        <strong><?php echo $komment["VEZNEV"] . " " . $komment["KERNEV"]; ?></strong>
                        <br>
                        <?php echo $komment["SZOVEG"]; ?>
                        <br>
                    </p>
                    <div class="media-right">
                        <a href="deleteKomment.php?komment_id=<?=$komment["KOMMENTID"]?>&poszt_id=<?=$_GET["poszt_id"]?>" class="delete"></a>
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; else : ?>
        <div><strong>Nincsenek kommentek</strong></div>
    <?php endif; ?>

    <article class="media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img src="<?php echo (!is_null($_SESSION["img"])) ? "uploads/" . $_SESSION["img"] : "image/profileavatar.webp" ?>">
            </p>
        </figure>
        <div class="media-content">
            <form action="komment.php?poszt_id=<?=$_GET['poszt_id']?>" method="post">
                <div class="field">
                    <p class="control">
                        <textarea style="resize: none;" class="textarea" name="szoveg" placeholder="Add a comment..."></textarea>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <button type="submit" name="komment" class="button">Komment</button>
                    </p>
                </div>
            </form>
        </div>
    </article>
</section>
<?php html_footer(); ?>