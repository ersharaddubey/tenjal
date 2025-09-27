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
    try {
        $stmt = $pdo->prepare("SELECT image FROM services WHERE id = ?");
        $stmt->execute([$id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($service && file_exists('../' . $service['image']) && $service['image'] != 'uploads/default.jpg') {
            unlink('../' . $service['image']);
        }
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: manage_services.php');
    } catch (PDOException $e) {
        echo "Error deleting service: " . $e->getMessage();
    }
}

try {
    $stmt = $pdo->query("SELECT * FROM services ORDER BY id DESC");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $services = [];
    echo "Warning: Table 'services' not found or error: " . $e->getMessage();
}
$success = isset($_GET['success']) ? 'Service updated successfully!' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #f0f2f5 0%, #e0e7ff 100%); min-height: 100vh; }
        .table-container { max-width: 100%; overflow-x: auto; }
        .table th, .table td { vertical-align: middle; }
        .img-thumbnail { width: 50px; height: 50px; object-fit: cover; }
        .no-image { background-color: #eee; text-align: center; color: #666; padding: 5px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Services</h2>
            <a href="add_service.php" class="btn btn-primary">Add New Service</a>
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
                        <th>Title</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($services) > 0): ?>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['id']); ?></td>
                            <td><?php echo htmlspecialchars($service['title']); ?></td>
                            <td>
                                <?php
                                 $image_path = '../' . $service['image'];
                                if ($service['image'] && file_exists(__DIR__ . '/../' . $service['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" class="img-thumbnail">
                                <?php else: ?>
                                    <div class="no-image">No Image (Path: <?php echo htmlspecialchars(__DIR__ . '/../' . ($service['image'] ?? '')); ?>)</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_service.php?id=<?php echo $service['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                <a href="manage_services.php?delete=<?php echo $service['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No services found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>