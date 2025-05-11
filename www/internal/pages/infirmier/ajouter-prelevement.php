<?php
require_once 'header.php';
require_once '../../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            INSERT INTO DISN1IMH_V13_prelevement 
            (volume_ml, date_prelevement, id_stock, id_patient, id_infirmier, statut_prelevement)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $_POST['volume_ml'],
            $_POST['date_prelevement'],
            $_POST['id_stock'],
            $_POST['id_patient'],
            $_SESSION['user_id'],
            'EN_ATTENTE'
        ]);

        $id_prelevement = $pdo->lastInsertId();

        // Insert examens associés
        if (!empty($_POST['examens'])) {
            $stmt = $pdo->prepare("
                INSERT INTO DISN1IMH_V13_prelevement_examen 
                (id_prelevement, id_examen) VALUES (?, ?)
            ");

            foreach ($_POST['examens'] as $id_examen) {
                $stmt->execute([$id_prelevement, $id_examen]);
            }
        }

        $pdo->commit();
        header('Location: liste-prelevement.php?success=1');
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Une erreur est survenue lors de l'ajout du prélèvement.";
    }
}

// Get patients list
$stmt = $pdo->query("
    SELECT id_patient, nom_patient, prenom_patient, cin_patient
    FROM DISN1IMH_V13_patient
    ORDER BY nom_patient, prenom_patient
");
$patients = $stmt->fetchAll();

// Get stock items list
$stmt = $pdo->query("
    SELECT id_stock, nom_stock
    FROM DISN1IMH_V13_stock
    WHERE statut_stock = 'DISPONIBLE'
    ORDER BY nom_stock
");
$stocks = $stmt->fetchAll();

// Get examens list
$stmt = $pdo->query("
    SELECT id_examen, nom_examen, code_examen
    FROM DISN1IMH_V13_examen
    WHERE statut_examen = 'DISPONIBLE'
    ORDER BY nom_examen
");
$examens = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Nouveau prélèvement</h5>
    </div>
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <select name="id_patient" class="form-select" required>
                        <option value="">Sélectionner un patient</option>
                        <?php foreach ($patients as $p): ?>
                            <option value="<?= $p['id_patient'] ?>">
                                <?= htmlspecialchars($p['nom_patient'] . ' ' . $p['prenom_patient'] . 
                                    ' (CIN: ' . $p['cin_patient'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Type de prélèvement</label>
                    <select name="id_stock" class="form-select" required>
                        <option value="">Sélectionner un type</option>
                        <?php foreach ($stocks as $s): ?>
                            <option value="<?= $s['id_stock'] ?>">
                                <?= htmlspecialchars($s['nom_stock']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Volume (ml)</label>
                    <input type="number" name="volume_ml" class="form-control" 
                           step="0.01" min="0" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date et heure</label>
                    <input type="datetime-local" name="date_prelevement" 
                           class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Examens associés</label>
                    <div class="row g-3">
                        <?php foreach ($examens as $e): ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="examens[]" value="<?= $e['id_examen'] ?>" 
                                           id="examen_<?= $e['id_examen'] ?>">
                                    <label class="form-check-label" for="examen_<?= $e['id_examen'] ?>">
                                        <?= htmlspecialchars($e['nom_examen'] . ' (' . $e['code_examen'] . ')') ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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