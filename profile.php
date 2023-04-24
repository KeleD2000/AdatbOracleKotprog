<?php
require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["id"])) header("location: index.php");
html_header("Profil");
include("navbar.php");

$user_stmt = oci_parse($con, "SELECT * FROM felhasznalo WHERE id = :id");
oci_bind_by_name($user_stmt, ":id", $_SESSION["id"]);
oci_execute($user_stmt);
$user = oci_fetch_object($user_stmt);

$baratok_stmt = oci_parse($con, "SELECT baratok.datum, COUNT(*) as count FROM baratok 
INNER JOIN kapcsolat ON baratok.id = kapcsolat.baratok_userid
WHERE kapcsolat.felhasznalo_id = :felhasz_id
GROUP BY baratok.datum
");
oci_bind_by_name($baratok_stmt, ":felhasz_id", $_SESSION["id"]);
oci_execute($baratok_stmt);

$baratok_stat = [];
while (($row = oci_fetch_array($baratok_stmt, OCI_ASSOC)) != false) {
    $baratok_stat[] = $row;
}

echo "<pre>" . print_r($baratok_stat, true) . "</pre>";

$datum = array_column($baratok_stat, "DATUM");
$count = array_column($baratok_stat, "COUNT");

?>
<div class="container" style="margin-top: 120px">
    <figure class="image profil_img is-128x128">
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
            <li class="tab is-active" onclick="openTab(event,'ismerosok')"><a>Ismerősök</a></li>
            <li class="tab" onclick="openTab(event,'nevjegy')"><a>Névjegy</a></li>
        </ul>
    </div>
    <div class="box content-tab" id="ismerosok">
        <h1 class="title is-4">Ismerősök száma adott napon</h1>
        <div class="box">
            <table class="table" style="width: 100%">
                <tbody>
                    <tr>
                        <th>Hónap:</th>
                        <?php foreach ($datum as $data) : ?>
                            <td><?php echo date("Y-m-d", strtotime($data)); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th>Ismerősök száma:</th>
                        <?php foreach ($count as $data) : ?>
                            <td><?php echo $data; ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php include("barat_list.php"); ?>
    </div>
    <div class="box content-tab" id="nevjegy" style="display: none">
        <form action="update_user_data.php" method="post">
            <div class="container">
                <div class="field">
                    <div class="control">
                        <label>Vezetéknév</label>
                        <input class="input" name="veznev" value="<?php echo $user->VEZNEV ?>" type="text">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Keresztnév</label>
                        <input class="input" name="kernev" value="<?php echo $user->KERNEV ?>" type="text">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Születési idő</label>
                        <input class="input" name="szulido" value="<?php echo date("Y-m-d", strtotime($user->SZULIDO)) ?>" type="date">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Felhasználónév</label>
                        <input class="input" name="felhasznalonev" value="<?php echo $user->FELHASZNALONEV ?>" type="text">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Jelszó</label>
                        <input class="input" name="jelszo" value="<?php echo $user->JELSZO ?>" type="password">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Email</label>
                        <input class="input" name="email" value="<?php echo $user->EMAIL ?>" type="text">
                    </div>
                </div>
                <div class="columns">
                    <div class="column mt-5">
                        <div class="field mt-5">
                            <button type="submit" name="edit_user" class="button">Módosítás</button>
                        </div>
                    </div>
                </div>
        </form>
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