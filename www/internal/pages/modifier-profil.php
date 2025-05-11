<?php
session_start();

// Vérifier si le médecin est connecté
if (!isset($_SESSION['medecin_id'])) {
    header('Location: login.php');
    exit();
}

// Vérifier que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connexion à la base de données
    try {
        $conn = new PDO("mysql:host=localhost;dbname=DISN1IMH_V1", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des données du formulaire
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $cin = $_POST['cin'];
        $date_naissance = $_POST['date_naissance'];
        $sexe = $_POST['sexe'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $salaire = $_POST['salaire'];
        $date_embauche = $_POST['date_embauche'];
        $email = $_POST['email'];
        $mot_de_passe = trim($_POST['mot_de_passe']);
        $privilege = $_POST['privilege'];

        // Rechercher l'ancien mot de passe
        $stmt = $conn->prepare("SELECT mot_de_passe FROM employes WHERE id = ?");
        $stmt->execute([$id]);
        $ancienMotDePasse = $stmt->fetchColumn();

        // Si l'utilisateur a modifié le mot de passe, on le chiffre
        if (!empty($mot_de_passe) && !password_verify($mot_de_passe, $ancienMotDePasse)) {
            $mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        } else {
            $mot_de_passe = $ancienMotDePasse; // garder l'ancien si inchangé
        }

        // Mettre à jour les informations
        $stmt = $conn->prepare("
            UPDATE employes SET 
                nom = ?, 
                prenom = ?, 
                cin = ?, 
                date_naissance = ?, 
                sexe = ?, 
                adresse = ?, 
                telephone = ?, 
                salaire = ?, 
                date_embauche = ?, 
                email = ?, 
                mot_de_passe = ?, 
                privilege = ? 
            WHERE id = ?
        ");

        $stmt->execute([
            $nom, $prenom, $cin, $date_naissance, $sexe, $adresse, $telephone,
            $salaire, $date_embauche, $email, $mot_de_passe, $privilege, $id
        ]);

        // Rediriger avec message de succès
        header("Location: profil.php?message=modification_reussie");
        exit();

    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
        exit();
    }
} else {
    echo "Méthode non autorisée.";
    exit();
}
