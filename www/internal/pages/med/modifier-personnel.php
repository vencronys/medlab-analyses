<?php
require_once 'header.php';
require_once '../../includes/database.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'infirmier';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = null;

if (!$id) {
    header("Location: liste-personnel.php?type={$type}");
    exit();
}

// Get personnel record
if ($type === 'infirmier') {
    $stmt = $conn->prepare("SELECT i.nom_infirmier as nom, i.prenom_infirmier as prenom,
    i.cin_infirmier as cin, i.date_naissance_infirmier as date_naissance, i.sexe_infirmier as sexe,
    i.adresse_infirmier as adresse, i.telephone_infirmier as telephone, i.statut_infirmier as statut,
    i.date_embauche_infirmier as date_embauche, i.salaire_infirmier as salaire, c.email_compte, c.id_compte
    FROM DISN1IMH_V13_infirmier i
    JOIN DISN1IMH_V13_compte c ON i.id_compte = c.id_compte
    WHERE i.id_infirmier = ?");
} elseif ($type === 'secretaire') {
    $stmt = $conn->prepare("SELECT s.nom_secretaire as nom, s.prenom_secretaire as prenom,
    s.cin_secretaire as cin, s.date_naissance_secretaire as date_naissance, s.sexe_secretaire as sexe,
    s.adresse_secretaire as adresse, s.telephone_secretaire as telephone, s.statut_secretaire as statut,
    s.date_embauche_secretaire as date_embauche, s.salaire_secretaire as salaire, c.email_compte, c.id_compte
    FROM DISN1IMH_V13_secretaire s
    JOIN DISN1IMH_V13_compte c ON s.id_compte = c.id_compte
    WHERE s.id_secretaire = ?");
} elseif ($type === 'technicien') {
    $stmt = $conn->prepare("SELECT t.nom_technicien as nom, t.prenom_technicien as prenom,
    t.cin_technicien as cin, t.date_naissance_technicien as date_naissance, t.sexe_technicien as sexe,
    t.adresse_technicien as adresse, t.telephone_technicien as telephone, t.statut_technicien as statut,
    t.date_embauche_technicien as date_embauche, t.salaire_technicien as salaire, c.email_compte, c.id_compte
    FROM DISN1IMH_V13_technicien t
    JOIN DISN1IMH_V13_compte c ON t.id_compte = c.id_compte
    WHERE t.id_technicien = ?");
} elseif ($type === 'chef_technicien') {
    $stmt = $conn->prepare("SELECT ct.nom_chef_technicien as nom, ct.prenom_chef_technicien as prenom,
    ct.cin_chef_technicien as cin, ct.date_naissance_chef_technicien as date_naissance, ct.sexe_chef_technicien as sexe,
    ct.adresse_chef_technicien as adresse, ct.telephone_chef_technicien as telephone, ct.statut_chef_technicien as statut,
    ct.date_embauche_chef_technicien as date_embauche, ct.salaire_chef_technicien as salaire, c.email_compte, c.id_compte
    FROM DISN1IMH_V13_chef_technicien ct
    JOIN DISN1IMH_V13_compte c ON ct.id_compte = c.id_compte
    WHERE ct.id_chef_technicien = ?");
}

$stmt->execute([$id]);
$personnel = $stmt->fetch();

if (!$personnel) {
    header("Location: liste-personnel.php?type={$type}&error=not_found");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn->beginTransaction();

        // Validate inputs
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $tel = trim($_POST['telephone']);
        $cin = trim($_POST['cin']);
        $date_naissance = trim($_POST['date_naissance']);
        $sexe = $_POST['sexe'];
        $adresse = trim($_POST['adresse']);
        $salaire = floatval(str_replace(',', '.', $_POST['salaire']));
        $date_embauche = trim($_POST['date_embauche']);
        $statut = $_POST['statut'];

        if (empty($nom) || !preg_match("/^[A-Za-zÀ-ÿ '-]{2,50}$/", $nom)) {
            throw new Exception("Le nom est invalide");
        }
        if (empty($prenom) || !preg_match("/^[A-Za-zÀ-ÿ '-]{2,50}$/", $prenom)) {
            throw new Exception("Le prénom est invalide");
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email est invalide");
        }
        if (empty($tel) || !preg_match("/^[0-9]{10}$/", $tel)) {
            throw new Exception("Le numéro de téléphone doit contenir 10 chiffres");
        }
        if (empty($cin) || !preg_match("/^[A-Z0-9]{7}$/", $cin)) {
            throw new Exception("Le CIN doit contenir exactement 7 caractères alphanumériques");
        }
        if (empty($date_naissance) || strtotime($date_naissance) === false) {
            throw new Exception("La date de naissance est invalide");
        }
        if (!in_array($sexe, ['M', 'F'])) {
            throw new Exception("Le sexe doit être M ou F");
        }
        if (empty($adresse)) {
            throw new Exception("L'adresse est requise");
        }
        if ($salaire <= 0) {
            throw new Exception("Le salaire doit être supérieur à 0");
        }
        if (empty($date_embauche) || strtotime($date_embauche) === false) {
            throw new Exception("La date d'embauche est invalide");
        }

        // Update account email if changed
        if ($email !== $personnel['email_compte']) {
            $stmt = $conn->prepare("UPDATE disn1imh_v13_compte SET email_compte = ? WHERE id_compte = ?");
            $stmt->execute([$email, $personnel['id_compte']]);
        }

        // Update personnel record
        $query = "UPDATE DISN1IMH_V13_{$type}
            SET nom_{$type} = ?,
                prenom_{$type} = ?,
                cin_{$type} = ?,
                date_naissance_{$type} = ?,
                sexe_{$type} = ?,
                adresse_{$type} = ?,
                telephone_{$type} = ?,
                statut_{$type} = ?,
                salaire_{$type} = ?,
                date_embauche_{$type} = ?
            WHERE id_{$type} = ?";

        $stmt = $conn->prepare($query);

        $stmt->execute([
            $nom, $prenom, $cin, $date_naissance, $sexe, $adresse,
            $tel, $statut, $salaire, $date_embauche, $id
        ]);

        $conn->commit();
        header("Location: liste-personnel.php?type={$type}&success=1");
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        $error = $e->getMessage();
    }
}

?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier <?= $type === 'infirmier' ? "l'Infirmier" : 'la Secrétaire' ?></h5>
    </div>
    <div class="card-body">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required pattern="[A-Za-zÀ-ÿ '-]{2,50}"
                           value="<?= htmlspecialchars($personnel['nom']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required pattern="[A-Za-zÀ-ÿ '-]{2,50}"
                           value="<?= htmlspecialchars($personnel['prenom']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cin" class="form-label">CIN</label>
                    <input type="text" class="form-control" id="cin" name="cin" required pattern="[A-Z0-9]{7}"
                           value="<?= htmlspecialchars($personnel['cin']) ?>">
                    <div class="form-text">7 caractères alphanumériques</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" required
                           value="<?= htmlspecialchars($personnel['date_naissance']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sexe" class="form-label">Sexe</label>
                    <select class="form-select" id="sexe" name="sexe" required>
                        <option value="">Choisir...</option>
                        <option value="M" <?= $personnel['sexe'] === 'M' ? 'selected' : '' ?>>Masculin</option>
                        <option value="F" <?= $personnel['sexe'] === 'F' ? 'selected' : '' ?>>Féminin</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                           value="<?= htmlspecialchars($personnel['email_compte']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required pattern="[0-9]{10}"
                           value="<?= htmlspecialchars($personnel['telephone']) ?>">
                    <div class="form-text">10 chiffres</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea class="form-control" id="adresse" name="adresse" required rows="2"><?= htmlspecialchars($personnel['adresse']) ?></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="salaire" class="form-label">Salaire (DH)</label>
                    <input type="number" class="form-control" id="salaire" name="salaire" required min="0" step="0.01"
                           value="<?= htmlspecialchars($personnel['salaire']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date_embauche" class="form-label">Date d'embauche</label>
                    <input type="date" class="form-control" id="date_embauche" name="date_embauche" required
                           value="<?= htmlspecialchars($personnel['date_embauche']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select" id="statut" name="statut" required>
                        <option value="ACTIF" <?= $personnel['statut'] === 'ACTIF' ? 'selected' : '' ?>>Actif</option>
                        <option value="INACTIF" <?= $personnel['statut'] === 'INACTIF' ? 'selected' : '' ?>>Inactif</option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="liste-personnel.php?type=<?= $type ?>" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
