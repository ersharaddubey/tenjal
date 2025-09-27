<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

$error = '';
if (isset($_POST['add'])) {
    $quote = $_POST['quote'];
    $client_name = $_POST['client_name'];
    $profession = $_POST['profession'];
    $image = '';

    if ($_FILES['image']['name']) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            $image = 'uploads/' . time() . '_' . basename($_FILES['image']['name']);
            $upload_path = __DIR__ . '/../' . $image;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $error = "File uploaded successfully at: " . $upload_path;
            } else {
                $error = "Failed to upload image. Check folder permissions.";
            }
        } else {
            $error = "Invalid image type or size exceeds 2MB.";
        }
    }

    $stmt = $pdo->prepare("INSERT INTO testimonials (quote, client_name, profession, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$quote, $client_name, $profession, $image]);
    header('Location: manage_testimonials.php?success=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Testimonial - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Testimonial</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-<?php echo strpos($error, 'successfully') !== false ? 'success' : 'danger'; ?>">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Quote</label>
                <textarea name="quote" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Client Name</label>
                <input type="text" name="client_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Profession</label>
                <input type="text" name="profession" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/gif">
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Testimonial</button>
            <a href="manage_testimonials.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>