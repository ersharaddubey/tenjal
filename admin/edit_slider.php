<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$slider = [];
$success = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM sliders WHERE id = ?");
    $stmt->execute([$id]);
    $slider = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_slider'])) {
    $image = $slider['image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $new_image_name = 'slider_' . time() . '.' . $image_file_type;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $new_image_name)) {
            if ($slider['image'] && file_exists($target_dir . $slider['image'])) {
                unlink($target_dir . $slider['image']);
            }
            $image = $new_image_name;
        }
    }

    $stmt = $pdo->prepare("UPDATE sliders SET image = ? WHERE id = ?");
    $stmt->execute([$image, $id]);
    header('Location: manage_sliders.php?success=true');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slider - Tenjal</title>
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
                    <h2 class="mb-4">Edit Slider</h2>
                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <?php if ($slider && $slider['image'] && file_exists('../img/' . $slider['image'])): ?>
                                <img src="../img/<?php echo htmlspecialchars($slider['image']); ?>" alt="Current Image" class="img-preview mt-2">
                            <?php endif; ?>
                        </div>
                        <button type="submit" name="update_slider" class="btn btn-primary">Update Slider</button>
                        <a href="manage_sliders.php" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>