<?php
session_start();

if (isset($_POST['id_compte'])) {
    header("Location:/medlab-analyses/www/external/index.php?id_compte=" . $_POST['id_compte']);
    exit();
}

require("logger.php");

// Initialize logger
$logger = new Logger();

// Log form access
if (isset($_SESSION['id_compte'])) {
    $logger->log('FORM_ACCESS', $_SESSION['id_compte'], 'Accessed login form');
} else {
    $logger->log('FORM_ACCESS', null, 'Guest accessed login form');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/medlab-analyses/www/external/css/main.css">
    <link rel="stylesheet" href="/medlab-analyses/www/external/css/pages/login-form.css">
</head>

<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>
    <div class="login-container">
        <div class="login-box">
            <h1>Connexion</h1>
            <form class="login-form" method="post" action="login.php">
                <div class="form-group">
                    <label for="email">
                        <i class="fa-solid fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fa-solid fa-lock"></i>
                        Mot de passe
                    </label>
                    <input type="password" id="password" name="password" required pattern=".{3,}">
                </div>

                <div class="form-group remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="login-button">
                    <i class="fa-solid fa-sign-in-alt"></i>
                    Se connecter
                </button>

                <div class="form-links">
                    <a href="#">Mot de passe oublié?</a>
                    <a href="./signup-form.php">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>
    <?php
    include '../includes/contact.php';
    include '../includes/footer.php';
    ?>
</body>

</html>