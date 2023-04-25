<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");

$sql = "SELECT * FROM csoport ORDER BY id DESC";
$stmt_csoport = oci_parse($con, $sql);
oci_execute($stmt_csoport);
$csoportok = [];
while (($row = oci_fetch_array($stmt_csoport, OCI_ASSOC)) != false) {
    $csoportok[] = $row;
}

$stmt_csop_group_by = oci_parse($con, "SELECT csoport.csop_nev, COUNT(*) as count FROM csoport, tartozik WHERE csoport.id = tartozik.csoport_id GROUP BY csoport.csop_nev FETCH FIRST 10 ROWS ONLY");
oci_execute($stmt_csop_group_by);
$csop_group = [];
while (($row = oci_fetch_array($stmt_csop_group_by, OCI_ASSOC)) != false) {
    $csop_group[] = $row;
}

$table_header = [];

foreach ($csop_group as $data) {
    $table_header[] = $data["CSOP_NEV"];
}

$stmt_szulnap = oci_parse($con, "SELECT csoport.csop_nev, EXTRACT(MONTH FROM felhasznalo.szulido) as honap, COUNT(*) as num FROM felhasznalo
INNER JOIN tartozik ON felhasznalo.id = tartozik.felhasznalo_id
INNER JOIN csoport ON tartozik.csoport_id = csoport.id 
GROUP BY EXTRACT(MONTH FROM felhasznalo.szulido), csoport.csop_nev FETCH FIRST 11 ROWS ONLY");
oci_execute($stmt_szulnap);
$szulnap = [];
while (($row = oci_fetch_array($stmt_szulnap, OCI_ASSOC)) != false) {
    $szulnap[] = $row;
}

$new_arr = [];
foreach ($szulnap as $key => $value) {
    $new_arr[$value["CSOP_NEV"]] = array("HONAP" => $value["HONAP"], "NUM" => $value["NUM"]);
}
$honapok = array_column($new_arr, "HONAP");
$num = array_column($new_arr, "NUM");
?>
<div class="container">
    <h1 class="title mt-6">Tagok</h1>
    <div class="box mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Csoport név:</th>
                    <?php foreach ($table_header as $data) : ?>
                        <td><?php echo $data ?></td>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Tagok száma: </th>
                    <?php foreach ($csop_group as $data) : ?>
                        <td><?php echo $data["COUNT"] ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
    <h1 class="title">Születésnaposok</h1>
    <div class="box mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Csoport név:</th>
                    <?php foreach (array_keys($new_arr) as $data) : ?>
                        <td><?php echo $data ?></td>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Hónap:</th>
                    <?php foreach ($honapok as $data) : ?>
                        <td><?php echo $data; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <th>Születésnaposok száma:</th>
                    <?php foreach ($num as $data) : ?>
                        <td><?php echo $data; ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>


    <h1 class="title mt-6">Csoportok</h1>
    <?php if (!empty($csoportok)) : ?>
        <?php foreach ($csoportok as $csoport) : ?>
            <div id="csop_box" onclick="viewPoszt(<?php echo $csoport['ID'] ?>)" data-id="<?= $csoport["ID"] ?>" class="box">
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
                        <!--<a href="csoportok.php?delete=<?= $csoport["ID"] ?>" class="delete"></a>-->
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div><strong>Nincsenek csoportok.</strong></div>
    <?php endif; ?>
</div>
<script>
    function viewPoszt(csop_id) {
        window.location.href = "viewcsoport.php?csop_id=" + csop_id;
    }
</script>