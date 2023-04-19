<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");
?>

<div class="container">
    <h1 class="title mt-6">Poszt módosítása</h1>
    <div class="field">
        <div class="control">
            <input class="input is-large" type="text" placeholder="Poszt szövege">
        </div>
    </div>
    <div class="columns">
            <div class="column">
                <div class="field mt-5">
                    <button onclick="createPost()" class="button">Poszt módosítása</button>
                </div>
            </div>
</div>