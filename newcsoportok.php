<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Csoportok");
include("navbar.php");
?>

<div class="container">
    <h1 class="title mt-6">Csoport létrehozása</h1>
    <div class="field">
        <div class="control">
            <label>Csoport neve</label>
            <input class="input is-large" type="text" placeholder="Csoport neve">
        </div>
    </div>
    <div class="control">
        <label>Csoport leírása</label>
        <input class="input is-large" type="text" placeholder="Csoport leírása">
    </div>
    <div class="columns">
            <div class="column mt-5">
                <div class="field mt-5">
                    <button onclick="createPost()" class="button">Csoport létrehozása</button>
                </div>
            </div>
</div>