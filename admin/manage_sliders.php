<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("SELECT image FROM sliders WHERE id = ?");
    $stmt->execute([$id]);
    $slider = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($slider && file_exists('../img/' . $slider['image'])) {
        unlink('../img/' . $slider['image']);
    }
    $stmt = $pdo->prepare("DELETE FROM sliders WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: manage_sliders.php');
}

$stmt = $pdo->query("SELECT * FROM sliders ORDER BY id DESC");
$sliders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$success = isset($_GET['success']) ? 'Slider updated successfully!' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sliders - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; min-height: 100vh; }
        .table-container { max-width: 100%; overflow-x: auto; }
        .table th, .table td { vertical-align: middle; }
        .img-thumbnail { width: 100px; height: 50px; object-fit: cover; }
        .no-image { background-color: #eee; text-align: center; color: #666; padding: 5px; }
        .content { display: flex; justify-content: center; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
           <!-- Main Content -->
            <div class="col-12 content">
                <div class="mt-5 w-75"> <!-- w-75 limits the width to 75% for better centering -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Manage Sliders</h2>
                        <a href="add_slider.php" class="btn btn-primary">Add New Slider</a>
                    </div>
                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <div class="table-container">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($sliders) > 0): ?>
                                    <?php foreach ($sliders as $slider): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($slider['id']); ?></td>
                                        <td>
                                            <?php
                                            $image_path = '../img/' . $slider['image'];
                                            if ($slider['image'] && file_exists($image_path)): ?>
                                                <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Slider Image" class="img-thumbnail">
                                            <?php else: ?>
                                                <div class="no-image">No Image (Path: <?php echo htmlspecialchars($image_path); ?>)</div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_slider.php?id=<?php echo $slider['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                            <a href="manage_sliders.php?delete=<?php echo $slider['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this slider?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No sliders found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>