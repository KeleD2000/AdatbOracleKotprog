<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");

$stmt = oci_parse($con, 'SELECT * FROM csoport WHERE id = :csoport_id');
oci_bind_by_name($stmt, ":csoport_id", $_GET["csop_id"]);
oci_execute($stmt);
$csoport = oci_fetch_object($stmt);

$stmt_csopposztok = oci_parse($con, "SELECT poszt.*, felhasznalo.veznev, felhasznalo.kernev, felhasznalo.felhasznalonev, felhasznalo.kep FROM poszt, csoport, felhasznalo WHERE csoport.id = poszt.csoportposzt AND felhasznalo.id = poszt.felhasznalo_id AND poszt.csoportposzt = :csoport_id");
oci_bind_by_name($stmt_csopposztok, ":csoport_id", $_GET["csop_id"]);
oci_execute($stmt_csopposztok);
$csop_posztok = [];
while (($row = oci_fetch_array($stmt_csopposztok, OCI_ASSOC)) != false) {
    $csop_posztok[] = $row;
}

if (isset($_POST["create_csop_poszt"])) {
    $date = date("y-M-d", strtotime(Date("Y-m-d")));
    $stmt = oci_parse($con, 'INSERT INTO poszt (szoveg, datum, felhasznalo_id, csoportposzt) VALUES(:szoveg, :datum, :felhasznalo_id, :csoportposzt)');
    oci_bind_by_name($stmt, ":szoveg", $_POST["csop_poszt_szoveg"]);
    oci_bind_by_name($stmt, ":felhasznalo_id", $_SESSION["id"]);
    oci_bind_by_name($stmt, ":datum", $date);
    oci_bind_by_name($stmt, ":csoportposzt", $_GET["csop_id"]);
    if (oci_execute($stmt)) {
        header("location: viewcsoport.php?csop_id=" . $_GET["csop_id"]);
    }
}
?>

<body>
    <div class="container">
        <h1 class="title mt-6"><?php echo $csoport->CSOP_NEV ?></h1>
        <form action="viewcsoport.php?csop_id=<?= $csoport->ID; ?>" method="post">
            <div class="field">
                <div class="control">
                    <textarea style="resize: none;" class="textarea" name="csop_poszt_szoveg" id="new_poszt" placeholder="Mi jár a fejedben?"></textarea>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field mt-2 is-pulled-left">
                        <p class="control">
                            <button type="submit" name="create_csop_poszt" class="button">Poszt létrehozása</button>
                        </p>
                    </div>
                </div>
                <div class="column has-text-right">
                </div>
            </div>
        </form>
        <?php if (!empty($csop_posztok)) : ?>
            <?php foreach ($csop_posztok as $csopposzt) : ?>
                <div class="box mt-2">
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="<?php echo (!is_null($csopposzt["KEP"])) ? "uploads/" . $csopposzt["KEP"] : "images/profileavatar.webp"; ?>">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong><?php echo $csopposzt["VEZNEV"] . " " . $csopposzt["KERNEV"] ?></strong> <small><?php echo $csopposzt["FELHASZNALONEV"] ?></small> <small><?php echo date("Y-m-d", strtotime($csopposzt["DATUM"])) ?></small>
                                    <br>
                                    <?php echo $csopposzt["SZOVEG"]; ?>
                                </p>
                            </div>
                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <a class="level-item" aria-label="like" href="komment.php">
                                        <span class="icon is-small">
                                            <i class="fa-regular fa-comment"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="like" href="komment.php">
                                        <span class="icon is-small">
                                            <i class="fa-solid fa-heart"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="like" href="komment.php">
                                        <span class="icon is-small">
                                            <i class="fa-regular fa-heart"></i>
                                        </span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                        <?php if ($csopposzt["FELHASZNALO_ID"] == $_SESSION["id"]) : ?>
                            <div class="media-right">
                                <a href="posztTorlese.php?poszt_id=<?php echo $csopposzt["ID"] ?>&csop_id= <?php echo $_GET["csop_id"] ?>" class="delete"></a>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div>
                <strong>Nincsenek posztok.</strong>
            </div>
        <?php endif; ?>
    </div>
    <?php html_footer(); ?>