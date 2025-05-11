<?php
session_start();
require("conn.php");

$infirmier = null;
$erreur_connexion = false;

if (!isset($_SESSION["id_infirmier"])) {
    $erreur_connexion = true;
} else {
    $id_infirmier = $_SESSION["id_infirmier"];

    $stmt = $conn->prepare("SELECT * FROM infirmier WHERE id_infirmier = :id");
    $stmt->execute([':id' => $id_infirmier]);
    $infirmier = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$infirmier) {
        $erreur_connexion = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<?php if ($erreur_connexion): ?>
    <div class="alert alert-danger text-center" role="alert">
        Vous devez vous connecter.
    </div>
<?php else: ?>

    <h2>Modifier le profil de l'infirmier</h2>
    <form action="update_profil.php" method="post">

        <div class="mb-3">
            <label>Nom :</label>
            <input type="text" class="form-control" name="nom_infirmier" value="<?= htmlspecialchars($infirmier['nom_infirmier']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Prénom :</label>
            <input type="text" class="form-control" name="prenom_infirmier" value="<?= htmlspecialchars($infirmier['prenom_infirmier']) ?>" required>
        </div>

        <div class="mb-3">
            <label>CIN :</label>
            <input type="text" class="form-control" name="cin_infirmier" value="<?= htmlspecialchars($infirmier['cin_infirmier']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Date de naissance :</label>
            <input type="date" class="form-control" name="date_naissance_infirmier" value="<?= htmlspecialchars($infirmier['date_naissance_infirmier']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Sexe :</label>
            <select name="sexe_infirmier" class="form-control" required>
                <option value="H" <?= ($infirmier['sexe_infirmier'] === 'H') ? 'selected' : '' ?>>Homme</option>
                <option value="F" <?= ($infirmier['sexe_infirmier'] === 'F') ? 'selected' : '' ?>>Femme</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Adresse :</label>
            <input type="text" class="form-control" name="adresse_infirmier" value="<?= htmlspecialchars($infirmier['adresse_infirmier']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Téléphone :</label>
            <input type="text" class="form-control" name="telephone_infirmier" value="<?= htmlspecialchars($infirmier['telephone_infirmier']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Statut :</label>
            <select name="statut_infirmier" class="form-control" required>
                <option value="Actif" <?= ($infirmier['statut_infirmier'] === 'Actif') ? 'selected' : '' ?>>Actif</option>
                <option value="Inactif" <?= ($infirmier['statut_infirmier'] === 'Inactif') ? 'selected' : '' ?>>Inactif</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Date d'embauche :</label>
            <input type="date" class="form-control" name="date_embauche_infirmier" value="<?= htmlspecialchars($infirmier['date_embauche_infirmier']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
