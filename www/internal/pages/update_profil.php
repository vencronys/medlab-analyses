<?php
require("conn.php");
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_infirmier = $_SESSION["id_infirmier"];
    $nom_infirmier = $_POST["nom_infirmier"];
    $prenom_infirmier = $_POST["prenom_infirmier"];
    $cin_infirmier = $_POST["cin_infirmier"];
    $date_naissance_infirmier = $_POST["date_naissance_infirmier"];
    $sexe_infirmier = $_POST["sexe_infirmier"];
    $adresse_infirmier = $_POST["adresse_infirmier"];
    $telephone_infirmier = $_POST["telephone_infirmier"];
    $statut_infirmier = $_POST["statut_infirmier"];
    $date_embauche_infirmier = $_POST["date_embauche_infirmier"];

    if (empty($nom_infirmier) || empty($prenom_infirmier) || empty($cin_infirmier) || empty($adresse_infirmier) || empty($telephone_infirmier)) {
        echo "Tous les champs obligatoires doivent être remplis.";
        exit();
    }

    if (!preg_match("/^[0-9]{10}$/", $telephone_infirmier)) {
        echo "Le numéro de téléphone doit comporter 10 chiffres.";
        exit();
    }

    $query = "UPDATE infirmier SET 
                nom_infirmier = :nom_infirmier,
                prenom_infirmier = :prenom_infirmier,
                cin_infirmier = :cin_infirmier,
                date_naissance_infirmier = :date_naissance_infirmier,
                sexe_infirmier = :sexe_infirmier,
                adresse_infirmier = :adresse_infirmier,
                telephone_infirmier = :telephone_infirmier,
                statut_infirmier = :statut_infirmier,     
                date_embauche_infirmier = :date_embauche_infirmier
              WHERE id_infirmier = :id_infirmier";

    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':id_infirmier' => $id_infirmier,
        ':nom_infirmier' => $nom_infirmier,
        ':prenom_infirmier' => $prenom_infirmier,
        ':cin_infirmier' => $cin_infirmier,
        ':date_naissance_infirmier' => $date_naissance_infirmier,
        ':sexe_infirmier' => $sexe_infirmier,
        ':adresse_infirmier' => $adresse_infirmier,
        ':telephone_infirmier' => $telephone_infirmier,
        ':statut_infirmier' => $statut_infirmier,
        ':date_embauche_infirmier' => $date_embauche_infirmier
    ]);

    // Si la mise à jour est réussie, stocke un message de succès dans la session
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = 'Profil modifié avec succès.';
    } else {
        $_SESSION['message'] = 'Aucune modification effectuée.';
    }

    // Redirige vers le profil de l'infirmier avec le message
    header("Location: profil_infirmier.php");
    exit();
}
?>
