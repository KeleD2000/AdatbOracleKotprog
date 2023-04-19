<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");

$sql = "SELECT csoport.* FROM csoport, tartozik, felhasznalo WHERE csoport.id = tartozik.csoport_id AND tartozik.felhasznalo_id = felhasznalo.id ORDER BY csoport.id DESC";
$stmt_csoport = oci_parse($con, $sql);
oci_execute($stmt_csoport);
$csoportok = [];
while (($row = oci_fetch_array($stmt_csoport, OCI_ASSOC)) != false) {
    $csoportok[] = $row;
}

if(isset($_GET["delete"])){
    $delete_csop = oci_parse($con, "DELETE FROM csoport WHERE id = :id");
    oci_bind_by_name($delete_csop, ":id", $_GET["delete"]);
    oci_execute($delete_csop);

    $delete_tartozik = oci_parse($con, "DELETE FROM tartozik WHERE felhasznalo_id = :felhasz_id AND csoport_id = :csoport_id");
    oci_bind_by_name($delete_tartozik, ":felhasz_id", $_SESSION["id"]);
    oci_bind_by_name($delete_tartozik, ":csoport_id", $_GET["delete"]);
    oci_execute($delete_tartozik);
    header("location: sajatcsoportok.php");
}
?>
<div class="container">
    <h1 class="title mt-6">Csoportok</h1>
    <?php if (!empty($csoportok)) : ?>
        <?php foreach ($csoportok as $csoport) : ?>
            <div id="csop_box" data-id="<?=$csoport["ID"]?>" class="box">
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
                        <a href="sajatcsoportok.php?delete=<?=$csoport["ID"]?>" class="delete"></a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div><strong>Nincsenek csoportok.</strong></div>
    <?php endif; ?>
</div>
<?php html_footer(); ?>