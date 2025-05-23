<?php
session_start();
if (!isset($_SESSION["id_compte"])) {
    header("Location:/medlab-analyses/www/extern/pages/login-form.php");
    exit();
}

include '../includes/database.php';

$stmt = $conn->prepare('SELECT * FROM disn1imh_v13_patient p INNER JOIN disn1imh_v13_compte c on p.id_compte = c.id_compte WHERE p.id_compte = :id_compte');
$stmt->execute(
    array(
        ':id_compte' => $_SESSION['id_compte']
    )
);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

$nom_patient = $data['nom_patient'];
$prenom_patient = $data['prenom_patient'];
$cin_patient = $data['cin_patient'];
$date_naissance_patient = $data['date_naissance_patient'];
$sexe_patient = $data['sexe_patient'];
$adresse_patient = $data['adresse_patient'];
$telephone_patient = $data['telephone_patient'];
$email_compte = $data['email_compte'];
$mot_de_passe_compte = $data['mot_de_passe_compte'];

// print_r($data);


?>

<!DOCTYPE html>
<html lang="fr">

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
            <h1>Modifier vos information</h1>
            <form class="signup-form" method="post" action="modifier-info.php">
                <!-- Patient Information (Left Column) -->
                <div class="form-section patient-info">
                    <h2>Informations personnelles</h2>
                    <div class="form-group">
                        <label for="nom_patient">
                            <i class="fa-solid fa-user"></i>
                            Nom
                        </label>
                        <?php
                        echo "<input type='text' id='nom_patient' name='nom_patient' value='$nom_patient' required pattern='[A-Za-z ]{3,100}'>";
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="prenom_patient">
                            <i class="fa-solid fa-user"></i>
                            Prénom
                        </label>
                        <?php
                        echo "<input type='text' id='prenom_patient' name='prenom_patient' value='$prenom_patient' required pattern='[A-Za-z ]{3,100}'>";
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="cin_patient">
                            <i class="fa-solid fa-id-card"></i>
                            CIN
                        </label>
                        <?php
                        echo "<input type='text' id='cin_patient' name='cin_patient' value='$cin_patient' required pattern='[A-Za-z]{1}[0-9]{6}'>";
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="date_naissance_patient">
                            <i class="fa-solid fa-calendar"></i>
                            Date de naissance
                        </label>
                        <?php
                        echo "<input type='date' id='date_naissance_patient' name='date_naissance_patient' value='$date_naissance_patient' required>";
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="sexe_patient">
                            <i class="fa-solid fa-venus-mars"></i>
                            Sexe
                        </label>
                        <select id="sexe_patient" name="sexe_patient" required>
                            <?php
                            if ($sexe_patient == 'M') {
                                echo "<option value='M' selected>Masculin</option>";
                                echo "<option value='F'>Féminin</option>";
                            } else {
                                echo "<option value='M'>Masculin</option>";
                                echo "<option value='F' selected>Féminin</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="adresse_patient">
                            <i class="fa-solid fa-location-dot"></i>
                            Adresse
                        </label>
                        <?php
                        echo "<textarea id='adresse_patient' name='adresse_patient' rows='3'>$adresse_patient</textarea>";
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="telephone_patient">
                            <i class="fa-solid fa-phone"></i>
                            Téléphone
                        </label>
                        <?php
                        echo "<input type='tel' id='telephone_patient' name='telephone_patient' value='$telephone_patient'
                            pattern='0[0-9]{9}' required>";
                        ?>
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
                        <?php
                        echo "<input type='email' id='email_compte' name='email_compte' value='$email_compte' required
                            pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}'>";
                        ?>
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
                        <label for="nouveau_mot_de_passe_compte">
                            <i class="fa-solid fa-lock"></i>
                            Nouveau mot de passe (optionnel)
                        </label>
                        <input type="password" id="nouveau_mot_de_passe_compte" name="nouveau_mot_de_passe_compte"
                            pattern=".{3,}" title="Le mot de passe doit contenir au moins 8 caractères">
                    </div>

                    <div class="form-group">
                        <label for="confirm_nouveau_mot_de_passe_compte">
                            <i class="fa-solid fa-lock"></i>
                            Confirmer nouveau mot de passe (optionnel)
                        </label>
                        <input type="password" id="confirm_nouveau_mot_de_passe_compte" name="confirm_nouveau_mot_de_passe_compte"
                            pattern=".{3,}">
                    </div>
                </div>

                <button type="submit" class="signup-button">
                    <i class="fa-solid fa-user-plus"></i>
                    Modifier mes informations
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