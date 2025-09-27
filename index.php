<?php
include './include/header.php';
include 'db_connect.php';
?>
<body>
<!-- Hero Start -->
<div class="container-fluid p-0 hero-header bg-light mb-5">
    <div class="container p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 hero-header-text py-5">
                <div class="py-5 px-3 ps-lg-0">
                    <h1 class="font-dancing-script text-primary animated slideInLeft">Welcome</h1>
                    <h1 class="display-1 mb-4 animated slideInLeft">India's Most Trusted Water Brand</h1>
                    <div class="row g-4 animated slideInLeft">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="btn-square btn btn-prime flex-shrink-0">
                                    <i class="fa fa-phone text-dark"></i>
                                </div>
                                <div class="px-3">
                                    <h5 class="text-primary mb-0">Call Us</h5>
                                    <p class="fs-5 text-dark mb-0">+91-18008331809</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="btn-square btn btn-prime flex-shrink-0">
                                    <i class="fa fa-envelope text-dark"></i>
                                </div>
                                <div class="px-3">
                                    <h5 class="text-primary mb-0">Mail Us</h5>
                                    <p class="fs-5 text-dark mb-0">info@tenjal.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="owl-carousel header-carousel animated fadeIn">
                    <?php
                    $stmt = $pdo->query("SELECT image FROM sliders ORDER BY id DESC");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $image_path = 'img/' . $row['image']; // Adjust path based on your structure
                        echo '<img class="img-fluid" src="' . htmlspecialchars($image_path) . '" alt="Slider Image">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 " data-wow-delay="0.2s">
                <img class="img-fluid mb-3" style="border-radius: 30%;" src="img/about.jpg" alt="">
            </div>
            <div class="col-lg-6 " data-wow-delay="0.5s">
                <h1 class="font-dancing-script text-primary">Join Us</h1>
                <div class="d-flex align-items-center bg-light">
                    <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                        <i class="fa fa-phone fa-2x text-dark"></i>
                    </div>
                    <div class="px-3">
                        <h3>Emergency Water Delivery</h3>
                        <span>We’re available 24/7/365 because hydration emergencies don’t wait. Call us now.</span>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-light mt-4">
                    <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                        <i class="fa fa-phone fa-2x text-dark"></i>
                    </div>
                    <div class="px-3">
                        <h3>Mineral Water Services</h3>
                        <span>Need to restock your supply or have a special delivery request? Chat With Us For Request</span>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-light mt-4">
                    <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                        <i class="fa fa-phone fa-2x text-dark"></i>
                    </div>
                    <div class="px-3">
                        <h3>+91-18008331809</h3>
                        <span>Call us direct 24/7 for get a free consultation</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Service Start -->
<div class="container-fluid service py-5">
    <div class="container hero-header">
        <div class="text-center " data-wow-delay="0.1s">
            <h1 class="font-dancing-script text-primary">Our Services</h1>
            <h1 class="mb-5">Explore Our Services</h1>
        </div>
        <div class="row g-4 g-md-0 text-center">
            <?php
            $stmt = $pdo->query("SELECT * FROM services LIMIT 6"); // Show 6 for index
            $delay = 0.1;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <div class="col-md-6 col-lg-4">
                    <div class="service-item h-100 p-4 border-bottom border-end " data-wow-delay="' . $delay . 's">
                        <img class="img-fluid" src="' . $row['image'] . '" alt="">
                        <h3 class="mb-3">' . $row['title'] . '</h3>
                        <p class="mb-3 text-justify">' . $row['description'] . '</p>
                    </div>
                </div>';
                $delay += 0.2;
            }
            ?>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.2s">
            <h1 class="font-dancing-script text-primary">Testimonial</h1>
            <h1 class="mb-5">What Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
            <?php
            $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <div class="text-center hero-header p-4">
                    <i class="fa fa-quote-left fa-3x mb-3 text-primary"></i>
                    <p class="text-muted">' . htmlspecialchars($row['quote'] ?? 'No quote') . '</p>';
                echo '<img class="img-fluid mx-auto border p-1 mb-3 rounded-circle" src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['client_name'] ?? 'Client') . '" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'block\';" style="width: 100px; height: 100px; object-fit: cover;">';
                echo '<div class="no-image p-2 d-none">No Image</div>';
                echo '
                    <h4 class="mb-1 text-dark">' . htmlspecialchars($row['client_name'] ?? 'Anonymous') . '</h4>
                    <span class="text-muted">' . htmlspecialchars($row['profession'] ?? 'N/A') . '</span>
                </div>';
            }
            ?>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Blogs -->
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
<!-- Blog End-->

<?php include './include/footer.php'; ?>
</body>
</html>