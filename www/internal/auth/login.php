<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../includes/database.php");

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $error = "Veuillez remplir tous les champs.";
    header("Location: ../index.php?error=" . $error);
    exit();
}

if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
    $error = "Veuillez entrer une adresse email valide.";
    header("Location: ../index.php?error=" . $error);
    exit();
}

if (strlen($password) < 3) {
    $error = "Le mot de passe doit contenir au moins 3 caractères.";
    header("Location: ../index.php?error=" . $error);
    exit();
}

$query = "SELECT * FROM disn1imh_v13_compte WHERE email_compte = :email AND mot_de_passe_compte = :password";
$stmt = $conn->prepare($query);
$stmt->execute([':email' => $email, ':password' => $password]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    if ($result['statut_compte'] == 'SUSPENDU') {
        $error = "Votre compte est suspendu";
        header("Location: ../index.php?error=" . $error);
        exit();
    }
    
    $_SESSION['user'] = [
        'id_compte' => $result['id_compte'],
        'email' => $result['email_compte'],
        'privilege' => $result['privilege_compte'],
        'status' => $result['statut_compte']
    ];

    switch ($result['privilege_compte']) {
        case 'ADMIN':
            $table = "disn1imh_v13_medecin_biologiste";
            $colonne = "id_medecin_biologiste";
            $dir = "med";
            break;
        case 'INFIRMIER':
            $table = "disn1imh_v13_infirmier";
            $colonne = "id_infirmier";
            $dir = "infirmier";
            break;
        case 'SECRETAIRE':
            $table = "disn1imh_v13_secretaire";
            $colonne = "id_secretaire";
            $dir = "secretaire";
            break;
    }
    
    $query = "SELECT * FROM {$table} WHERE id_compte = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':id' => $result['id_compte']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['user']['id'] = $result[$colonne];

    header("Location: ../pages/{$dir}/dashboard.php");
    exit();
} else {
    $error = "Identifiants incorrects.";
    header("Location: ../index.php?error=" . $error);
    exit();
}
