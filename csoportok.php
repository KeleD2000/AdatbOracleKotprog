<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");

$sql = "SELECT csoport. * FROM csoport";
$stmt_csoport = oci_parse($con, $sql);
oci_execute($stmt_csoport);
$csoportok = [];
while (($row = oci_fetch_array($stmt_csoport, OCI_ASSOC)) != false) {
    $csoportok[] = $row;
}

?>
<?php html_footer(); ?>
<div class="container">
    <h1 class="title mt-6">Csoportok</h1>
    <?php if (!empty($csoportok)) : ?>
    <?php foreach ($csoportok as $csoport) : ?>
    <article class="media">
        <div class="media-content">
            <div class="content">
                <p class="title is-4">
                    <?php echo $csoport["CSOP_NEV"] ?>
                </p>
                <p class="subtitle is-6">
                    <?php echo $csoport["CSOP_LEIRAS"] ?>
                </p>
            </div>
        </div>

        <div class="media-right">
            <button class="delete"></button>
        </div>
    </article>
    <?php endforeach; ?>
    <?php else : ?>
    <div><strong>Nincsenek csoportok.</strong></div>
    <?php endif; ?>
</div>