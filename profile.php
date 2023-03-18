<?php
session_start();
if (!isset($_SESSION["login"]) || !isset($_GET["id"])) header("location: index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Profil oldal - <?php echo $_SESSION["username"]; ?></title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="container">
        <section class="hero boritokep is-link is-medium">
            <div class="hero-body">
            </div>
        </section>
        <figure class="image profil_img is-128x128">
            <img class="is-rounded" style="cursor: pointer" onclick="openModal(this);" src="image/118762740_3176325969119878_1621989540091804071_n.jpg">
        </figure>
        <div class="tabs">
            <ul>
                <li onclick="openTab(event,'bejegyzesek')" class="is-active tab"><a>Bejegyzések</a></li>
                <li class="tab" onclick="openTab(event,'ismerosok')"><a>Ismerősök</a></li>
                <li class="tab" onclick="openTab(event,'fenykepek')"><a>Fényképek</a></li>
                <li class="tab" onclick="openTab(event,'nevjegy')"><a>Névjegy</a></li>
            </ul>
        </div>
        <div class="box content-tab" id="bejegyzesek">
            Bejegyzések
        </div>
        <div class="box content-tab" id="ismerosok" style="display: none">
            Ismerősök
        </div>
        <div class="box content-tab" id="fenykepek" style="display: none">
            Fényképek
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
    <script src="js/modal.js"></script>
</body>

</html>