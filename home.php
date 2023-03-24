<?php
require_once("init.php");
if (!isset($_SESSION["login"])) header("location: index.php");
html_header("Üdvözöllek");
include("navbar.php");
?>
<body>
    <div class="container">
        <h1 class="title mt-6">Hírfolyam</h1>
        <div class="field">
            <div class="control">
                <textarea style="resize: none;" class="textarea" id="new_poszt" placeholder="Mi jár a fejedben?"></textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field mt-2 is-pulled-left">
                    <p class="control">
                        <button onclick="createPost()" class="button">Poszt létrehozása</button>
                    </p>
                </div>
            </div>
            <div class="column has-text-right">
                <form action="">
                    <div class="select is-pulled-right">
                        <select name="poszt_select">
                            <option value="0">Összes poszt</option>
                            <option value="<?php echo $_SESSION["id"] ?>">Saját posztok</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div id="poszt_box" class="box">
            
        </div>
    </div>
    <?php html_footer(); ?>