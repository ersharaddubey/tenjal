<?php include './include/header.php'; 
include './include/db_connect.php'; // Fixed path
?>
<body>
      <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container hero-header">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="font-dancing-script text-primary">Our Services</h1>
                <h1 class="mb-5">Explore Our Services</h1>
            </div>
            <div class="row g-4 g-md-0 text-center">
                <?php
                $stmt = $pdo->query("SELECT * FROM services");
                $delay = 0.1;
                $col_count = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $border_classes = ''; // Add logic for borders if needed
                    echo '
                <div class="col-md-6 col-lg-4">
                    <div class="service-item h-100 p-4 ' . $border_classes . ' wow fadeIn" data-wow-delay="' . $delay . 's">
                        <img class="img-fluid" src="' . $row['image'] . '" alt="">
                        <h3 class="mb-3">' . $row['title'] . '</h3>
                        <p class="mb-3 text-justify">' . $row['description'] . '</p>
                        <a class="btn btn-sm btn-primary text-uppercase" href="">Read More <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>';
                    $delay += 0.2;
                    $col_count++;
                    if ($col_count % 3 == 0) $delay = 0.1; // Reset delay for new row
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Service End -->
     <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center wow fadeIn" >
                <h1 class="font-dancing-script text-primary">Testimonial</h1>
                <h1 class="mb-5">What Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.3s">
                <?php
                $stmt = $pdo->query("SELECT * FROM testimonials");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="text-center hero-header p-4">
                        <i class="fa fa-quote-left fa-3x mb-3"></i>
                        <p>' . $row['quote'] . '</p>
                        <img class="img-fluid mx-auto border p-1 mb-3" src="' . $row['image'] . '" alt="">
                        <h4 class="mb-1">' . $row['client_name'] . '</h4>
                        <span>' . $row['profession'] . '</span>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
  <?php include './include/footer.php'; ?>
</body>
</html>