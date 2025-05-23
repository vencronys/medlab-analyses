<?php
session_start();
if (!isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=DISN1IMH_V1", "root", "");

if (!isset($_GET['id'])) {
    header('Location: liste_employes.php');
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM employes WHERE id = ? AND id_medecin = ?");
$stmt->execute([$id, $_SESSION['medecin_id']]);
$emp = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$emp) {
    echo "Employé non trouvé.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $salaire = $_POST['salaire'];
    $date_embauche = $_POST['date_embauche'];
    $statut = $_POST['statut'];  

    $stmt = $conn->prepare("UPDATE employes SET nom=?, prenom=?, cin=?, date_naissance=?, sexe=?, adresse=?, Téléphone=?, salaire=?, date_embauche=?, statut=? WHERE id=? AND id_medecin=?");
    $stmt->execute([$nom, $prenom, $cin, $date_naissance, $sexe, $adresse, $telephone, $salaire, $date_embauche, $statut, $id, $_SESSION['medecin_id']]);

    header('Location: liste_employes.php?success=modifier');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4">Modifier un employé</h2>
        <form method="POST">
            <div class="mb-3"><label class="form-label">Nom</label><input type="text" name="nom" class="form-control" value="<?= $emp['nom']; ?>"></div>
            <div class="mb-3"><label class="form-label">Prénom</label><input type="text" name="prenom" class="form-control" value="<?= $emp['prenom']; ?>"></div>
            <div class="mb-3"><label class="form-label">CIN</label><input type="text" name="cin" class="form-control" value="<?= $emp['cin']; ?>"></div>
            <div class="mb-3"><label class="form-label">Date de naissance</label><input type="date" name="date_naissance" class="form-control" value="<?= $emp['date_naissance']; ?>"></div>
            <div class="mb-3"><label class="form-label">Sexe</label>
                <select name="sexe" class="form-select">
                    <option value="Homme" <?= $emp['sexe'] === 'Homme' ? 'selected' : '' ?>>Homme</option>
                    <option value="Femme" <?= $emp['sexe'] === 'Femme' ? 'selected' : '' ?>>Femme</option>
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Adresse</label><input type="text" name="adresse" class="form-control" value="<?= $emp['adresse']; ?>"></div>
            <div class="mb-3"><label class="form-label">Téléphone</label><input type="text" name="telephone" class="form-control" value="<?= $emp['Téléphone']; ?>"></div>
            <div class="mb-3"><label class="form-label">Salaire</label><input type="number" step="0.01" name="salaire" class="form-control" value="<?= $emp['salaire']; ?>"></div>
            <div class="mb-3"><label class="form-label">Date d'embauche</label><input type="date" name="date_embauche" class="form-control" value="<?= $emp['date_embauche']; ?>"></div>
            
            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    <option value="Actif" <?= $emp['statut'] === 'Actif' ? 'selected' : '' ?>>Actif</option>
                    <option value="Inactif" <?= $emp['statut'] === 'Inactif' ? 'selected' : '' ?>>Inactif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
            <a href="liste_employes.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
</body>
</html>
