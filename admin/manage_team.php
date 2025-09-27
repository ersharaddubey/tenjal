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
    $stmt = $pdo->prepare("SELECT image FROM team WHERE id = ?");
    $stmt->execute([$id]);
    $team = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($team && file_exists('../' . $team['image']) && $team['image'] != 'uploads/default.jpg') {
        unlink('../' . $team['image']);
    }
    $stmt = $pdo->prepare("DELETE FROM team WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: manage_team.php');
}

$stmt = $pdo->query("SELECT * FROM team ORDER BY id DESC");
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
$success = isset($_GET['success']) ? 'Team member updated successfully!' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team Members - Tenjal</title>
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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-12 col-md-3">
                <?php include 'Sidebar.php'; ?>
            </div>

            <!-- Main Content -->
            <div class="col-12 col-md-9 content">
                <div class="mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Manage Team Members</h2>
                        <a href="add_team.php" class="btn btn-primary">Add New Team Member</a>
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
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($teams) > 0): ?>
                                    <?php foreach ($teams as $team): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($team['id']); ?></td>
                                        <td><?php echo htmlspecialchars($team['name']); ?></td>
                                        <td>
                                            <?php
                                            $image_path = '/tenjal/uploads/' . $team['image'];
                                            if ($team['image'] && file_exists(__DIR__ . '/../' . $team['image'])): ?>
                                                <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($team['name']); ?>" class="img-thumbnail">
                                            <?php else: ?>
                                                <div class="no-image">No Image (Path: <?php echo htmlspecialchars(__DIR__ . '/../' . $team['image']); ?>)</div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_team.php?id=<?php echo $team['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                            <a href="manage_team.php?delete=<?php echo $team['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this team member?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No team members found.</td>
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