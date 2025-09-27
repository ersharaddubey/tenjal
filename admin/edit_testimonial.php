<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../include/db_connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
$stmt->execute([$id]);
$testimonial = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$testimonial) {
    die("Testimonial not found.");
}

$error = '';
if (isset($_POST['edit'])) {
    $quote = $_POST['quote'];
    $client_name = $_POST['client_name'];
    $profession = $_POST['profession'];
    $image = $testimonial['image'];

    if ($_FILES['image']['name']) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            $image = 'uploads/' . time() . '_' . basename($_FILES['image']['name']);
            $upload_path = __DIR__ . '/../' . $image; // Updated to match manage_blogs.php relative path

            // Delete old image if exists and not default
            if (file_exists('../' . $testimonial['image']) && $testimonial['image'] != 'uploads/default.jpg') {
                unlink('../' . $testimonial['image']);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                if (file_exists($upload_path)) {
                    $error = "File uploaded successfully at: " . $upload_path;
                } else {
                    $error = "File moved but not found at: " . $upload_path;
                }
            } else {
                $error = "Failed to upload image. Check folder permissions or path: " . $upload_path;
            }
        } else {
            $error = "Invalid image type or size exceeds 2MB. Allowed: JPEG, PNG, GIF.";
        }
    }

    $stmt = $pdo->prepare("UPDATE testimonials SET quote = ?, client_name = ?, profession = ?, image = ? WHERE id = ?");
    $stmt->execute([$quote, $client_name, $profession, $image, $id]);
    header('Location: manage_testimonials.php?success=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Testimonial - Tenjal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <h4 class="text-white mb-0">Edit Testimonial</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-<?php echo strpos($error, 'successfully') !== false ? 'success' : 'danger'; ?>" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="quote" class="form-label">Quote</label>
                        <textarea name="quote" id="quote" class="form-control" rows="3" required><?php echo htmlspecialchars($testimonial['quote'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" name="client_name" id="client_name" class="form-control" value="<?php echo htmlspecialchars($testimonial['client_name'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="profession" class="form-label">Profession</label>
                        <input type="text" name="profession" id="profession" class="form-control" value="<?php echo htmlspecialchars($testimonial['profession'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image (Current: <?php echo htmlspecialchars($testimonial['image'] ?? 'No image'); ?>)</label>
                        <?php if ($testimonial['image'] && file_exists('../' . $testimonial['image'])): ?>
                            <img src="../<?php echo htmlspecialchars($testimonial['image']); ?>" alt="Current Image" class="preview-img img-thumbnail">
                        <?php endif; ?>
                        <input type="file" name="image" id="image" class="form-control mt-2" accept="image/jpeg,image/png,image/gif">
                        <small class="text-muted">Allowed: JPEG, PNG, GIF (Max 2MB)</small>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="edit" class="btn btn-primary">Update Testimonial</button>
                        <a href="manage_testimonials.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>