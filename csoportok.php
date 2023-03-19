<?php 
session_start();
if(!isset($_SESSION["login"])) header("location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bulma.css">
    <title>Üdvözöllek - <?php echo $_SESSION["kernev"]; ?></title>
</head>
<body>
    <?php include("navbar.php"); ?>
</body>
</html>