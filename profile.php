<?php
require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["id"])) header("location: index.php");
html_header("Profil");
include("navbar.php");

$user_stmt = oci_parse($con, "SELECT * FROM felhasznalo WHERE id = :id");
oci_bind_by_name($user_stmt, ":id", $_SESSION["id"]);
oci_execute($user_stmt);
$user = oci_fetch_object($user_stmt);
?>
<div class="container">
    <section class="hero boritokep is-link is-medium">
        <div class="hero-body">
        </div>
    </section>
    <figure class="image profil_img is-128x128">
        <!-- 
            TODO: Oracle karakterkódolást meg kell oldalni.
        -->
        <img class="is-rounded" style="cursor: pointer" onclick="openModal(this);" src="<?php echo (!empty($user->KEP)) ? "uploads/" . $user->KEP : "image/profileavatar.webp"; ?>">
    </figure>
    <form action="upload_image.php" method="POST" enctype="multipart/form-data">
        <div class="file" style="display: flex; justify-content: center; bottom: 50px;">
            <label class="file-label">
                <input class="file-input" type="file" name="kep" onchange="this.form.submit();">
                <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Tölts fel képet
                    </span>
                </span>
            </label>
        </div>
    </form>
    <?php if (isset($_GET["error"])) : ?>
        <p><?php echo $_GET["error"]; ?></p>
    <?php endif; ?>
    <div class="tabs">
        <ul>
            <li onclick="openTab(event,'bejegyzesek')" class="is-active tab"><a>Bejegyzések</a></li>
            <li class="tab" onclick="openTab(event,'ismerosok')"><a>Ismerősök</a></li>
            <li class="tab" onclick="openTab(event,'nevjegy')"><a>Névjegy</a></li>
        </ul>
    </div>
    <div class="box content-tab" id="bejegyzesek">
        Bejegyzések
    </div>
    <div class="box content-tab" id="ismerosok" style="display: none">
        <?php include("barat_list.php"); ?>
    </div>
    <div class="box content-tab" id="nevjegy" style="display: none">
        Névjegy
    </div>
    <div id="modal1" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <p class="image is-1by1">
                <img src="" id="modal-img" alt="GeeksforGeeks Logo">
            </p>
        </div>
        <button class="modal-close is-large" aria-label="close">
        </button>
    </div>
</div>
<?php html_footer(); ?>