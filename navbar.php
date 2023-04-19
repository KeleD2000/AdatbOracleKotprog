<nav class="navbar is-info is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="container has-text-weight-semibold">
        <div class="navbar-brand">
            
                <img src="image/brand-removebg-preview.png" alt="logo" width="140" height="28">
            
            <a role="button" class="navbar-burger nav-toggler" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                 <a class="navbar-item" href="home.php">
                    Kezdőlap
                 </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a href="#" class="navbar-link">
                        Csoportok
                    </a>
                    <div class="navbar-dropdown is-right">
                        <a href="newcsoportok.php" class="navbar-item">
                            Új csoport létrehozása
                        </a>
                        <a href="csoportok.php" class="navbar-item">
                            Meglévő csoportok
                        </a>
                        <a href="sajatcsoportok.php" class="navbar-item">
                            Saját csoportjaim
                        </a>
                    </div>
                </div>

                <a class="navbar-item" href="baratok.php">
                    Barátok
                </a>

                <a class="navbar-item" href="uzenetek.php">
                    Üzenetek
                </a>

            </div>

            <div class="navbar-end">
                <?php if (!empty($_SESSION) && isset($_SESSION["login"])) : ?>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a href="#" class="navbar-link">
                            <?php echo $_SESSION["username"]; ?>
                        </a>
                        <div class="navbar-dropdown is-right">
                            <a href="profile.php?id=<?php echo $_SESSION['id'] ?>" class="navbar-item">
                                Profil
                            </a>
                            <a href="logout.php" class="navbar-item">Kilépés</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>