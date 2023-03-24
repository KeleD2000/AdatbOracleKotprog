<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css./auth.css">
    <script src="js/auth.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="blueBg">
            <div class="box signin">
                <h2>Van már fiókod?</h2>
                <button class="signinBtn">Belépés</button>
            </div>
            <div class="box signup">
                <h2>Nincs még fiókod?</h2>
                <button class="signupBtn">Regisztráció</button>
            </div>
        </div>
        <div class="formBx">
            <div class="form signinForm">
                <form action="signin.php" method="post">
                    <h3>Belépés</h3>
                    <input type="text" name="username" placeholder="felhasználónév" id="">
                    <input type="password" name="password" placeholder="jelszó" id="">
                    <?php if(isset($_GET["error"])): ?>
                        <div class="error"><?php echo $_GET["error"]; ?></div>
                    <?php endif; ?>
                    <input type="submit" name="login" value="Belépés">
                    <a href="#" class="forgot-password">Elfelejtetted a jelszavad?</a>
                </form>
            </div>

            <div class="form signupForm">
                <form action="signup.php" method="post">
                    <h3>Regisztráció</h3>
                    <input type="text" name="kernev" placeholder="keresztnév" id="">
                    <input type="text" name="veznev" placeholder="vezetéknév" id="">
                    <input type="date" name="szulido" placeholder="születési idő" id="">
                    <input type="text" name="username" placeholder="felhasználónév" id="">
                    <input type="text" name="email" placeholder="e-mail cím" id="">
                    <input type="password" name="password" placeholder="jelszó" id="">
                    <input type="password" name="confirm-password" placeholder="jelszó mégegyszer" id="">
                    <?php if(isset($_GET["signup_error"])): ?>
                        <div class="error"><?php echo $_GET["signup_error"]; ?></div>
                    <?php endif; ?>
                    <?php if(isset($_GET["success"])): ?>
                        <div class="success"><?php echo $_GET["success"]; ?></div>
                    <?php endif; ?>
                    <input type="submit" name="signup" value="Regisztráció">
                </form>
            </div>
        </div>
    </div>
</body>
</html>