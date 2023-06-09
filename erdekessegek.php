<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");

$like_stmt = oci_parse($con, "SELECT felhasznalo.felhasznalonev, COUNT(*) as like_count FROM likes, felhasznalo WHERE likes.felhasznalo_id = felhasznalo.id GROUP BY felhasznalo.felhasznalonev FETCH FIRST 10 ROWS ONLY");
$like_count = [];
oci_execute($like_stmt);
while (($row = oci_fetch_array($like_stmt, OCI_ASSOC)) != false) {
    $like_count[] = $row;
}


$like_count_poszt = array_column($like_count,"FELHASZNALONEV");
$like_count_num = array_column($like_count,"LIKE_COUNT");

$poszt_num_stmt = oci_parse($con, "SELECT felhasznalo.kernev, COUNT(poszt.id) AS post_count FROM felhasznalo LEFT JOIN poszt ON poszt.felhasznalo_id = felhasznalo.id GROUP BY felhasznalo.kernev FETCH FIRST 10 ROWS ONLY");

oci_execute($poszt_num_stmt);

$poszt_num = [];
while (($row = oci_fetch_array($poszt_num_stmt, OCI_ASSOC)) != false) {
    $poszt_num[] = $row;
}
$kernev = array_column($poszt_num, "KERNEV");
$num = array_column($poszt_num, "POST_COUNT");


$poszt_komment_stmt = oci_parse($con, "SELECT felhasznalo.felhasznalonev, COUNT(komment.id) AS komment_count
FROM felhasznalo
LEFT JOIN komment ON komment.felhasznalo_id = felhasznalo.id
GROUP BY felhasznalo.felhasznalonev FETCH FIRST 10 ROWS ONLY");

$poszt_komment_num = [];
oci_execute($poszt_komment_stmt);
while (($row = oci_fetch_array($poszt_komment_stmt, OCI_ASSOC)) != false) {
    $poszt_komment_num[] = $row;
}

$poszt_komment_poszt = array_column($poszt_komment_num, "FELHASZNALONEV");
$poszt_komment_count = array_column($poszt_komment_num, "KOMMENT_COUNT");
?>
<div class="container mt-3">
    <h1 class="title">Posztok száma felhasználónként</h1>
    <div class="box">
    <table class="table" style="width: 100%">
            <tr>
                <th>Felhasználó keresztneve:</th>
                <?php foreach ($kernev as $data) : ?>
                    <td><?php echo $data; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th>Posztok száma:</th>
                <?php foreach ($num as $data) : ?>
                    <td><?php echo $data; ?></td>
                <?php endforeach; ?>
            </tr>
    </table>
    </div>
    <h1 class="title">Kommentek száma felhasználónként</h1>
    <div class="box">
    <table class="table" style="width: 100%">
            <tr>
                <th>Poszt :</th>
                <?php foreach ($poszt_komment_poszt as $data) : ?>
                    <td><?php echo $data; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th>Lájkok száma:</th>
                <?php foreach ($poszt_komment_count as $data) : ?>
                    <td><?php echo $data; ?></td>
                <?php endforeach; ?>
            </tr>
    </table>
    </div>

    <h1 class="title">Lájkok száma felhasználónként</h1>
    <div class="box">
    <table class="table" style="width: 100%">
            <tr>
                <th>Poszt :</th>
                <?php foreach ($like_count_poszt as $data) : ?>
                    <td><?php echo $data; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th>Lájkok száma:</th>
                <?php foreach ($like_count_num as $data) : ?>
                    <td><?php echo $data; ?></td>
                <?php endforeach; ?>
            </tr>
    </table>
    </div>
</div>
<?php html_footer(); ?>