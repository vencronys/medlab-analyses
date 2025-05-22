<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php?error=2');
    exit;
}

$role = $_SESSION['user']['privilege'];
$username = $_SESSION['user']['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedLab Analyses - <?php echo ucfirst($role); ?> Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar py-3 min-vh-100">
                <div class="position-sticky">
                    <div class="text-center mb-4">
                        <h5>MedLab Analyses</h5>
                        <p class="text-muted"><?php echo ucfirst($role); ?> Panel</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        
                        <?php if ($role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">
                                <i class="bi bi-people"></i> Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reports.php">
                                <i class="bi bi-file-text"></i> Reports
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if ($role === 'med'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="patients.php">
                                <i class="bi bi-person"></i> Patients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="analyses.php">
                                <i class="bi bi-clipboard2-pulse"></i> Analyses
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if ($role === 'secretaire'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="rdv.php">
                                <i class="bi bi-calendar"></i> Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="patients.php">
                                <i class="bi bi-person"></i> Patient Records
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <li class="nav-item mt-3">
                            <a class="nav-link text-danger" href="../../auth/logout.php">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo $pageTitle ?? 'Dashboard'; ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span class="text-muted">Welcome, <?php echo htmlspecialchars($username); ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Page content will be inserted here -->
                <?php if (isset($content)) echo $content; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>