<?php
session_start();
if (!isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}

if (
    isset($_POST["nom"], $_POST["prenom"], $_POST["cin"], $_POST["date_naissance"],
          $_POST["sexe"], $_POST["adresse"], $_POST["telephone"], $_POST["salaire"],
          $_POST["date_embauche"], $_POST["email"], $_POST["Privilège"],
          $_POST["mot_de_passe"], $_POST["confirmer_password"])
) {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $cin = trim($_POST["cin"]);
    $date_naissance = $_POST["date_naissance"];
    $sexe = $_POST["sexe"];
    $adresse = trim($_POST["adresse"]);
    $telephone = trim($_POST["telephone"]);
    $salaire = $_POST["salaire"];
    $date_embauche = $_POST["date_embauche"];
    $email = trim($_POST["email"]);
    $Privilège = $_POST["Privilège"];
    $mot_de_passe = $_POST["mot_de_passe"];
    $confirmer_password = $_POST["confirmer_password"];
    $id_medecin = $_SESSION["medecin_id"];
    $date_ajout = date("Y-m-d");

    if (
        !empty($nom) && preg_match("/^[A-Za-zÀ-ÿ '-]{3,30}$/", $nom) &&
        !empty($prenom) && preg_match("/^[A-Za-zÀ-ÿ '-]{3,30}$/", $prenom) &&
        !empty($cin) && preg_match("/^[A-Za-z0-9]{6,12}$/", $cin) &&
        !empty($date_naissance) &&
        !empty($sexe) &&
        !empty($adresse) &&
        !empty($telephone) && preg_match("/^[0-9]{10,15}$/", $telephone) &&
        !empty($salaire) && is_numeric($salaire) && $salaire >= 0 &&
        !empty($date_embauche) &&
        !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) &&
        !empty($Privilège) &&
        !empty($mot_de_passe) && strlen($mot_de_passe) >= 6 &&
        $mot_de_passe === $confirmer_password
    ) {
        // Hachage du mot de passe
        $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Connexion et insertion
        $conn = new PDO("mysql:host=localhost;dbname=DISN1IMH_V1", "root", "");
        $stmt = $conn->prepare("INSERT INTO employes 
            (nom, prenom, cin, date_naissance, sexe, adresse, telephone, salaire, date_embauche, email, Privilège, mot_de_passe, date_ajout, id_medecin)
            VALUES 
            (:nom, :prenom, :cin, :date_naissance, :sexe, :adresse, :telephone, :salaire, :date_embauche, :email, :Privilège, :mot_de_passe, :date_ajout, :id_medecin)
        ");

        $stmt->execute(array(
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":cin" => $cin,
            ":date_naissance" => $date_naissance,
            ":sexe" => $sexe,
            ":adresse" => $adresse,
            ":telephone" => $telephone,
            ":salaire" => $salaire,
            ":date_embauche" => $date_embauche,
            ":email" => $email,
            ":Privilège" => $Privilège,
            ":mot_de_passe" => $hashed_password,
            ":date_ajout" => $date_ajout,
            ":id_medecin" => $id_medecin
        ));

        $conn = null;

        header("Location: liste_employes.php?success=1");
        exit();
    } else {
        echo " Vérifiez les champs saisis. Tous les champs sont obligatoires et doivent être valides.";
    }
} else {
    echo " Données manquantes. Veuillez soumettre le formulaire correctement.";
}
?>
