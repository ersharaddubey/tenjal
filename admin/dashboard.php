<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tenjal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
     <link href="../css/admin.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            min-height: 100vh;
            overflow-x: hidden;
        }  
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'Sidebar.php'; ?>
            <!-- Main Content -->
            <div class="col-9 content">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-dashboard p-4">
                            <h2 class="mb-4">Admin Dashboard</h2>
                            <p class="text-muted">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>! Manage your website content from here.</p>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-journal-text fs-1 text-primary"></i>
                                            <h5 class="mt-3">Blogs</h5>
                                            <p class="text-muted">Manage blog posts</p>
                                            <a href="manage_blogs.php" class="btn btn-outline-primary btn-sm">Go</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-chat-quote fs-1 text-info"></i>
                                            <h5 class="mt-3">Testimonials</h5>
                                            <p class="text-muted">Manage testimonials</p>
                                            <a href="manage_testimonials.php" class="btn btn-outline-info btn-sm">Go</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-gear fs-1 text-warning"></i>
                                            <h5 class="mt-3">Services</h5>
                                            <p class="text-muted">Manage services</p>
                                            <a href="manage_services.php" class="btn btn-outline-warning btn-sm">Go</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-images fs-1 text-secondary"></i>
                                            <h5 class="mt-3">Sliders</h5>
                                            <p class="text-muted">Manage sliders</p>
                                            <a href="manage_sliders.php" class="btn btn-outline-secondary btn-sm">Go</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>