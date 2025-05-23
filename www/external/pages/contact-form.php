<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - MedLab Analyses</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pages/contact-form.css">
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>

    <main class="form-container">
        <div class="form-box">
            <h2>Contactez-nous</h2>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success">
                    Votre message a été envoyé avec succès!
                </div>
            <?php } ?>

            <form action="contact.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="nom"><i class="fas fa-user"></i>Nom complet:</label>
                    <input type="text" id="nom" name="nom" required>
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i>Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="sujet"><i class="fas fa-heading"></i>Sujet:</label>
                    <input type="text" id="sujet" name="sujet" required>
                </div>

                <div class="form-group">
                    <label for="message"><i class="fas fa-comment"></i>Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer
                </button>
            </form>
        </div>
    </main>
    <?php include '../includes/contact.php'; ?>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
