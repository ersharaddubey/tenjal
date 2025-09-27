<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

// Fetch service data based on ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        die("Service not found.");
    }
} else {
    die("Invalid ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $service['image']; // Default to existing image

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            $image = 'uploads/' . time() . '_' . basename($_FILES['image']['name']);
            $upload_path = __DIR__ . '/../' . $image;

            // Delete old image if exists and not default
            if (file_exists(__DIR__ . '/../' . $service['image']) && $service['image'] != 'uploads/default.jpg') {
                unlink(__DIR__ . '/../' . $service['image']);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                // Success, image updated
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "Invalid image type or size exceeds 2MB. Allowed: JPEG, PNG, GIF.";
        }
    }

    // Update database
    $stmt = $pdo->prepare("UPDATE services SET title = ?, description = ?, image = ? WHERE id = ?");
    $stmt->execute([$title, $description, $image, $id]);

    header('Location: manage_services.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - Tenjal Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #f0f2f5 0%, #e0e7ff 100%); min-height: 100vh; }
        .img-thumbnail { width: 100px; height: 100px; object-fit: cover; }
        .no-image { background-color: #eee; text-align: center; color: #666; padding: 5px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Service</h2>
        <?php if (isset($error)) { echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>'; } ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($service['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,image/gif">
                <?php if ($service['image'] && file_exists(__DIR__ . '/../' . $service['image'])): ?>
                    <img src="../<?php echo htmlspecialchars($service['image']); ?>" alt="Current Image" class="img-thumbnail mt-2">
                <?php else: ?>
                    <div class="no-image mt-2">No Current Image</div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="manage_services.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>