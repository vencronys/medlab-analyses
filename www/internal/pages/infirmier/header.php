<?php
session_start();
// if (!isset($_SESSION['user_id']) || $_SESSION['privilege'] !== 'INFIRMIER') {
//     header('Location: /medlab-analyses/www/internal/auth/login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedLab Analyses - Espace Infirmier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/medlab-analyses/www/internal/css/components/main.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MedLab Analyses</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/medlab-analyses/www/internal/pages/infirmier/dashboard.php">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/medlab-analyses/www/internal/pages/infirmier/liste-prelevement.php">Prélèvements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/medlab-analyses/www/internal/pages/infirmier/ajouter-prelevement.php">Nouveau prélèvement</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="/medlab-analyses/www/internal/auth/logout.php" class="btn btn-light">Déconnexion</a>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-4">
