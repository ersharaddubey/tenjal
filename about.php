<?php include './include/header.php'; 
include './include/db_connect.php';

// Fetch About Page Content
$stmt = $pdo->prepare("SELECT * FROM pages WHERE slug = ?");
$stmt->execute(['about']);
$page = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<body>
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 " data-wow-delay="0.2s">
                    <img class="img-fluid mb-3" src="<?php echo $page['image']; ?>" alt="">
                </div>
                <div class="col-lg-6" data-wow-delay="0.5s">
                    <h1 class="font-dancing-script text-primary"><?php echo $page['title']; ?></h1>
                    <h1 class="mb-5">Discover Tenjal Mineral Water</h1>
                    <p class="mb-4 text-justify"><?php echo $page['content']; ?></p>
                    <ul><li>Commitment to Purity</li>
                        <li>Health & Hydration</li>
                        <li>Sustainability Focus</li>
                        <li>Trust & Quality</li>
                    </ul>
               </div>
            </div>
            <!-- ... rest same ... -->
        </div>
    </div>
      <!-- Testimonial End -->
    <div class="container mb-5">
    <div class="card-columns">
        <?php
        $stmt = $pdo->query("SELECT * FROM blogs");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
        <div class="card hero-header h-100 d-flex flex-column">
            <a href="Blog-details.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">
                <img class="card-img-top" src="' . $row['image'] . '" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">' . $row['title'] . '</h5>
                    <p class="card-text">' . substr($row['content'], 0, 200) . '...</p>
                </div>
            </a>
            <div class="card-footer mt-auto border-0 bg-transparent">
                <a href="Blog-details.php?id=' . $row['id'] . '" class="btn btn-prime w-100 py-3 ms-0">View More</a>
            </div>
        </div>';
        }
        ?>
    </div>
</div>
    <!-- ... team and testimonials same ... -->
  <?php include './include/footer.php'; ?>
</body>
</html>