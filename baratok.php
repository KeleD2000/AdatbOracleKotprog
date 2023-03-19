<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöljük");
include("navbar.php");
?>
<div class="container">
    <h1 class="title mt-3">Kit ismerhetek?</h1>
    <div class="columns">
        <div class="column">
            <div class="card mt-5">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-96x96">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">Rudnai Roland</p>
                            <p class="subtitle is-6">@király</p>
                        </div>
                    </div>
                    <div class="content has-text-right">
                        <button class="button is-info">Hozzáad</button>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-96x96">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">Kopunovics Krisztián</p>
                            <p class="subtitle is-6">@agrafikus</p>
                        </div>
                    </div>
                    <div class="content has-text-right">
                        <button class="button is-info">Hozzáad</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card mt-5">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-96x96">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">John Smith</p>
                            <p class="subtitle is-6">@johnsmith</p>
                        </div>
                    </div>
                    <div class="content has-text-right">
                        <button class="button is-info">Hozzáad</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card mt-5">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-96x96">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">John Smith</p>
                            <p class="subtitle is-6">@johnsmith</p>
                        </div>
                    </div>
                    <div class="content has-text-right">
                        <button class="button is-info">Hozzáad</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php html_footer(); ?>