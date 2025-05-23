<?php
session_start();

if (isset($_SESSION['id_compte'])) {
    header("Location: /medlab-analyses/www/external/index.php");
    exit();
}

require("../includes/database.php");
require("logger.php");

// Initialize logger
$logger = new Logger();

if (!isset($_POST['email']) && !isset($_POST['password'])) {
    header("Location: /medlab-analyses/www/external/pages/login-form.php");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $error = "Veuillez remplir tous les champs.";
    $logger->logError("Empty login fields attempted");
    header("Location: /medlab-analyses/www/external/pages/login-form.php?error=$error");
    exit();
}

if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
    $error = "Veuillez entrer une adresse email valide.";
    $logger->logError("Invalid email format: $email");
    header("Location: /medlab-analyses/www/external/pages/login-form.php?error=$error");
    exit();
}

if (strlen($password) < 3) {
    $error = "Le mot de passe doit contenir au moins 3 caractères.";
    $logger->logError("Password too short");
    header("Location: /medlab-analyses/www/external/pages/login-form.php?error=$error");
    exit();
}

$query = "SELECT c.id_compte, c.statut_compte FROM disn1imh_v13_compte c WHERE c.email_compte = :email AND mot_de_passe_compte = :password";
$stmt = $conn->prepare($query);
$stmt->execute([':email' => $email, ':password' => $password]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    if ($result[0]['statut_compte'] == 'SUSPENDU') {
        $error = "Votre compte est suspendu";
        $logger->logLogin($result[0]['id_compte'], false);
        header("Location: /medlab-analyses/www/external/pages/login-form.php?error=$error");
        exit();
    }
    $id_compte = $result[0]['id_compte'];
    $_SESSION['statut_compte'] = $result[0]['statut_compte'];
    $_SESSION['id_compte'] = $id_compte;
    $_SESSION['email_compte'] = $email;
    $logger->logLogin($id_compte, true);
    header("Location: /medlab-analyses/www/external/index.php?id_compte=".$id_compte);
    exit();
} else {
    $logger->logLogin(null, false);
    $error = "Identifiants incorrects.";
    header("Location: /medlab-analyses/www/external/pages/login-form.php?error=$error");
    exit();
}
?>