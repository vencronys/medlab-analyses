<!DOCTYPE html>
<?php
session_start();
require("logger.php");

// Initialize logger
$logger = new Logger();

// Log form access
if (isset($_SESSION['id_compte'])) {
    $logger->log('FORM_ACCESS', $_SESSION['id_compte'], 'Accessed appointment booking form');
} else {
    $logger->log('FORM_ACCESS', null, 'Guest accessed appointment booking form');
    header("Location: /medlab-analyses/www/external/pages/login-form.php");
    exit();
}

if (isset($_SESSION['statut_compte']) && $_SESSION['statut_compte'] == 'INACTIF') {
    $logger->log('FORM_ACCESS', $_SESSION['id_compte'], 'Accessed appointment booking form with INACTIF statut');
    header("Location: /medlab-analyses/www/external/pages/profile.php?error=rak-msusspandi-asa7bi");
    exit();
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/medlab-analyses/www/external/css/main.css">
    <link rel="stylesheet" href="/medlab-analyses/www/external/css/pages/rdv-form.css">
</head>

<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>
    <div class="rdv-container">
        <div class="rdv-box">
            <h1>Prise de rendez-vous</h1>
            <form class="rdv-form" method="post" action="rdv.php">
                <!-- Patient Information (Left Column) -->
                <div class="form-section patient-info">
                    <h2>Informations personnelles</h2>
                    <div class="form-group">
                        <label for="date_rdv">
                            <i class="fa-solid fa-calendar"></i>
                            Date
                        </label>
                        <input type="datetime-local" id="date_rdv" name="date_rdv" required>
                    </div>

                    <div class="form-group">
                        <label for="motif_rdv">
                            <i class="fa-solid fa-stethoscope"></i>
                            Motif
                        </label>
                        <textarea name="motif_rdv" id="motif_rdv" required rows="7"></textarea>
                    </div>
                </div>

                <button type="submit" class="rdv-button">
                    <i class="fa-solid fa-calendar-plus"></i>
                    Prendre rendez-vous
                </button>
            </form>
        </div>
    </div>
    <?php
    include '../includes/contact.php';
    include '../includes/footer.php';
    ?>
</body>

</html>