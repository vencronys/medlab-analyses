<?php
session_start();
if (isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = new PDO("mysql:host=localhost;dbname=DISN1IMH_V1", "root", "");
    $stmt = $conn->prepare("DELETE FROM employes WHERE id = ? AND id_medecin = ?");
    $stmt->execute([$id, $_SESSION['medecin_id']]);
}

header('Location: liste_employes.php?success=supprimer');
exit();
