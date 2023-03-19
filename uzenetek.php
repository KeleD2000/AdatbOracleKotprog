<?php
session_start();
if (!isset($_SESSION["login"])) header("location: index.php");

require_once("init.php");
if (!isset($_SESSION["login"]) || !isset($_GET["id"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");
?>

<body>
    <?php include("navbar.php"); ?>
    <?php html_footer(); ?>