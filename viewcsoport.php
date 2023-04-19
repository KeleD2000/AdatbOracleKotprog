<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");

$stmt = oci_parse($con, 'SELECT * FROM csoport WHERE id = :csoport_id');
oci_bind_by_name($stmt, ":csoport_id", $_GET["csop_id"]);
oci_execute($stmt);
$csoport = oci_fetch_object($stmt);

$stmt_csopposztok = oci_parse($con, "SELECT * FROM csoport WHERE csoport_id = felhasznalo.csopposzt " )

?>

<body>
    <div class="container">
        <h1 class="title mt-6"><?php echo $csoport->CSOP_NEV?></h1>
        <div class="field">
            <div class="control">
                <textarea style="resize: none;" class="textarea" id="new_poszt"
                    placeholder="Mi jár a fejedben?"></textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field mt-2 is-pulled-left">
                    <p class="control">
                        <button onclick="createPost()" class="button">Poszt létrehozása</button>
                    </p>
                </div>
            </div>
            <div class="column has-text-right">
            </div>
        </div>

        <div id="poszt_box">
            
        </div>
    </div>
    <?php html_footer(); ?>