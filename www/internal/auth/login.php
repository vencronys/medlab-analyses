<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // For demonstration purposes, we'll use a simple array of users
    // In a real application, you would use a database and proper password hashing
    $users = [
        'admin' => [
            'password' => 'admin123',
            'role' => 'admin'
        ],
        'doctor' => [
            'password' => 'doctor123',
            'role' => 'med'
        ],
        'secretary' => [
            'password' => 'secretary123',
            'role' => 'secretaire'
        ]
    ];

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $users[$username]['role']
        ];
        
        // Redirect based on role
        header("Location: ../pages/{$users[$username]['role']}/dashboard.php");
        exit;
    } else {
        header('Location: ../index.php?error=1');
        exit;
    }
} else {
    header('Location: ../index.php');
    exit;
}
