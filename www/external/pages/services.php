<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services - MedLab Analyses</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pages/services.css">
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>

    <main class="services-container">
        <h1>Nos Services</h1>
        
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-flask"></i>
                <h3>Analyses Sanguines</h3>
                <p>Analyses complètes du sang incluant hémogramme, glycémie, cholestérol et plus encore.</p>
            </div>

            <div class="service-card">
                <i class="fas fa-heartbeat"></i>
                <h3>Bilans Cardiaques</h3>
                <p>Tests spécialisés pour évaluer la santé cardiaque et prévenir les maladies cardiovasculaires.</p>
            </div>

            <div class="service-card">
                <i class="fas fa-dna"></i>
                <h3>Tests Génétiques</h3>
                <p>Analyses génétiques avancées pour le dépistage et le diagnostic de maladies héréditaires.</p>
            </div>

            <div class="service-card">
                <i class="fas fa-virus"></i>
                <h3>Tests COVID-19</h3>
                <p>Tests PCR et sérologiques pour le dépistage du COVID-19 avec résultats rapides.</p>
            </div>

            <div class="service-card">
                <i class="fas fa-microscope"></i>
                <h3>Analyses Microbiologiques</h3>
                <p>Identification des agents pathogènes et tests de sensibilité aux antibiotiques.</p>
            </div>

            <div class="service-card">
                <i class="fas fa-allergies"></i>
                <h3>Tests d'Allergies</h3>
                <p>Dépistage complet des allergies alimentaires et environnementales.</p>
            </div>
        </div>

        <section class="service-features">
            <h2>Pourquoi Choisir MedLab Analyses?</h2>
            <div class="features-grid">
                <div class="feature">
                    <i class="fas fa-clock"></i>
                    <h4>Résultats Rapides</h4>
                    <p>Résultats disponibles en ligne sous 24-48h.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-user-md"></i>
                    <h4>Équipe Expérimentée</h4>
                    <p>Personnel qualifié et expérimenté.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Accréditation</h4>
                    <p>Laboratoire certifié aux normes internationales.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
