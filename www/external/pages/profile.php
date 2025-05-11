<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['id_compte'])) {
    header('Location: login.php');
    exit();
}

$id_compte = $_SESSION['id_compte'];

include('../includes/database.php');

$query = "SELECT p.*, c.email_compte, c.statut_compte FROM disn1imh_v13_patient p INNER JOIN disn1imh_v13_compte c ON p.id_compte = c.id_compte WHERE p.id_compte = :id_compte";
$stmt = $conn->prepare($query);
$stmt->execute([
    "id_compte" => $_SESSION["id_compte"]
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$id_patient = $result[0]['id_patient'];
$nom_patient = $result[0]["nom_patient"];
$prenom_patient = $result[0]["prenom_patient"];
$cin_patient = $result[0]["cin_patient"];
$date_naissance_patient = $result[0]["date_naissance_patient"];
$sexe_patient = $result[0]["sexe_patient"];
$adresse_patient = $result[0]["adresse_patient"];
$telephone_patient = $result[0]["telephone_patient"];
$email_compte = $result[0]["email_compte"];
$statut_compte = $result[0]["statut_compte"];

$query = "SELECT * FROM disn1imh_v13_rdv r WHERE (SELECT p.id_patient FROM disn1imh_v13_patient p WHERE p.id_compte = :id_compte AND r.statut_rdv NOT in ('ANNULE', 'TERMINE'))";
$stmt = $conn->prepare($query);
$stmt->execute([
    "id_compte" => $_SESSION["id_compte"]
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$list_rdv = $result;


$query = "SELECT e.nom_examen, T.date_analyse
            FROM (SELECT e.id_examen, ag.date_analyse_generale as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_generale ag
                        ON e.id_examen = ag.id_examen
                    WHERE ag.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, ac.date_analyse_cholesterol as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_cholesterol ac
                        ON e.id_examen = ac.id_examen
                    WHERE ac.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, agl.date_analyse_glucose as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_glucose agl
                        ON e.id_examen = agl.id_examen
                    WHERE agl.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, ah.date_analyse_hemoglobine as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_hemoglobine ah
                        ON e.id_examen = ah.id_examen
                    WHERE ah.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, avd.date_analyse_vitamine_d as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_vitamine_d avd
                        ON e.id_examen = avd.id_examen
                    WHERE avd.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                ) T
                INNER JOIN disn1imh_v13_examen e ON T.id_examen = e.id_examen
                INNER JOIN disn1imh_v13_prelevement_examen pe ON e.id_examen = pe.id_examen
                INNER JOIN disn1imh_v13_prelevement p ON pe.id_prelevement = p.id_prelevement
            WHERE p.id_patient = :id_patient AND (exists (SELECT * FROM disn1imh_v13_analyse_generale ag
                                            WHERE (ag.id_prelevement = p.id_prelevement AND ag.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_cholesterol ac
                                            WHERE (ac.id_prelevement = p.id_prelevement AND ac.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_glucose agl
                                            WHERE (agl.id_prelevement = p.id_prelevement AND agl.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_hemoglobine ah
                                            WHERE (ah.id_prelevement = p.id_prelevement AND ah.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_vitamine_d avd
                                            WHERE (avd.id_prelevement = p.id_prelevement AND avd.id_examen = pe.id_examen)));";

$stmt = $conn->prepare($query);
$stmt->execute([
    "id_patient" => $id_patient
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$list_examens = $result;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - MedLab Analyses</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pages/profile.css">
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>

    <main class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="profile-info">
                <h1>Bienvenue, <?php echo htmlspecialchars($nom_patient); ?></h1>
                <p class="last-visit">Dernière visite: <?php echo date('d/m/Y'); ?></p>
                <?php if ($statut_compte == 'INACTIF') { ?>
                    <p class="last-visit">Statut: <span class="inactif">INACTIF</span></p>
                <?php } ?>
            </div>
        </div>

        <div class="profile-grid">
            <section class="profile-card personal-info">
                <h2><i class="fas fa-id-card"></i> Informations Personnelles</h2>
                <div class="info-content flex flex-dir-col">
                    <div class="info-group">
                        <label>Nom:</label>
                        <p><?php echo htmlspecialchars("$nom_patient $prenom_patient"); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Email:</label>
                        <p><?php echo htmlspecialchars($email_compte); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Téléphone:</label>
                        <p><?php echo htmlspecialchars($telephone_patient); ?></p>
                    </div>
                    <a href="/medlab-analyses/www/external/pages/modifier-info-form.php"
                        class="btn-edit btn-new-appointment">Modifier mes informations</a>
                </div>
            </section>

            <section class="profile-card recent-results">
                <h2><i class="fas fa-flask"></i> Derniers Résultats</h2>
                <div class="results-list">
                    <?php
                    if (count($list_examens) == 0) {
                        echo "<p>Aucun examen trouvé.</p>";
                    } else {
                        foreach ($list_examens as $row) {
                            echo "<div class='result-item'>";
                            echo "<div class='result-info'>";
                            echo "<h3>" . htmlspecialchars($row['nom_examen']) . "</h3>";
                            echo "<p class='date'>" . htmlspecialchars($row['date_analyse']) . "</p>";
                            echo "</div>";
                            echo "<a href='#' class='btn-view'>Voir <i class='fas fa-chevron-right'></i></a>";
                            echo "</div>";
                        }
                    }
                    ?>
                    <!-- <div class="result-item">
                        <div class="result-info">
                            <h3>Analyse Generale</h3>
                            <p class="date">28/04/2025</p>
                        </div>
                        <a href="#" class="btn-view">Voir <i class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="result-item">
                        <div class="result-info">
                            <h3>Analyse de cholesterole</h3>
                            <p class="date">15/04/2025</p>
                        </div>
                        <a href="#" class="btn-view">Voir <i class="fas fa-chevron-right"></i></a>
                    </div> -->
                </div>
            </section>

            <section class="profile-card upcoming-appointments">
                <h2><i class="fas fa-calendar-alt"></i> Rendez-vous à Venir</h2>
                <div class="appointments-list">


                    <?php

                    if (count($list_rdv) == 0) {
                        echo "<p>Aucun rendez-vous à venir.</p>";
                    } else {

                        foreach ($list_rdv as $row) {
                            echo "<div class='appointment-item'>";
                            echo "<div class='appointment-info'>";
                            echo "<h3>Prise de Sang</h3>";
                            echo "<p class='date'><i class='fas fa-clock'></i> " . $row['date_rdv'] . "</p>";
                            echo "<p class='statut'>";
                            switch ($row['statut_rdv']) {
                                case 'EN_ATTENTE':
                                    echo "<i class='fas fa-hourglass-half'></i> Status: En attente";
                                    break;
                                case 'CONFIRME':
                                    echo "<i class='fas fa-check-circle'></i> Status: Confirmé";
                                    break;
                                case 'ANNULE':
                                    echo "<i class='fas fa-times-circle'></i> Status: Annulé";
                                    break;
                                case 'TERMINE':
                                    echo "<i class='fas fa-check-double'></i> Status: Terminé";
                                    break;
                            }
                            echo "</p>";
                            echo "</div>";
                            echo "<div class='appointment-actions'>";
                            echo "<a href='/medlab-analyses/www/external/pages/annuler-rdv.php?id_rdv=" . $row['id_rdv'] . "' class='btn-cancel'>Annuler</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
                <a href="/medlab-analyses/www/external/pages/rdv-form.php" class="btn-new-appointment">Nouveau
                    Rendez-vous</a>
            </section>

            <section class="profile-card preferences">
                <h2><i class="fas fa-cog"></i> Préférences</h2>
                <div class="preferences-content">
                    <div class="preference-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span>Notifications par email</span>
                    </div>
                    <div class="preference-item">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <span>Notifications SMS</span>
                    </div>
                    <div class="preference-item">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                        <span>Rappels de rendez-vous</span>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>