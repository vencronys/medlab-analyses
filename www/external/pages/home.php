<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - MedLab Analyses</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pages/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0056b3;
            --primary-color-dark: #004085;
            --accent-color: #ffd700;
            --accent-color-hover: #ffc107;
            --text-color: #333;
            --white: #fff;
            --shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="home-page">
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>

    <main class="main-container">
        <section class="hero">
            <div class="hero-content">
                <h1>Bienvenue chez MedLab Analyses</h1>
                <p>Votre laboratoire d'analyses médicales de confiance</p>
                <div class="hero-buttons">
                    <a href="services.php" class="btn primary">Nos Services</a>
                    <a href="contact-form.php" class="btn secondary">Nous Contacter</a>
                </div>
            </div>
        </section>

        <section class="quick-actions">
            <div class="action-card">
                <i class="fas fa-file-medical"></i>
                <h3>Résultats en Ligne</h3>
                <p>Accédez à vos résultats d'analyses en toute sécurité</p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="action-link">Voir mes résultats</a>
                <?php else: ?>
                    <a href="login.php" class="action-link">Se connecter</a>
                <?php endif; ?>
            </div>
            
            <div class="action-card">
                <i class="fas fa-calendar-alt"></i>
                <h3>Rendez-vous</h3>
                <p>Planifiez votre visite en quelques clics</p>
                <a href="contact-form.php" class="action-link">Prendre RDV</a>
            </div>

            <div class="action-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Nos Centres</h3>
                <p>Trouvez le laboratoire le plus proche</p>
                <a href="about.php" class="action-link">Localiser</a>
            </div>
        </section>

        <section class="featured-services">
            <h2>Services Populaires</h2>
            <div class="services-slider">
                <div class="service-slide">
                    <i class="fas fa-flask"></i>
                    <h3>Analyses Sanguines</h3>
                    <p>Résultats précis en 24h</p>
                </div>
                <div class="service-slide">
                    <i class="fas fa-virus"></i>
                    <h3>Tests COVID-19</h3>
                    <p>PCR et tests antigéniques</p>
                </div>
                <div class="service-slide">
                    <i class="fas fa-heartbeat"></i>
                    <h3>Bilans Cardiaques</h3>
                    <p>Suivi personnalisé</p>
                </div>
            </div>
        </section>

        <section class="info-section">
            <div class="info-content">
                <div class="info-text">
                    <h2>Pourquoi Nous Choisir?</h2>
                    <ul class="benefits-list">
                        <li><i class="fas fa-check-circle"></i> Équipements de dernière génération</li>
                        <li><i class="fas fa-check-circle"></i> Personnel hautement qualifié</li>
                        <li><i class="fas fa-check-circle"></i> Résultats rapides et fiables</li>
                        <li><i class="fas fa-check-circle"></i> Accréditation internationale</li>
                    </ul>
                </div>
                <div class="info-stats">
                    <div class="stat">
                        <span class="stat-number">30+</span>
                        <span class="stat-label">Années d'Expérience</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">50k+</span>
                        <span class="stat-label">Patients Satisfaits</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">100+</span>
                        <span class="stat-label">Types d'Analyses</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="news-section">
            <h2>Actualités</h2>
            <div class="news-grid">
                <article class="news-card">
                    <div class="news-content">
                        <h3>Nouveau Service de Téléconsultation</h3>
                        <p>Consultez nos experts en ligne pour l'interprétation de vos résultats.</p>
                        <span class="news-date">4 Mai 2025</span>
                    </div>
                </article>
                <article class="news-card">
                    <div class="news-content">
                        <h3>Horaires Étendus</h3>
                        <p>Notre laboratoire est maintenant ouvert le samedi matin.</p>
                        <span class="news-date">1 Mai 2025</span>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
