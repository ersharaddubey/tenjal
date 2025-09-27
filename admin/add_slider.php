<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_slider'])) {
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $new_image_name = 'slider_' . time() . '.' . $image_file_type;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $new_image_name)) {
            $stmt = $pdo->prepare("INSERT INTO sliders (image) VALUES (?)");
            $stmt->execute([$new_image_name]);
            header('Location: manage_sliders.php?success=true');
            exit;
        } else {
            $success = 'Error uploading image.';
        }
    } else {
        $success = 'Please select an image to upload.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Slider - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; min-height: 100vh; }
        .form-container { max-width: 500px; margin-top: 50px; }
        .img-preview { max-width: 200px; max-height: 100px; object-fit: cover; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
             <!-- Main Content -->
            <div class="col-12 content">
                <div class="form-container mx-auto">
                    <h2 class="mb-4">Add New Slider</h2>
                    <?php if ($success): ?>
                        <div class="alert alert-<?php echo strpos($success, 'Error') === 0 ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
                            <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" name="add_slider" class="btn btn-primary">Add Slider</button>
                        <a href="manage_sliders.php" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>