<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=laboanalyse;charset=utf8", "root", "");
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display the error message if the connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
