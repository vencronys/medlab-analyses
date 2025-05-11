<?php
require("conn.php");

if (isset($_GET['id'])) {
    $id_prelevement = $_GET['id'];

    $query = "DELETE FROM prelevement WHERE id_prelevement = :id_prelevement";
    $stmt = $conn->prepare($query);
    
    if ($stmt->execute([':id_prelevement' => $id_prelevement])) {
        header("Location: consulter_prelevements.php");
        exit();
    } else {
        echo "Error: Unable to delete the prelevement.";
    }
} else {
    echo "Error: No ID specified.";
}
?>
