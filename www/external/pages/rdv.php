<?php
session_start();

require("../includes/database.php");
require("logger.php");

// Initialize logger
$logger = new Logger();

if (!isset($_SESSION["id_compte"])) {
    header("Location:/medlab-analyses/www/external/pages/login-form.php");
    exit();
}

if (
    !isset($_POST['date_rdv']) ||
    !isset($_POST['motif_rdv'])
) {
    $error = "Veuillez remplir tous les champs.";
    $logger->logError("Missing required booking fields");
    header("Location:/medlab-analyses/www/external/pages/rdv-form.php?error=$error");
    exit();
}

$date_rdv = $_POST['date_rdv'];
$motif_rdv = $_POST['motif_rdv'];

$email_compte = $_SESSION['email_compte'];

if (
    empty($date_rdv) ||
    empty($motif_rdv)
) {
    $error = "Erreur de validation. champs vides";
    $logger->logError("Validation failed during booking for email: $email_compte");
    header("Location: /medlab-analyses/www/external/pages/rdv-form.php?error=$error");
    exit();
}

$query = "INSERT INTO disn1imh_v13_rdv (date_rdv, motif_rdv, id_patient, id_secretaire) VALUES (:date_rdv, :motif_rdv, (SELECT id_patient FROM disn1imh_v13_patient WHERE id_compte = :id_compte), 1)";
$stmt = $conn->prepare($query);
$stmt->execute([':date_rdv' => $date_rdv, ':motif_rdv' => $motif_rdv, ':id_compte' => $_SESSION["id_compte"]]);

// Log successful appointment booking
$logger->log('APPOINTMENT_BOOKING', $_SESSION["id_compte"], "New appointment booked for date: $date_rdv");

header("Location: /medlab-analyses/www/external/pages/profile.php?success=1");
exit();
?>