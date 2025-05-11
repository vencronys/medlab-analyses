<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - MedLab Analyses</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pages/about.css">
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>

    <main class="about-container">
        <section class="hero-section">
            <h1>À Propos de MedLab Analyses</h1>
            <p class="subtitle">Votre partenaire de confiance pour des analyses médicales de qualité depuis 1995</p>
        </section>

        <section class="mission-section">
            <div class="mission-content">
                <h2><i class="fas fa-bullseye"></i> Notre Mission</h2>
                <p>Chez MedLab Analyses, notre mission est de fournir des services d'analyses médicales de la plus haute qualité, avec précision et rapidité, tout en maintenant une approche centrée sur le patient. Nous nous engageons à utiliser les technologies les plus avancées et à maintenir les normes les plus élevées dans tous nos processus.</p>
            </div>
        </section>

        <section class="values-section">
            <h2>Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card">
                    <i class="fas fa-heart"></i>
                    <h3>Excellence</h3>
                    <p>Nous visons l'excellence dans chaque analyse et chaque interaction avec nos patients.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-handshake"></i>
                    <h3>Confiance</h3>
                    <p>Nous construisons des relations de confiance durables avec nos patients et partenaires.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-flask"></i>
                    <h3>Innovation</h3>
                    <p>Nous investissons continuellement dans les dernières technologies et méthodologies.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-users"></i>
                    <h3>Empathie</h3>
                    <p>Nous plaçons le bien-être et le confort de nos patients au centre de nos préoccupations.</p>
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2>Notre Équipe</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="../images/directrice_medical.avif" alt="Dr. Sophie Martin">
                    <h3>Dr. Sophie Martin</h3>
                    <p class="role">Directrice Médicale</p>
                </div>
                <div class="team-member">
                    <img src="../images/chef_labo.avif" alt="Dr. Thomas Bernard">
                    <h3>Dr. Thomas Bernard</h3>
                    <p class="role">Chef de Laboratoire</p>
                </div>
                <div class="team-member">
                    <img src="../images/respo_qualite.avif" alt="Dr. Marie Dubois">
                    <h3>Dr. Marie Dubois</h3>
                    <p class="role">Responsable Qualité</p>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="stat-card">
                <i class="fas fa-user-md"></i>
                <h3>30+</h3>
                <p>Experts Médicaux</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-flask"></i>
                <h3>100K+</h3>
                <p>Analyses par An</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-hospital-user"></i>
                <h3>50K+</h3>
                <p>Patients Satisfaits</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-certificate"></i>
                <h3>25+</h3>
                <p>Années d'Expérience</p>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
