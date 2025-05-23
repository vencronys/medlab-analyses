<?php
session_start();

if (!isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}

$medecin_id = $_SESSION['medecin_id'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=DISN1IMH_V1", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM employes WHERE id_medecin = ?");
    $stmt->execute([$medecin_id]);
    $employe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$employe) {
        echo "Aucun profil trouvé.";
        exit();
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Mon Profil</h2>

        <form action="modifier_profil.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $employe['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-control" value="<?php echo ($employe['nom']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Prénom :</label>
                <input type="text" name="prenom" class="form-control" value="<?php echo ($employe['prenom']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CIN :</label>
                <input type="text" name="cin" class="form-control" value="<?php echo ($employe['cin']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de Naissance :</label>
                <input type="date" name="date_naissance" class="form-control" value="<?php echo ($employe['date_naissance']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sexe :</label>
                <select name="sexe" class="form-control" required>
                    <option value="M" <?php echo ($employe['sexe'] == 'M') ? 'selected' : ''; ?>>Homme</option>
                    <option value="F" <?php echo ($employe['sexe'] == 'F') ? 'selected' : ''; ?>>Femme</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Adresse :</label>
                <textarea name="adresse" class="form-control" rows="2" required><?php echo ($employe['adresse']); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Téléphone :</label>
                <input type="text" name="telephone" class="form-control" value="<?php echo ($employe['telephone']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Salaire :</label>
                <input type="number" name="salaire" class="form-control" value="<?php echo ($employe['salaire']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date d'embauche :</label>
                <input type="date" name="date_embauche" class="form-control" value="<?php echo ($employe['date_embauche']); ?>" required>
            </div>


            <div class="mb-3">
                <label class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" value="<?php echo ($employe['email']); ?>" required>
            </div>

           
            <div class="mb-3">
                <label class="form-label">Mot de Passe :</label>
                <input type="password" name="mot_de_passe" class="form-control" value="<?php echo ($employe['mot_de_passe']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Privilège :</label>
                <input type="text" name="privilege" class="form-control" value="<?php echo ($employe['privilege']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
</div>

</body>
</html>
