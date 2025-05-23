<?php
session_start();

require("logger.php");
// Initialize logger
$logger = new Logger();

if (!isset($_SESSION["id_compte"])) {
    header("Location:/medlab-analyses/www/extern/pages/login-form.php");
    exit();
}

if (!isset($_POST["nom_patient"])) {
    header("Location:/medlab-analyses/www/external/pages/modifier-info-form.php");
    exit();
}

$nom_patient = $_POST["nom_patient"];
$prenom_patient = $_POST["prenom_patient"];
$cin_patient = $_POST["cin_patient"];
$date_naissance_patient = $_POST["date_naissance_patient"];
$sexe_patient = $_POST["sexe_patient"];
$adresse_patient = $_POST["adresse_patient"];
$telephone_patient = $_POST["telephone_patient"];
$email_compte = $_POST["email_compte"];
$mot_de_passe_compte = $_POST["mot_de_passe_compte"];
$nouveau_mot_de_passe_compte = $_POST["nouveau_mot_de_passe_compte"];
$confirm_nouveau_mot_de_passe = $_POST["confirm_nouveau_mot_de_passe_compte"];

if (
    empty($nom_patient) || !preg_match("/[A-Za-z ]{3,100}/", $nom_patient) ||
    empty($prenom_patient) || !preg_match("/[A-Za-z ]{3,100}/", $prenom_patient) ||
    empty($cin_patient) || !preg_match('/^[A-Za-z]{1}[0-9]{6}/', $cin_patient) ||
    empty($date_naissance_patient) ||
    empty($sexe_patient) ||
    empty($adresse_patient) ||
    empty($telephone_patient) || !preg_match('/0[0-9]{9}/', $telephone_patient) ||
    empty($email_compte) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email_compte) ||
    empty($mot_de_passe_compte) || !preg_match('/.{3,}/', $mot_de_passe_compte)
    // !preg_match('/.{3,}/', $nouveau_mot_de_passe_compte)
    // $confirm_nouveau_mot_de_passe_compte != $nouveau_mot_de_passe_compte
) {
    $error = "Erreur de validation.";
    $logger->logError("Validation failed during modifying profile informations for email: $email_compte");
    header("Location: /medlab-analyses/www/external/pages/modifier-info-form.php?error=$error");
    exit();
}

require("../includes/database.php");


$stmt = $conn->prepare('SELECT c.mot_de_passe_compte FROM disn1imh_v13_compte c WHERE c.id_compte = :id_compte');
$stmt->execute(
    array(
        ':id_compte' => $_SESSION['id_compte']
    )
);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($mot_de_passe_compte != $data['mot_de_passe_compte']) {
    $error = "Mot de passe incorrect.";
    $logger->logError("Incorrect password during modifying profile informations for email: $email_compte");
    header("Location: /medlab-analyses/www/external/pages/modifier-info-form.php?error=$error");
    exit();
}

$password = (empty($nouveau_mot_de_passe_compte)) ? $mot_de_passe_compte : $nouveau_mot_de_passe_compte;

$query = "UPDATE disn1imh_v13_compte c SET c.email_compte = :email, c.mot_de_passe_compte = :password WHERE c.id_compte = :id_compte";
$stmt = $conn->prepare($query);
$stmt->execute([
    ':email' => $email_compte,
    ':password' => $nouveau_mot_de_passe_compte,
    ':id_compte' => $_SESSION["id_compte"]
]);

$query = "UPDATE disn1imh_v13_patient p SET 
    p.nom_patient = :nom_patient, 
    p.prenom_patient = :prenom_patient, 
    p.cin_patient = :cin_patient, 
    p.date_naissance_patient = :date_naissance_patient, 
    p.sexe_patient = :sexe_patient, 
    p.adresse_patient = :adresse_patient, 
    p.telephone_patient = :telephone_patient 
    WHERE p.id_compte = :id_compte";
$stmt = $conn->prepare($query);
$stmt->execute([
    ':nom_patient' => $nom_patient,
    ':prenom_patient' => $prenom_patient,
    ':cin_patient' => $cin_patient,
    ':date_naissance_patient' => $date_naissance_patient,
    ':sexe_patient' => $sexe_patient,
    ':adresse_patient' => $adresse_patient,
    ':telephone_patient' => $telephone_patient,
    ':id_compte' => $_SESSION["id_compte"]
]);


header("Location: /medlab-analyses/www/external/pages/profile.php?success=1");
exit();
?>
