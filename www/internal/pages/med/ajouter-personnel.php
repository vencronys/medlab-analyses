<?php
require_once 'header.php';
require_once '../../includes/database.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'infirmier';
$error = null;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn->beginTransaction();

        // Validate inputs
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $tel = trim($_POST['telephone']);
        $password = $_POST['password'];
        $cin = trim($_POST['cin']);
        $date_naissance = trim($_POST['date_naissance']);
        $sexe = $_POST['sexe'];
        $adresse = trim($_POST['adresse']);
        $salaire = floatval(str_replace(',', '.', $_POST['salaire']));
        $date_embauche = trim($_POST['date_embauche']);

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
        if (empty($password) || strlen($password) < 6) {
            throw new Exception("Le mot de passe doit contenir au moins 6 caractères");
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

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            INSERT INTO DISN1IMH_V13_compte 
            (email_compte, mot_de_passe_compte, privilege_compte, statut_compte)
            VALUES (:email, :password, :privilege, 'ACTIF')
        ");
        $stmt->execute([
            ':email' => $email,
            ':password' => $password,
            ':privilege' => strtoupper($type)
        ]);
        $id_compte = $conn->lastInsertId();

        $table_prefix = $type === 'chef_technicien' ? 'chef_technicien' : $type;
        $query = "INSERT INTO DISN1IMH_V13_{$table_prefix} (
            nom_{$table_prefix}, prenom_{$table_prefix}, cin_{$table_prefix},
            date_naissance_{$table_prefix}, sexe_{$table_prefix}, adresse_{$table_prefix},
            telephone_{$table_prefix}, statut_{$table_prefix}, salaire_{$table_prefix},
            date_embauche_{$table_prefix}, id_compte
        ) VALUES (
            :nom, :prenom, :cin, :date_naissance, :sexe, :adresse,
            :tel, 'ACTIF', :salaire, :date_embauche, :id_compte
        )";
        
        $stmt = $conn->prepare($query);

        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':cin' => $cin,
            ':date_naissance' => $date_naissance,
            ':sexe' => $sexe,
            ':adresse' => $adresse,
            ':tel' => $tel,
            ':salaire' => $salaire,
            ':date_embauche' => $date_embauche,
            ':id_compte' => $id_compte
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
        <h5 class="mb-0">Ajouter <?php
            switch($type) {
                case 'infirmier': echo 'un Infirmier'; break;
                case 'secretaire': echo 'une Secrétaire'; break;
                case 'technicien': echo 'un Technicien'; break;
                case 'chef_technicien': echo 'un Chef Technicien'; break;
                default: echo 'un membre du personnel';
            }
        ?></h5>
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
                           value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required pattern="[A-Za-zÀ-ÿ '-]{2,50}"
                           value="<?= isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cin" class="form-label">CIN</label>
                    <input type="text" class="form-control" id="cin" name="cin" required pattern="[A-Z0-9]{7}"
                           value="<?= isset($_POST['cin']) ? htmlspecialchars($_POST['cin']) : '' ?>">
                    <div class="form-text">7 caractères alphanumériques</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" required
                           value="<?= isset($_POST['date_naissance']) ? htmlspecialchars($_POST['date_naissance']) : '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sexe" class="form-label">Sexe</label>
                    <select class="form-select" id="sexe" name="sexe" required>
                        <option value="">Choisir...</option>
                        <option value="M" <?= isset($_POST['sexe']) && $_POST['sexe'] === 'M' ? 'selected' : '' ?>>Masculin</option>
                        <option value="F" <?= isset($_POST['sexe']) && $_POST['sexe'] === 'F' ? 'selected' : '' ?>>Féminin</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required pattern="[0-9]{10}"
                           value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>">
                    <div class="form-text">10 chiffres</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea class="form-control" id="adresse" name="adresse" required rows="2"><?= isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : '' ?></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="salaire" class="form-label">Salaire (DH)</label>
                    <input type="number" class="form-control" id="salaire" name="salaire" required min="0" step="0.01"
                           value="<?= isset($_POST['salaire']) ? htmlspecialchars($_POST['salaire']) : '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date_embauche" class="form-label">Date d'embauche</label>
                    <input type="date" class="form-control" id="date_embauche" name="date_embauche" required
                           value="<?= isset($_POST['date_embauche']) ? htmlspecialchars($_POST['date_embauche']) : date('Y-m-d') ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                    <div class="form-text">Minimum 6 caractères</div>
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
