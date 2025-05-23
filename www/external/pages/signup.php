<?php
session_start();

require("../includes/database.php");
require("logger.php");

// Initialize logger
$logger = new Logger();

if (isset($_POST["id_compte"])) {
    header("Location:/medlab-analyses/www/external/index.php");
    exit();
}

if (
    !isset($_POST['nom_patient']) ||
    !isset($_POST['prenom_patient']) ||
    !isset($_POST['cin_patient']) ||
    !isset($_POST['date_naissance_patient']) ||
    !isset($_POST['sexe_patient']) ||
    !isset($_POST['adresse_patient']) ||
    !isset($_POST['telephone_patient']) ||
    !isset($_POST['email_compte']) ||
    !isset($_POST['mot_de_passe_compte']) ||
    !isset($_POST['confirm_password'])
) {
    $error = "Veuillez remplir tous les champs.";
    $logger->logError("Missing required signup fields");
    header("Location:/medlab-analyses/www/external/pages/signup-form.php?error=$error");
    exit();
}

$nom_patient = $_POST['nom_patient'];
$prenom_patient = $_POST['prenom_patient'];
$cin_patient = $_POST['cin_patient'];
$date_naissance_patient = $_POST['date_naissance_patient'];
$sexe_patient = $_POST['sexe_patient'];
$adresse_patient = $_POST['adresse_patient'];
$telephone_patient = $_POST['telephone_patient'];
$email_compte = $_POST['email_compte'];
$mot_de_passe_compte = $_POST['mot_de_passe_compte'];
$confirm_password = $_POST['confirm_password'];

if (
    empty($nom_patient) || !preg_match("/[a-zA-Z ]{3,100}/", $nom_patient) ||
    empty($prenom_patient) || !preg_match("/[A-Za-z ]{3,100}/", $prenom_patient) ||
    empty($cin_patient) || !preg_match('/[A-Za-z0-9]{7}/', $cin_patient) ||
    empty($date_naissance_patient) ||
    empty($sexe_patient) ||
    empty($adresse_patient) ||
    empty($telephone_patient) || !preg_match('/0[0-9]{9}/', $telephone_patient) ||
    empty($email_compte) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email_compte) ||
    empty($mot_de_passe_compte) || !preg_match('/.{3,255}/', $mot_de_passe_compte) ||
    empty($confirm_password) || $confirm_password != $mot_de_passe_compte
) {
    $error = "Erreur de validation.";
    $logger->logError("Validation failed during signup for email: $email_compte");
    header("Location: /medlab-analyses/www/external/pages/signup-form.php?error=$error");
    exit();
}

$query = "INSERT INTO disn1imh_v13_compte (email_compte, mot_de_passe_compte, privilege_compte) VALUES (:email, :password, 'patient')";
$stmt = $conn->prepare($query);
$stmt->execute([':email' => $email_compte, ':password' => $mot_de_passe_compte]);

// Get the new account ID
$id_compte = $conn->lastInsertId();

$query = "INSERT INTO disn1imh_v13_patient (nom_patient, prenom_patient, cin_patient, date_naissance_patient, sexe_patient, adresse_patient, telephone_patient, id_compte) 
          VALUES (:nom, :prenom, :cin, :date_naissance, :sexe, :adresse, :telephone, :id_compte)";
$stmt = $conn->prepare($query);
$stmt->execute([
    ':nom' => $nom_patient,
    ':prenom' => $prenom_patient,
    ':cin' => $cin_patient,
    ':date_naissance' => $date_naissance_patient,
    ':sexe' => $sexe_patient,
    ':adresse' => $adresse_patient,
    ':telephone' => $telephone_patient,
    ':id_compte' => $id_compte
]);

// Log successful signup
$logger->logSignup($id_compte);

header("Location: /medlab-analyses/www/external/pages/login-form.php?success=1");
exit();
?>