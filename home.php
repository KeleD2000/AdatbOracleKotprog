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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Üdvözöllek - <?php echo $_SESSION["kernev"]; ?></title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <section class="container">
        <h1 class="title mt-3">Hírfolyam</h1>

        <div class="field">
            <div class="control">
                <textarea style="resize: none;" class="textarea" placeholder="Poszt írása..."></textarea>
            </div> 
        </div>

        <div class="m-4">
            
            <div class="field mt-2 is-pulled-left">
                <p class="control">
                     <button class="button">Poszt létrehozása</button>
                </p>
            </div>

            <div class="select is-pulled-right">
                <select>
                    <option>Select dropdown</option>
                    <option>With options</option>
                </select>
            </div>

        </div>

        <div class="box">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-64x64">
                        <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa
                            fringilla egestas. Nullam condimentum luctus turpis.
                        </p>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-left">
                            <a class="level-item" aria-label="retweet">
                                <span class="icon is-small">
                                    <i class="fa-regular fa-heart"></i>
                                </span>
                            </a>
                            <a class="level-item" aria-label="like">
                                <span class="icon is-small">
                                    <i class="fa-solid fa-heart"></i>
                                </span>
                            </a>
                            <a class="level-item" aria-label="like" href="komment.php">
                                <span class="icon is-small">
                                  <i class="fa-regular fa-comment"></i>
                                </span>
                            </a>
                            <a class="level-item" aria-label="like" href="komment.php">
                                <span class="icon is-small">
                                  <i class="fa-regular fa-pen-to-square"></i>
                                </span>
                            </a>
                        </div>
                    </nav>
                </div>
            </article>
        </div>

    </section>
</body>

</html>