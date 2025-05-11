<?php
require("conn.php");

// Fetch the prelevement data if the ID is provided
if (isset($_GET['id'])) {
    $id_prelevement = $_GET['id'];
    
    // Fetch the existing prelevement data from the database
    $query = "SELECT * FROM prelevement WHERE id_prelevement = :id_prelevement";
    $stmt = $conn->prepare($query);
    $stmt->execute([':id_prelevement' => $id_prelevement]);
    $prelevement = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If no prelevement is found
    if (!$prelevement) {
        echo "<div class='alert alert-danger'>Erreur : Le prélèvement n'a pas été trouvé.</div>";
        exit();
    }
}

// Process the form submission
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
        echo "<div class='alert alert-danger'>Le volume doit être supérieur à zéro. Veuillez entrer une valeur valide pour le volume.</div>";
        exit();
    }

    // Vérifier si la date de prélèvement est dans le futur
    $current_date = date("Y-m-d H:i:s");
    if ($date_prelevement < $current_date) {
        echo "<div class='alert alert-danger'>La date du prélèvement ne peut pas être dans le passé. Veuillez entrer une date valide.</div>";
        exit();
    }

    // Vérifier si un prélèvement existe déjà pour ce patient et ce stock
    $query_check = "SELECT * FROM prelevement WHERE id_patient = :id_patient AND id_stock = :id_stock AND date_prelevement = :date_prelevement AND id_prelevement != :id_prelevement";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->execute([
        ':id_patient' => $id_patient,
        ':id_stock' => $id_stock,
        ':date_prelevement' => $date_prelevement,
        ':id_prelevement' => $id_prelevement
    ]);

    if ($stmt_check->rowCount() > 0) {
        echo "<div class='alert alert-danger'>Un autre prélèvement existe déjà pour ce patient et ce stock à cette date. Veuillez vérifier les informations et réessayer.</div>";
        exit();
    }

    // Si toutes les conditions sont remplies, on peut procéder à la mise à jour
    $query = "UPDATE prelevement SET 
                volume_ml = :volume_ml, 
                statut_prelevement = :statut_prelevement, 
                date_prelevement = :date_prelevement, 
                id_stock = :id_stock, 
                id_patient = :id_patient, 
                id_infirmier = :id_infirmier 
              WHERE id_prelevement = :id_prelevement";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':volume_ml' => $volume_ml,
        ':statut_prelevement' => $statut_prelevement,
        ':date_prelevement' => $date_prelevement,
        ':id_stock' => $id_stock,
        ':id_patient' => $id_patient,
        ':id_infirmier' => $id_infirmier,
        ':id_prelevement' => $id_prelevement
    ]);

    if ($stmt->rowCount() > 0) {
        echo "<div class='alert alert-success'>Prélèvement mis à jour avec succès !</div>";
        header("Location: consulter_prelevements.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Une erreur s'est produite lors de la mise à jour du prélèvement. Veuillez réessayer.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Prélèvement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un Prélèvement</h2>
        <form action="edit_prelevement.php?id=<?php echo $id_prelevement; ?>" method="post">
            <div class="mb-3">
                <label for="volume_ml" class="form-label">Volume (ml)</label>
                <input type="number" step="0.01" class="form-control" id="volume_ml" name="volume_ml" value="<?php echo $prelevement['volume_ml']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="statut_prelevement" class="form-label">Statut du prélèvement</label>
                <select name="statut_prelevement" class="form-select" required>
                    <option value="">Sélectionner le statut</option>
                    <option value="En attente" <?php echo ($prelevement['statut_prelevement'] == 'En attente') ? 'selected' : ''; ?>>En attente</option>
                    <option value="Effectué" <?php echo ($prelevement['statut_prelevement'] == 'Effectué') ? 'selected' : ''; ?>>Effectué</option>
                    <option value="Annulé" <?php echo ($prelevement['statut_prelevement'] == 'Annulé') ? 'selected' : ''; ?>>Annulé</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_prelevement" class="form-label">Date du prélèvement</label>
                <input type="datetime-local" class="form-control" id="date_prelevement" name="date_prelevement" value="<?php echo date('Y-m-d\TH:i', strtotime($prelevement['date_prelevement'])); ?>" required>
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
                        echo "<option value='" . $stock['id_stock'] . "' " . ($stock['id_stock'] == $prelevement['id_stock'] ? 'selected' : '') . ">" . $stock['nom_stock'] . "</option>";
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
                        echo "<option value='" . $patient['id_patient'] . "' " . ($patient['id_patient'] == $prelevement['id_patient'] ? 'selected' : '') . ">" . $patient['nom_patient'] . " " . $patient['prenom_patient'] . "</option>";
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
                        echo "<option value='" . $infirmier['id_infirmier'] . "' " . ($infirmier['id_infirmier'] == $prelevement['id_infirmier'] ? 'selected' : '') . ">" . $infirmier['nom_infirmier'] . " " . $infirmier['prenom_infirmier'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour Prélèvement</button>
        </form>
    </div>
</body>
</html>
