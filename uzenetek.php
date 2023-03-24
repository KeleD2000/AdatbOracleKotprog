<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");
?>
    <?php html_footer(); ?>