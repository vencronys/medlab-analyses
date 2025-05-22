<?php
require_once 'header.php';
require_once '../../includes/database.php';

$status = isset($_GET['status']) ? $_GET['status'] : '';
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] : date('Y-m-d', strtotime('-7 days'));
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] : date('Y-m-d');

$where_clauses = ['p.id_infirmier = ?'];
$params = [$_SESSION['user']['id']];

if ($status) {
    $where_clauses[] = 'p.statut_prelevement = ?';
    $params[] = $status;
}

$where_clauses[] = 'DATE(p.date_prelevement) BETWEEN ? AND ?';
$params[] = $date_start;
$params[] = $date_end;

$sql = "
    SELECT p.*, pat.nom_patient, pat.prenom_patient, s.nom_stock
    FROM DISN1IMH_V13_prelevement p
    JOIN DISN1IMH_V13_patient pat ON p.id_patient = pat.id_patient
    JOIN DISN1IMH_V13_stock s ON p.id_stock = s.id_stock
    WHERE " . implode(' AND ', $where_clauses) . "
    ORDER BY p.date_prelevement DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$prelevements = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des prélèvements</h5>
    </div>
    <div class="card-body">
        <form method="get" class="row g-3 mb-4">
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="">Tous</option>
                    <option value="EN_ATTENTE" <?= $status === 'EN_ATTENTE' ? 'selected' : '' ?>>En attente</option>
                    <option value="EFFECTUE" <?= $status === 'EFFECTUE' ? 'selected' : '' ?>>Effectué</option>
                    <option value="ANNULE" <?= $status === 'ANNULE' ? 'selected' : '' ?>>Annulé</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Date début</label>
                <input type="date" name="date_start" class="form-control" value="<?= $date_start ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Date fin</label>
                <input type="date" name="date_end" class="form-control" value="<?= $date_end ?>">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Type</th>
                        <th>Volume (ml)</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($prelevements)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucun prélèvement trouvé</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($prelevements as $p): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($p['date_prelevement'])) ?></td>
                                <td><?= htmlspecialchars($p['prenom_patient'] . ' ' . $p['nom_patient']) ?></td>
                                <td><?= htmlspecialchars($p['nom_stock']) ?></td>
                                <td><?= $p['volume_ml'] ?></td>
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
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>