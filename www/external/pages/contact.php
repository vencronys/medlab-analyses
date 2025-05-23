<?php
session_start();
require("logger.php");

// Initialize logger
$logger = new Logger();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /medlab-analyses/www/external/pages/contact-form.php");
    exit();
}

$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$sujet = $_POST['sujet'] ?? '';
$message = $_POST['message'] ?? '';

// Validate inputs
if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
    $logger->logError("Missing required contact form fields");
    header("Location: /medlab-analyses/www/external/pages/contact-form.php?error=Veuillez remplir tous les champs.");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $logger->logError("Invalid email in contact form: $email");
    header("Location: /medlab-analyses/www/external/pages/contact-form.php?error=Email invalide.");
    exit();
}

// Prepare data for Formspree
$formspreeUrl = "https://formspree.io/f/xnndpvoy";
$postData = http_build_query([
    'name' => $nom,
    'email' => $email,
    'subject' => $sujet,
    'message' => $message
]);

// Send to Formspree
$opts = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                   "Content-Length: " . strlen($postData) . "\r\n",
        'content' => $postData
    ]
];

$context = stream_context_create($opts);
$result = @file_get_contents($formspreeUrl, false, $context);

if ($result === false) {
    $logger->logError("Failed to send contact form email from: $email");
    header("Location: /medlab-analyses/www/external/pages/contact-form.php?error=Une erreur est survenue lors de l'envoi du message.");
    exit();
}

// Log successful contact form submission
$logger->log('CONTACT', isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null, "Contact form submitted by: $email");

header("Location: /medlab-analyses/www/external/pages/contact-form.php?success=1");
exit();
?>
