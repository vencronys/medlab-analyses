<?php
session_start();
require("logger.php");

// Initialize logger
$logger = new Logger();

if (isset($_SESSION['id_compte'])) {
    $id_compte = $_SESSION['id_compte'];
    $logger->logLogout($id_compte);
}

// Destroy the session
session_destroy();

// Redirect to home page
header("Location: /medlab-analyses/www/external/index.php");
exit();
?>