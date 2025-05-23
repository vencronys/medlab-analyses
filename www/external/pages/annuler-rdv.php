<?php

session_start();

if (!isset($_SESSION["id_compte"])) {
    header("Location:/medlab-analyses/www/external/pages/login-form.php");
    exit();
}

if (!isset($_GET['id_rdv'])) {
    header("Location:/medlab-analyses/www/external/pages/profile.php");
    exit();
}

$id_rdv = $_GET['id_rdv'];

require("../includes/database.php");

$query = "UPDATE disn1imh_v13_rdv SET statut_rdv = 'ANNULE' WHERE id_rdv = :id_rdv";
$stmt = $conn->prepare($query);
$stmt->execute([':id_rdv' => $id_rdv]);

header("Location:/medlab-analyses/www/external/pages/profile.php");
exit();
?>