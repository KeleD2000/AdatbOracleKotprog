<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");
?>
<body>
    <div class="container">
        <h1 class="title mt-3">Hírfolyam</h1>
        <div class="field">
            <div class="control">
                <textarea style="resize: none;" class="textarea" placeholder="Poszt írása..."></textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field mt-2 is-pulled-left">
                    <p class="control">
                        <button class="button">Poszt létrehozása</button>
                    </p>
                </div>
            </div>
            <div class="column has-text-right">
                <div class="select is-pulled-right">
                    <select>
                        <option>Select dropdown</option>
                        <option>With options</option>
                    </select>
                </div>
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
                            <strong>PistaBa</strong> <small>@pistaba</small> <small>31m</small>
                            <br>
                            Nem nagyon vagom hogy mi ez az egesz, te tuti rudi hogy vicces lesz majd ha ezt elolvasod, es nem az eredeti szoveget talalod
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
    </div>
    <?php html_footer(); ?>