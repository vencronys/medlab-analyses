<?php
require("conn.php");

$volume_ml = $statut_prelevement = $date_prelevement = $id_stock = $id_patient = $id_infirmier = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $volume_ml = $_POST["volume_ml"];
    $statut_prelevement = $_POST["statut_prelevement"];
    $date_prelevement = $_POST["date_prelevement"];
    $id_stock = $_POST["id_stock"];
    $id_patient = $_POST["id_patient"];
    $id_infirmier = $_POST["id_infirmier"];

    // Vérifier si le volume est valide (positif et non nul)
    if ($volume_ml <= 0) {
        $error_message = "<div class='alert alert-danger'>Le volume doit être supérieur à zéro. Veuillez entrer une valeur valide pour le volume.</div>";
    }

    // Vérifier si la date de prélèvement est dans le futur
    $current_date = date("Y-m-d H:i:s");
    if ($date_prelevement < $current_date) {
        $error_message = "<div class='alert alert-danger'>La date du prélèvement ne peut pas être dans le passé. Veuillez entrer une date valide.</div>";
    }

    // Vérifier si un prélèvement existe déjà pour ce patient et ce stock
    $query_check = "SELECT * FROM prelevement WHERE id_patient = :id_patient AND id_stock = :id_stock AND date_prelevement = :date_prelevement";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->execute([
        ':id_patient' => $id_patient,
        ':id_stock' => $id_stock,
        ':date_prelevement' => $date_prelevement
    ]);

    if ($stmt_check->rowCount() > 0) {
        $error_message = "<div class='alert alert-danger'>Un prélèvement existe déjà pour ce patient et ce stock à cette date. Veuillez vérifier les informations et réessayer.</div>";
    }

    // Si toutes les conditions sont remplies et pas d'erreurs
    if (empty($error_message)) {
        $query = "INSERT INTO prelevement (volume_ml, statut_prelevement, date_prelevement, id_stock, id_patient, id_infirmier)
                  VALUES (:volume_ml, :statut_prelevement, :date_prelevement, :id_stock, :id_patient, :id_infirmier)";
        
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':volume_ml' => $volume_ml,
            ':statut_prelevement' => $statut_prelevement,
            ':date_prelevement' => $date_prelevement,
            ':id_stock' => $id_stock,
            ':id_patient' => $id_patient,
            ':id_infirmier' => $id_infirmier
        ]);

        if ($stmt->rowCount() > 0) {
            // Redirection après l'ajout réussi
            header("Location: consulter_prelevements.php?success=1");
            exit();
        } else {
            $error_message = "<div class='alert alert-danger'>Une erreur s'est produite lors de l'ajout du prélèvement. Veuillez réessayer.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Prélèvement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un Prélèvement</h2>
        
        <?php echo $error_message; ?>

        <form action="ajouter_prelevement.php" method="post">
            <div class="mb-3">
                <label for="volume_ml" class="form-label">Volume (ml)</label>
                <input type="number" step="0.01" class="form-control" id="volume_ml" name="volume_ml" value="<?php echo $volume_ml; ?>" required>
            </div>

            <div class="mb-3">
                <label for="statut_prelevement" class="form-label">Statut du prélèvement</label>
                <select name="statut_prelevement" class="form-select" required>
                    <option value="">Sélectionner le statut</option>
                    <option value="En attente" <?php echo ($statut_prelevement == 'En attente') ? 'selected' : ''; ?>>En attente</option>
                    <option value="Effectué" <?php echo ($statut_prelevement == 'Effectué') ? 'selected' : ''; ?>>Effectué</option>
                    <option value="Annulé" <?php echo ($statut_prelevement == 'Annulé') ? 'selected' : ''; ?>>Annulé</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_prelevement" class="form-label">Date du prélèvement</label>
                <input type="datetime-local" class="form-control" id="date_prelevement" name="date_prelevement" value="<?php echo $date_prelevement; ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_stock" class="form-label">Stock</label>
                <select name="id_stock" class="form-select" required>
                    <option value="">Sélectionner un stock</option>
                    <?php
                    $query_stocks = "SELECT id_stock, nom_stock FROM stock ORDER BY nom_stock";
                    $stmt_stocks = $conn->prepare($query_stocks);
                    $stmt_stocks->execute();
                    $stocks = $stmt_stocks->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($stocks as $stock) {
                        echo "<option value='" . $stock['id_stock'] . "' " . ($id_stock == $stock['id_stock'] ? 'selected' : '') . ">" . $stock['nom_stock'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_patient" class="form-label">Patient</label>
                <select name="id_patient" class="form-select" required>
                    <option value="">Sélectionner un patient</option>
                    <?php
                    $query_patients = "SELECT id_patient, nom_patient, prenom_patient FROM patient ORDER BY nom_patient";
                    $stmt_patients = $conn->prepare($query_patients);
                    $stmt_patients->execute();
                    $patients = $stmt_patients->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($patients as $patient) {
                        echo "<option value='" . $patient['id_patient'] . "' " . ($id_patient == $patient['id_patient'] ? 'selected' : '') . ">" . $patient['nom_patient'] . " " . $patient['prenom_patient'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_infirmier" class="form-label">Infirmier</label>
                <select name="id_infirmier" class="form-select" required>
                    <option value="">Sélectionner un infirmier</option>
                    <?php
                    $query_infirmiers = "SELECT id_infirmier, nom_infirmier, prenom_infirmier FROM infirmier ORDER BY nom_infirmier";
                    $stmt_infirmiers = $conn->prepare($query_infirmiers);
                    $stmt_infirmiers->execute();
                    $infirmiers = $stmt_infirmiers->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($infirmiers as $infirmier) {
                        echo "<option value='" . $infirmier['id_infirmier'] . "' " . ($id_infirmier == $infirmier['id_infirmier'] ? 'selected' : '') . ">" . $infirmier['nom_infirmier'] . " " . $infirmier['prenom_infirmier'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter Prélèvement</button>
        </form>
    </div>
</body>
</html>
