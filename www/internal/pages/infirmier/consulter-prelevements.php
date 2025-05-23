<?php
require_once 'header.php';
require("../../includes/database.php");

$query = "SELECT p.*, pat.nom_patient, pat.prenom_patient, inf.nom_infirmier, inf.prenom_infirmier
    FROM DISN1IMH_V13_prelevement p
    JOIN DISN1IMH_V13_patient pat ON p.id_patient = pat.id_patient
    JOIN DISN1IMH_V13_infirmier inf ON p.id_infirmier = inf.id_infirmier";

if (isset($_POST['filter'])) {
    $searchTerm = $_POST['search'];
    $query .= " AND (statut_prelevement LIKE :searchTerm OR id_patient LIKE :searchTerm)";
}

if (!isset($_POST['show_all'])) {
    $query .= " WHERE p.id_infirmier = ?";
}

$stmt = $conn->prepare($query);
if (isset($_POST['filter'])) {
    $stmt->execute([':searchTerm' => "%" . $searchTerm . "%", $_SESSION['user']['id']]);
} elseif (!isset($_POST['show_all'])) {
    $stmt->execute([$_SESSION['user']['id']]);
} else {
    $stmt->execute();
}

$prelevements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter Prelevements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Consulter Prelevements</h2>
        
        <form action="consulter-prelevements.php" method="post">
            <input type="text" name="search" placeholder="Search by name or date" class="form-control mb-3">
            <button type="submit" name="filter" class="btn btn-primary">Filter</button>
            <button type="submit" name="show_all" class="btn btn-secondary">Show All</button>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID Prelevement</th>
                    <th>Date Prelevement</th>
                    <th>Statut</th>
                    <th>Volume (ml)</th>
                    <th>Patient</th>
                    <th>Infirmier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prelevements as $prelevement): ?>
                    <tr>
                        <td><?php echo $prelevement['id_prelevement']; ?></td>
                        <td><?php echo $prelevement['date_prelevement']; ?></td>
                        <td><?php echo $prelevement['statut_prelevement']; ?></td>
                        <td><?php echo $prelevement['volume_ml']; ?></td>
                        <td><?php echo $prelevement['prenom_patient'] . ' ' . $prelevement['nom_patient']; ?></td>
                        <td><?php echo $prelevement['prenom_infirmier'] . ' ' . $prelevement['nom_infirmier']; ?></td>
                        <td>
    <a href="modifier-prelevement.php?id=<?php echo $prelevement['id_prelevement']; ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="supprimer-prelevement.php?id=<?php echo $prelevement['id_prelevement']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this prelevement?')">Delete</a>
</td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>