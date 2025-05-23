<?php
session_start();
if (!isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Ajouter un nouvel employé</h2>

        <form action="traitement_employe.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-control" required pattern="^[A-Za-zÀ-ÿ '-]{3,30}$" >
            </div>

            <div class="mb-3">
                <label class="form-label">Prénom :</label>
                <input type="text" name="prenom" class="form-control" required pattern="^[A-Za-zÀ-ÿ '-]{3,30}$" >
            </div>

            <div class="mb-3">
                <label class="form-label">CIN :</label>
                <input type="text" name="cin" class="form-control" required pattern="^[A-Za-z0-9]{6,12}$" >
            </div>

            <div class="mb-3">
                <label class="form-label">Date de naissance :</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sexe :</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" value="H" required>
                    <label class="form-check-label">Homme</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" value="F" required>
                    <label class="form-check-label">Femme</label>
                </div>

            </div>
            <div class="mb-3">
                <label class="form-label">Adresse :</label>
                <textarea name="adresse" class="form-control" rows="2" required></textarea>
                </div> 

                <div class="mb-3">
                <label class="form-label">Téléphone :</label>
                <input type="text" name="telephone" class="form-control" required pattern="^[0-9]{10,15}$" >
            </div>
             
            <div class="mb-3">
                 <label class="form-label">Salaire :</label>
                 <input type="number" name="salaire" class="form-control" required min="0" step="0.01">
            </div>

            <div class="mb-3">
                  <label class="form-label">Date d'embauche :</label>
                 <input type="date" name="date_embauche" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe :</label>
                <input type="password" name="mot_de_passe" class="form-control" required pattern=".{6,}" >
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe :</label>
                <input type="password" name="confirmation" class="form-control" required pattern=".{6,}" >
            </div>

            <div class="mb-3">
                <label class="form-label">Privilège</label>
                <select name="Privilège" class="form-select" required>
                    <option value="Secrétaire">Secrétaire</option>
                    <option value="Technicien">Technicien</option>
                    <option value="Technicien Général">Technicien Général</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</div>

</body>
</html>
