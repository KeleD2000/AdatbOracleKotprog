<nav class="navbar is-info" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                Facebook klón
            </a>

            <a role="button" class="navbar-burger nav-toggler" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Kezdőlap
                </a>

                <a class="navbar-item">
                    Documentation
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        More
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
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
                            <a href="#" class="navbar-item">Settings</a>
                            <hr class="navbar-divider" />
                            <a href="logout.php" class="navbar-item">Kilépés</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>