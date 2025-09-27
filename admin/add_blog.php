<?php
session_start();
if (!isset($_SESSION['admin_id'])) header('Location: login.php');

include '../include/db_connect.php';

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = 'admin';
    $created_at = date('Y-m-d');

    // Image Upload
    $image = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], '../' . $image);

    $stmt = $pdo->prepare("INSERT INTO blogs (title, content, image, author, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $image, $author, $created_at]);
    header('Location: manage_blogs.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Blog</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Blog</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Blog</button>
        </form>
        <a href="manage_blogs.php" class="btn btn-secondary">Cancel</a>
    </div>
</body>
</html>