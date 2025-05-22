<?php
require_once 'header.php';
require_once '../../includes/database.php';

$id_prelevement = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get prélèvement
$stmt = $conn->prepare("
    SELECT p.*, pat.nom_patient, pat.prenom_patient
    FROM DISN1IMH_V13_prelevement p
    JOIN DISN1IMH_V13_patient pat ON p.id_patient = pat.id_patient
    WHERE p.id_prelevement = ?
    AND p.id_infirmier = ?
");
$stmt->execute([$id_prelevement, $_SESSION['user']['id']]);
$prelevement = $stmt->fetch();

if (!$prelevement) {
    header('Location: liste-prelevement.php?error=not_found');
    exit();
}

// Get associated examens
$stmt = $conn->prepare("
    SELECT e.id_examen
    FROM DISN1IMH_V13_prelevement_examen pe
    JOIN DISN1IMH_V13_examen e ON pe.id_examen = e.id_examen
    WHERE pe.id_prelevement = ?
");
$stmt->execute([$id_prelevement]);
$prelevement_examens = array_column($stmt->fetchAll(), 'id_examen');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn->beginTransaction();

        // Update prélèvement
        $stmt = $conn->prepare("
            UPDATE DISN1IMH_V13_prelevement
            SET volume_ml = ?,
                date_prelevement = ?,
                statut_prelevement = ?
            WHERE id_prelevement = ?
            AND id_infirmier = ?
        ");

        $stmt->execute([
            $_POST['volume_ml'],
            $_POST['date_prelevement'],
            $_POST['statut_prelevement'],
            $id_prelevement,
            $_SESSION['user']['id']
        ]);

        // Update examens
        $stmt = $conn->prepare("DELETE FROM DISN1IMH_V13_prelevement_examen WHERE id_prelevement = ?");
        $stmt->execute([$id_prelevement]);

        if (!empty($_POST['examens'])) {
            $stmt = $conn->prepare("
                INSERT INTO DISN1IMH_V13_prelevement_examen 
                (id_prelevement, id_examen) VALUES (?, ?)
            ");

            foreach ($_POST['examens'] as $id_examen) {
                $stmt->execute([$id_prelevement, $id_examen]);
            }
        }

        $conn->commit();
        header('Location: liste-prelevement.php?success=1');
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        $error = "Une erreur est survenue lors de la modification du prélèvement.";
    }
}

// Get examens list
$stmt = $conn->query("
    SELECT id_examen, nom_examen, code_examen
    FROM DISN1IMH_V13_examen
    WHERE statut_examen = 'DISPONIBLE'
    ORDER BY nom_examen
");
$examens = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Modifier le prélèvement</h5>
        <a href="liste-prelevement.php" class="btn btn-outline-secondary btn-sm">
            Retour à la liste
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <div class="alert alert-info">
            <strong>Patient:</strong> 
            <?= htmlspecialchars($prelevement['prenom_patient'] . ' ' . $prelevement['nom_patient']) ?>
        </div>

        <form method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Volume (ml)</label>
                    <input type="number" name="volume_ml" class="form-control" 
                           value="<?= $prelevement['volume_ml'] ?>" step="0.01" min="0" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date et heure</label>
                    <input type="datetime-local" name="date_prelevement" 
                           value="<?= date('Y-m-d\TH:i', strtotime($prelevement['date_prelevement'])) ?>" 
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Statut</label>
                    <select name="statut_prelevement" class="form-select" required>
                        <option value="EN_ATTENTE" <?= $prelevement['statut_prelevement'] === 'EN_ATTENTE' ? 'selected' : '' ?>>
                            En attente
                        </option>
                        <option value="EFFECTUE" <?= $prelevement['statut_prelevement'] === 'EFFECTUE' ? 'selected' : '' ?>>
                            Effectué
                        </option>
                        <option value="ANNULE" <?= $prelevement['statut_prelevement'] === 'ANNULE' ? 'selected' : '' ?>>
                            Annulé
                        </option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">Examens associés</label>
                    <div class="row g-3">
                        <?php foreach ($examens as $e): ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="examens[]" value="<?= $e['id_examen'] ?>" 
                                           id="examen_<?= $e['id_examen'] ?>"
                                           <?= in_array($e['id_examen'], $prelevement_examens) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="examen_<?= $e['id_examen'] ?>">
                                        <?= htmlspecialchars($e['nom_examen'] . ' (' . $e['code_examen'] . ')') ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="liste-prelevement.php" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Form validation
document.querySelector('.needs-validation').addEventListener('submit', function(event) {
    if (!this.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    this.classList.add('was-validated');
});
</script>

<?php require_once '../../includes/footer.php'; ?>