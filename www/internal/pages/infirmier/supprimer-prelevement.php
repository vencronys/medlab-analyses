<?php
require("../../includes/database.php");

if (isset($_GET['id'])) {
    $id_prelevement = $_GET['id'];

    $query = "DELETE FROM disn1imh_v13_prelevement_examen WHERE id_prelevement = :id_prelevement";
    $stmt = $conn->prepare($query);
    $stmt->execute([':id_prelevement' => $id_prelevement]);

    $query = "DELETE FROM disn1imh_v13_prelevement WHERE id_prelevement = :id_prelevement";
    $stmt = $conn->prepare($query);
    
    if ($stmt->execute([':id_prelevement' => $id_prelevement])) {
        header("Location: consulter-prelevements.php");
        exit();
    } else {
        echo "Error: Unable to delete the prelevement.";
    }
} else {
    echo "Error: No ID specified.";
}
?>