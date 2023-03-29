<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöljük");

include("navbar.php");

// Barátok lekérdezése
$sql = "SELECT felhasznalo.* FROM kapcsolat INNER JOIN baratok ON kapcsolat.baratok_userid = baratok.id INNER JOIN felhasznalo ON baratok.userid = felhasznalo.id WHERE kapcsolat.felhasznalo_id = :userid";
$baratok_stid = oci_parse($con, $sql);
oci_bind_by_name($baratok_stid, ":userid", $_SESSION["id"]);
oci_execute($baratok_stid);
?>
<input type="hidden" name="" value="<?php echo $_SESSION["id"] ?>" id="logged_user_id">
<div class="container">
    <div class="columns">
        <div class="column is-one-third">
            <h1 class="title mt-6">Barátok</h1>
            <div class="box" id="friend_box">
                <?php while (($row = oci_fetch_array($baratok_stid, OCI_ASSOC)) != false) : ?>
                    <div id="message" class="media friend" data-id="<?php echo $row["ID"]; ?>">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="<?php echo (!is_null($row["KEP"])) ? "uploads/" . $row["KEP"] : "images/profileavatar.webp" ?>">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-4">
                                    <?php echo $row["KERNEV"] . " " . $row["VEZNEV"]; ?>
                                </p>
                                <?php 
                                    $last_message_stmt = oci_parse($con, "SELECT uzenet.tartalom FROM uzenet, uzenetkuldes WHERE uzenet.id = uzenetkuldes.uzenet_id AND uzenetkuldes.kuldo = :kuldo_id AND uzenetkuldes.fogado = :fogado_id FETCH FIRST 1 ROWS ONLY");
                                    oci_bind_by_name($last_message_stmt, ":kuldo_id", $row["ID"]);
                                    oci_bind_by_name($last_message_stmt, ":fogado_id", $_SESSION["id"]);
                                    oci_execute($last_message_stmt);
                                    while (($row = oci_fetch_array($last_message_stmt, OCI_ASSOC)) != false) {
                                        $substring = substr($row["TARTALOM"], 0, 20) . "....";
                                        echo "<p class='subtitle is-6'>" . $substring . "</p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="column" id="message_column">
            
        </div>
    </div>
</div>

<?php
html_footer();
?>