<?php
require_once 'header.php';
require_once '../../includes/database.php';

// Get today's prélèvements
$today = date('Y-m-d');
$stmt = $pdo->prepare("
    SELECT p.*, pat.nom_patient, pat.prenom_patient, s.nom_stock
    FROM DISN1IMH_V13_prelevement p
    JOIN DISN1IMH_V13_patient pat ON p.id_patient = pat.id_patient
    JOIN DISN1IMH_V13_stock s ON p.id_stock = s.id_stock
    WHERE DATE(p.date_prelevement) = ?
    AND p.id_infirmier = ?
    ORDER BY p.date_prelevement DESC
");
$stmt->execute([$today, $_SESSION['user_id']]);
$prelevements_today = $stmt->fetchAll();

// Get pending prélèvements
$stmt = $pdo->prepare("
    SELECT COUNT(*) as count
    FROM DISN1IMH_V13_prelevement
    WHERE statut_prelevement = 'EN_ATTENTE'
    AND id_infirmier = ?
");
$stmt->execute([$_SESSION['user_id']]);
$pending_count = $stmt->fetch()['count'];
?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Prélèvements en attente</h5>
                <p class="card-text display-4"><?= $pending_count ?></p>
                <a href="liste-prelevement.php?status=EN_ATTENTE" class="btn btn-light">Voir détails</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Prélèvements d'aujourd'hui</h5>
        <a href="ajouter-prelevement.php" class="btn btn-primary btn-sm">Nouveau prélèvement</a>
    </div>
    <div class="card-body">
        <?php if (empty($prelevements_today)): ?>
            <p class="text-muted">Aucun prélèvement aujourd'hui</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Type</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prelevements_today as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['prenom_patient'] . ' ' . $p['nom_patient']) ?></td>
                                <td><?= htmlspecialchars($p['nom_stock']) ?></td>
                                <td><?= date('H:i', strtotime($p['date_prelevement'])) ?></td>
                                <td>
                                    <span class="badge bg-<?= $p['statut_prelevement'] === 'EFFECTUE' ? 'success' : 
                                        ($p['statut_prelevement'] === 'EN_ATTENTE' ? 'warning' : 'danger') ?>">
                                        <?= $p['statut_prelevement'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="modifier-prelevement.php?id=<?= $p['id_prelevement'] ?>" 
                                       class="btn btn-sm btn-outline-primary">Modifier</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>