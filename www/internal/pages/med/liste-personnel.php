<?php
require_once 'header.php';
require_once '../../includes/database.php';

$status = isset($_GET['status']) ? $_GET['status'] : 'ACTIF';

$query = "
    (SELECT 'Infirmier' as type, i.id_infirmier as id, i.nom_infirmier as nom, i.prenom_infirmier as prenom,
            c.email_compte as email, i.telephone_infirmier as tel,
            i.statut_infirmier as statut, i.date_embauche_infirmier as date_embauche,
            i.salaire_infirmier as salaire
     FROM DISN1IMH_V13_infirmier i
     JOIN DISN1IMH_V13_compte c ON i.id_compte = c.id_compte
     WHERE i.statut_infirmier = ?)
    UNION ALL
    (SELECT 'Secrétaire' as type, s.id_secretaire as id, s.nom_secretaire as nom, s.prenom_secretaire as prenom,
            c.email_compte as email, s.telephone_secretaire as tel,
            s.statut_secretaire as statut, s.date_embauche_secretaire as date_embauche,
            s.salaire_secretaire as salaire
     FROM DISN1IMH_V13_secretaire s
     JOIN DISN1IMH_V13_compte c ON s.id_compte = c.id_compte
     WHERE s.statut_secretaire = ?)
    UNION ALL
    (SELECT 'Technicien' as type, t.id_technicien as id, t.nom_technicien as nom, t.prenom_technicien as prenom,
            c.email_compte as email, t.telephone_technicien as tel,
            t.statut_technicien as statut, t.date_embauche_technicien as date_embauche,
            t.salaire_technicien as salaire
     FROM DISN1IMH_V13_technicien t
     JOIN DISN1IMH_V13_compte c ON t.id_compte = c.id_compte
     WHERE t.statut_technicien = ?)
    UNION ALL
    (SELECT 'Chef Technicien' as type, ct.id_chef_technicien as id, ct.nom_chef_technicien as nom, 
            ct.prenom_chef_technicien as prenom, c.email_compte as email, 
            ct.telephone_chef_technicien as tel, ct.statut_chef_technicien as statut, 
            ct.date_embauche_chef_technicien as date_embauche,
            ct.salaire_chef_technicien as salaire
     FROM DISN1IMH_V13_chef_technicien ct
     JOIN DISN1IMH_V13_compte c ON ct.id_compte = c.id_compte
     WHERE ct.statut_chef_technicien = ?)
    ORDER BY type, nom, prenom";

$stmt = $conn->prepare($query);
$stmt->execute([$status, $status, $status, $status]);
$personnel = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Liste du Personnel</h5>
            <div class="btn-group mt-2">
                <a href="?status=ACTIF" 
                   class="btn btn-sm <?= $status === 'ACTIF' ? 'btn-primary' : 'btn-outline-primary' ?>">Actifs</a>
                <a href="?status=SUSPENDU" 
                   class="btn btn-sm <?= $status === 'SUSPENDU' ? 'btn-danger' : 'btn-outline-danger' ?>">Suspendus</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                Ajouter du Personnel
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="ajouter-personnel.php?type=infirmier">Ajouter un Infirmier</a></li>
                <li><a class="dropdown-item" href="ajouter-personnel.php?type=secretaire">Ajouter une Secrétaire</a></li>
                <li><a class="dropdown-item" href="ajouter-personnel.php?type=technicien">Ajouter un Technicien</a></li>
                <li><a class="dropdown-item" href="ajouter-personnel.php?type=chef_technicien">Ajouter un Chef Technicien</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($personnel)): ?>
            <p class="text-muted">Aucun personnel trouvé</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date d'embauche</th>
                            <th>Salaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($personnel as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['type']) ?></td>
                                <td><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></td>
                                <td><?= htmlspecialchars($p['email']) ?></td>
                                <td><?= htmlspecialchars($p['tel']) ?></td>
                                <td><?= date('d/m/Y', strtotime($p['date_embauche'])) ?></td>
                                <td><?= number_format($p['salaire'], 2, ',', ' ') ?> DH</td>
                                <td>
                                    <a href="modifier-personnel.php?type=<?= strtolower(str_replace(' ', '_', $p['type'])) ?>&id=<?= $p['id'] ?>" 
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
