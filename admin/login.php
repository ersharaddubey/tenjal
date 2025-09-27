<?php
session_start();
include '../include/db_connect.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: dashboard.php');
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap 5 CSS -->
    <style>
        body { background-color: #f8f9fa; } /* Light background */
        .login-card { max-width: 400px; margin: auto; margin-top: 100px; } /* Center card */
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-card">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Admin Login</h3>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username" required>
                                <label for="floatingUsername">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap 5 JS (optional for interactivity) -->
</body>
</html>