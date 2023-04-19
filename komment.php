<?php
require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["poszt_id"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");

$stmt_barat = oci_parse($con, "SELECT felhasznalo.veznev, felhasznalo.kernev, felhasznalo.felhasznalonev, felhasznalo.kep, komment.szoveg FROM komment, felhasznalo WHERE komment.felhasznalo_id = felhasznalo.id AND komment.poszt_id = :poszt_id");
oci_bind_by_name($stmt_barat, ":poszt_id", $_GET["poszt_id"]);
oci_execute($stmt_barat);
$kommentek = [];
while (($row = oci_fetch_array($stmt_barat, OCI_ASSOC)) != false) {
    $kommentek[] = $row;
}
?>
<section class="container">
    <h1 class="title mt-3">Kommentek</h1>
    <?php if (empty($kommentek)) : ?>
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>Barbara Middleton</strong>
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porta eros lacus, nec ultricies
                        elit blandit non. Suspendisse pellentesque mauris sit amet dolor blandit rutrum. Nunc in tempus
                        turpis.
                        <br>
                        <small><a>Like</a> · <a>Reply</a> · 3 hrs</small>
                    </p>
                </div>

            </div>
        </article>

    <?php else : ?>
        <div><strong>Nincsenek kommentek</strong></div>
    <?php endif; ?>

    <article class="media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img src="<?php echo (!is_null($_SESSION["img"])) ? "uploads/" . $_SESSION["img"] : "image/profileavatar.webp" ?>">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea style="resize: none;" class="textarea" placeholder="Add a comment..."></textarea>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button class="button">Post comment</button>
                </p>
            </div>
        </div>
    </article>
</section>
<?php html_footer(); ?>