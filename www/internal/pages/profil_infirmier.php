<?php
require("conn.php");
session_start();

if (!isset($_SESSION["id_infirmier"])) {
    $error = "Vous devez vous connecter.";
} else {
    $id_infirmier = $_SESSION["id_infirmier"];

    $stmt = $conn->prepare("SELECT * FROM infirmier WHERE id_infirmier = :id");
    $stmt->execute([':id' => $id_infirmier]);
    $infirmier = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$infirmier) {
        $error = "Infirmier introuvable.";
    } else {
        $current_hour = date('H');
        $greeting = ($current_hour < 18) ? 'Bonjour' : 'Bonsoir';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Infirmier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

<?php if (isset($error)): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
<?php else: ?>
    <h2><?= $greeting ?>, <?= htmlspecialchars($infirmier['prenom_infirmier']) ?> <?= htmlspecialchars($infirmier['nom_infirmier']) ?> !</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <table class="table">
        <!-- table rows here -->
    </table>

    <a href="modifier_profil.php" class="btn btn-primary">Modifier le Profil</a>
<?php endif; ?>

</div>
</body>
</html>
