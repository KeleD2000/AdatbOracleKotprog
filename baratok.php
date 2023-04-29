<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöljük");
$stmt_barat = oci_parse($con, "SELECT * FROM felhasznalo WHERE felhasznalo.id != '".$_SESSION["id"]."' AND felhasznalo.id NOT IN (SELECT baratok.id FROM kapcsolat, baratok WHERE kapcsolat.baratok_id = baratok.id)");
oci_execute($stmt_barat);
$baratok = [];
while (($row = oci_fetch_array($stmt_barat, OCI_ASSOC)) != false) {
    $baratok[] = $row;
}
include("navbar.php");
?>
<div class="container">
    <h1 class="title mt-6">Kit ismerhetek?</h1>
    <div class="friend_container">
    <?php foreach($baratok as $key => $barat): ?>
                <div class="card mt-5">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-96x96">
                                    <img class="is-rounded" src="<?php echo (!empty($barat["KEP"])) ? "uploads/".$barat["KEP"] : "image/profileavatar.webp"; ?>" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4"><?php echo $barat["VEZNEV"] . " " . $barat["KERNEV"];  ?></p>
                                <p class="subtitle is-6">@<?php echo $barat["FELHASZNALONEV"] ?></p>
                            </div>
                        </div>
                        <div class="content has-text-right">
                            <a href="baratFelvetel.php?baratid=<?= $barat["ID"] ?>" class="button is-info">Hozzáad</a>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
</div>
<?php html_footer(); ?>