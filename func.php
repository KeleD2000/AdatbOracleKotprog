<?php 

function html_header($title){
    echo '<!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bulma.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link rel="icon" type="image/x-icon" href="image/icon.png">
        <title>'.$title.' - '.$_SESSION["kernev"].'</title>
    </head>
    
    <body>';
}

function html_footer(){
    echo '<script src="js/modal.js"></script>
    <script src="js/navbar.js"></script>
    </body>
    </html>';
}




?>