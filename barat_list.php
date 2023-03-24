<?php
$stmt_barat = oci_parse($con, "SELECT felhasznalo.* FROM kapcsolat INNER JOIN baratok ON kapcsolat.baratok_userid = baratok.id INNER JOIN felhasznalo ON baratok.userid = felhasznalo.id WHERE kapcsolat.felhasznalo_id = :userid");
oci_bind_by_name($stmt_barat, ":userid", $_SESSION["id"]);
oci_execute($stmt_barat);
$baratok = [];
while (($row = oci_fetch_array($stmt_barat, OCI_ASSOC)) != false) {
    $baratok[] = $row;
}
?>
<div class="friend_container">
    <?php if (!empty($baratok)) : ?>
        <?php foreach ($baratok as $barat) : ?>
            <div class="media">
                <div class="media-left">
                    <figure class="image is-96x96">
                        <img class="is-rounded" src="<?php echo (!isset($barat["KEP"])) ? "image/profileavatar.webp" : "uploads/".$barat["KEP"]; ?>" alt="Placeholder image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo $barat["VEZNEV"] . " " . $barat["KERNEV"]; ?></p>
                    <a href="baratTorles.php?baratid=<?= $barat["ID"] ?>" class="button">Törlés</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div><strong>Nincsenek barátaid.</strong></div>
    <?php endif; ?>
</div>
