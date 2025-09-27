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
    $stmt = $pdo->prepare("SELECT image FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($blog && file_exists('../' . $blog['image']) && $blog['image'] != 'uploads/default.jpg') {
        unlink('../' . $blog['image']);
    }
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: manage_blogs.php');
}

$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$success = isset($_GET['success']) ? 'Blog updated successfully!' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .table-container { max-width: 100%; overflow-x: auto; }
        .table th, .table td { vertical-align: middle; }
        .img-thumbnail { width: 50px; height: 50px; object-fit: cover; }
        .no-image { background-color: #eee; text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Blogs</h2>
            <a href="add_blog.php" class="btn btn-primary">Add New Blog</a>
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
                    <?php if (count($blogs) > 0): ?>
                        <?php foreach ($blogs as $blog): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($blog['id']); ?></td>
                            <td><?php echo htmlspecialchars($blog['title']); ?></td>
                            <td>
                                <?php
                                $image_path = '../' . $blog['image'];
                                if ($blog['image'] && file_exists($image_path)): ?>
                                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="img-thumbnail">
                                <?php else: ?>
                                    <div class="no-image p-2">No Image (Path: <?php echo htmlspecialchars($image_path); ?>)</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_blog.php?id=<?php echo $blog['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                <a href="manage_blogs.php?delete=<?php echo $blog['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No blogs found.</td>
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