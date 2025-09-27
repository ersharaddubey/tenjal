<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("Blog not found.");
}

$error = '';
if (isset($_POST['edit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $image = $blog['image'];
    if ($_FILES['image']['name']) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            $image = 'uploads/' . time() . '_' . basename($_FILES['image']['name']);
            $upload_path = __DIR__ . '/../' . $image; // Absolute path from script location

            // Delete old image if exists and not default
            if (file_exists('../' . $blog['image']) && $blog['image'] != 'uploads/default.jpg') {
                unlink('../' . $blog['image']);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                if (file_exists($upload_path)) {
                    $error = "File uploaded successfully at: " . $upload_path; // Debug success
                } else {
                    $error = "File moved but not found at: " . $upload_path; // Debug failure
                }
            } else {
                $error = "Failed to upload image. Check folder permissions or path: " . $upload_path;
            }
        } else {
            $error = "Invalid image type or size exceeds 2MB. Allowed: JPEG, PNG, GIF.";
        }
    }

    $stmt = $pdo->prepare("UPDATE blogs SET title = ?, content = ?, image = ? WHERE id = ?");
    $stmt->execute([$title, $content, $image, $id]);
    header('Location: manage_blogs.php?success=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    <style>
        body {
            background: linear-gradient(135deg, #f0f2f5 0%, #e0e7ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            max-width: 650px;
            width: 100%;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            border-radius: 10px 10px 0 0;
        }
        .form-label {
            font-weight: 500;
            color: #333;
        }
        .preview-img {
            max-width: 250px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: transform 0.3s ease;
        }
        .preview-img:hover {
            transform: scale(1.05);
        }
        .error-msg {
            color: #dc3545;
            margin-bottom: 10px;
            font-weight: 500;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            border: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #3554a7 0%, #0f1c3d 100%);
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .form-container {
                margin: 10px;
                padding: 15px;
            }
            .preview-img {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="text-white mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Blog</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-<?php echo strpos($error, 'successfully') !== false ? 'success' : 'danger'; ?>" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-type me-2"></i>Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label"><i class="bi bi-card-text me-2"></i>Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label"><i class="bi bi-image me-2"></i>Image (Current: <?php echo htmlspecialchars($blog['image']); ?>)</label>
                        <?php if ($blog['image'] && file_exists('../' . $blog['image'])): ?>
                            <img src="../<?php echo htmlspecialchars($blog['image']); ?>" alt="Current Image" class="preview-img img-thumbnail">
                        <?php endif; ?>
                        <input type="file" name="image" id="image" class="form-control mt-2" accept="image/jpeg,image/png,image/gif">
                        <small class="text-muted">Allowed: JPEG, PNG, GIF (Max 2MB)</small>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="edit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>Update Blog</button>
                        <a href="manage_blogs.php" class="btn btn-secondary"><i class="bi bi-x-circle me-2"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>