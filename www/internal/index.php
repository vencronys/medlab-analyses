<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    header("Location: pages/$role/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedLab Analyses - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="text-primary">MedLab Analyses</h2>
                            <p class="text-muted">Internal Portal</p>
                        </div>

                        <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php 
                            $error_msg = 'An error occurred';
                            switch($_GET['error']) {
                                case '1':
                                    $error_msg = 'Invalid username or password';
                                    break;
                                case '2':
                                    $error_msg = 'Please login to access the system';
                                    break;
                            }
                            echo htmlspecialchars($error_msg);
                            ?>
                        </div>
                        <?php endif; ?>

                        <form action="auth/login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>