<?php include './include/header.php'; 
include './include/db_connect.php'; // Fixed path

$blog = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($blog) {
        // Update views
        $updateStmt = $pdo->prepare("UPDATE blogs SET views = views + 1 WHERE id = ?");
        $updateStmt->execute([$id]);
    } else {
        echo "<h1>Blog not found</h1>";
    }
} else {
    echo "<h1>No blog ID provided. <a href='Blog.php'>Go to Blog List</a></h1>"; // Friendly message instead of die
}
?>
<body>
    <!-- About End -->
    <?php if ($blog): ?>
    <div class="container my-5">
        <div class="row">
        <!-- Main Content -->
            <div class="col-lg-10 mx-auto">
                <h1 class="mb-3"><?php echo htmlspecialchars($blog['title']); ?></h1>
                 <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="Blog image" class="blog-img mb-4">
                <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
                <p><small class="text-muted">Views: <?php echo $blog['views']; ?> | Author: <?php echo htmlspecialchars($blog['author']); ?> | Date: <?php echo $blog['created_at']; ?></small></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- Blog End-->

  <?php include './include/footer.php'; ?>
</body>
</html>