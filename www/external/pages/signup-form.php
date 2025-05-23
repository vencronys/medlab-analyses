<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Patient</title>
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/medlab-analyses/www/external/css/main.css">
    <link rel="stylesheet" href="/medlab-analyses/www/external/css/pages/signup-form.css">
</head>

<body>
    <div class="sticky-top">
        <?php
        include '../includes/topbar.php';
        include '../includes/navigation.php';
        ?>
    </div>
    <div class="signup-container">
        <div class="signup-box">
            <h1>Inscription Patient</h1>
            <form class="signup-form" method="post" action="signup.php">
                <!-- Patient Information (Left Column) -->
                <div class="form-section patient-info">
                    <h2>Informations personnelles</h2>
                    <div class="form-group">
                        <label for="nom_patient">
                            <i class="fa-solid fa-user"></i>
                            Nom
                        </label>
                        <input type="text" id="nom_patient" name="nom_patient" required pattern="[A-Za-z ]{3,100}">
                    </div>

                    <div class="form-group">
                        <label for="prenom_patient">
                            <i class="fa-solid fa-user"></i>
                            Prénom
                        </label>
                        <input type="text" id="prenom_patient" name="prenom_patient" required pattern="[A-Za-z ]{3,100}">
                    </div>

                    <div class="form-group">
                        <label for="cin_patient">
                            <i class="fa-solid fa-id-card"></i>
                            CIN
                        </label>
                        <input type="text" id="cin_patient" name="cin_patient" required pattern="[A-Za-z0-9]{7}">
                    </div>

                    <div class="form-group">
                        <label for="date_naissance_patient">
                            <i class="fa-solid fa-calendar"></i>
                            Date de naissance
                        </label>
                        <input type="date" id="date_naissance_patient" name="date_naissance_patient" required>
                    </div>

                    <div class="form-group">
                        <label for="sexe_patient">
                            <i class="fa-solid fa-venus-mars"></i>
                            Sexe
                        </label>
                        <select id="sexe_patient" name="sexe_patient" required>
                            <option value="">Sélectionnez votre sexe</option>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="adresse_patient">
                            <i class="fa-solid fa-location-dot"></i>
                            Adresse
                        </label>
                        <textarea id="adresse_patient" name="adresse_patient" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="telephone_patient">
                            <i class="fa-solid fa-phone"></i>
                            Téléphone
                        </label>
                        <input type="tel" id="telephone_patient" name="telephone_patient"
                            pattern="0[0-9]{9}" required>
                    </div>
                </div>

                <!-- Account Information (Right Column) -->
                <div class="form-section account-info">
                    <h2>Informations du compte</h2>
                    <div class="form-group">
                        <label for="email_compte">
                            <i class="fa-solid fa-envelope"></i>
                            Email
                        </label>
                        <input type="email" id="email_compte" name="email_compte" required
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                    </div>

                    <div class="form-group">
                        <label for="mot_de_passe_compte">
                            <i class="fa-solid fa-lock"></i>
                            Mot de passe
                        </label>
                        <input type="password" id="mot_de_passe_compte" name="mot_de_passe_compte"
                            required pattern=".{3,}" title="Le mot de passe doit contenir au moins 8 caractères">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">
                            <i class="fa-solid fa-lock"></i>
                            Confirmer le mot de passe
                        </label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            required pattern=".{3,}">
                    </div>
                </div>

                <button type="submit" class="signup-button">
                    <i class="fa-solid fa-user-plus"></i>
                    Créer mon compte
                </button>

                <div class="form-links">
                    <a href="login-form.php">Déjà inscrit? Se connecter</a>
                </div>
            </form>
        </div>
    </div>
    <?php
    include '../includes/contact.php';
    include '../includes/footer.php';
    ?>
</body>

</html>