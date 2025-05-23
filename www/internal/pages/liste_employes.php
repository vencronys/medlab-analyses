<?php
session_start();
if (!isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=DISN1IMH_V1", "root", "");
$requete = $conn->prepare("SELECT * FROM employes WHERE id_medecin = ?");
$requete->execute([$_SESSION['medecin_id']]);
$employes = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Liste des employés</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Employé ajouté avec succès !</div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>date_naissance</th>
                    <th>sexe</th>
                    <th>adresse</th>
                    <th>Téléphone</th>
                    <th>salaire</th>
                    <th>date_embauche</th>
                    <th>email</th>
                    <th>mot_de_passe</th>
                    <th> Privilège </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $emp): ?>
                    <tr>
                        <td><?php echo $emp['nom']; ?></td>
                        <td><?php echo $emp['prenom']; ?></td>
                        <td><?php echo $emp['cin']; ?></td>
                        <td><?php echo $emp['date_naissance']; ?></td>
                        <td><?php echo $emp['sexe']; ?></td>
                        <td><?php echo $emp['adresse']; ?></td>
                        <td><?php echo $emp['Téléphone']; ?></td>
                        <td><?php echo $emp['salaire']; ?></td>
                        <td><?php echo $emp['date_embauche']; ?></td>
                        <td><?php echo $emp['email']; ?></td>
                        <td>******</td>
                        <td><?php echo $emp['Privilège']; ?></td>



                        <td>
                            <a href="modifier_employe.php?id=<?php echo $emp['id']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="supprimer_employe.php?id=<?php echo $emp['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">Supprimer</a>
                
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="ajouter_employe.php" class="btn btn-primary">Ajouter un employé</a>
    </div>
</div>

</body>
</html>
