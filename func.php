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
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/poszt.js"></script>
    <script src="js/message.js"></script>
    <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
      <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
      is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
    </p>
  </div>
</footer>
    </body>
    </html>';
}




?>