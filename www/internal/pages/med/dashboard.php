<?php
require_once 'header.php';
require_once '../../includes/database.php';

// Get personnel counts
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM disn1imh_v13_infirmier WHERE statut_infirmier = 'ACTIF'");
$stmt->execute();
$infirmier_count = $stmt->fetch()['count'];

$stmt = $conn->prepare("SELECT COUNT(*) as count FROM disn1imh_v13_secretaire WHERE statut_secretaire = 'ACTIF'");
$stmt->execute();
$secretaire_count = $stmt->fetch()['count'];

// Get recent personnel additions
$stmt = $conn->prepare("
    SELECT 'Infirmier' as type, i.id_infirmier as id, i.nom_infirmier as nom, i.prenom_infirmier as prenom, i.date_embauche_infirmier as date_embauche, c.email_compte
    FROM DISN1IMH_V13_infirmier i
    JOIN DISN1IMH_V13_compte c ON i.id_compte = c.id_compte
    WHERE i.statut_infirmier = 'ACTIF'
    UNION
    SELECT 'Secrétaire' as type, s.id_secretaire as id, s.nom_secretaire as nom, s.prenom_secretaire as prenom, s.date_embauche_secretaire as date_embauche, c.email_compte
    FROM DISN1IMH_V13_secretaire s
    JOIN DISN1IMH_V13_compte c ON s.id_compte = c.id_compte
    WHERE s.statut_secretaire = 'ACTIF'
    ORDER BY date_embauche DESC
    LIMIT 7
");
$stmt->execute();
$recent_personnel = $stmt->fetchAll();
?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Infirmiers Actifs</h5>
                <p class="card-text display-4"><?= $infirmier_count ?></p>
                <a href="liste-personnel.php?type=infirmier" class="btn btn-light">Voir détails</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Secrétaires Actifs</h5>
                <p class="card-text display-4"><?= $secretaire_count ?></p>
                <a href="liste-personnel.php?type=secretaire" class="btn btn-light">Voir détails</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Personnel Récent</h5>
        <div>
            <a href="ajouter-personnel.php?type=infirmier" class="btn btn-primary btn-sm">Ajouter Infirmier</a>
            <a href="ajouter-personnel.php?type=secretaire" class="btn btn-success btn-sm">Ajouter Secrétaire</a>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($recent_personnel)): ?>
            <p class="text-muted">Aucun personnel récent</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Nom</th>
                            <th>Date d'ajout</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_personnel as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['type']) ?></td>
                                <td><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></td>
                                <td><?= date('d/m/Y', strtotime($p['date_embauche'])) ?></td>
                                <td>
                                    <a href="modifier-personnel.php?type=<?php echo htmlspecialchars(strtolower($p['type'])) ?>&id=<?php echo (int)$p['id'] ?>" 
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
    </div>
</div>

