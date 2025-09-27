<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tenjal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Playfair+Display:wght@500&family=Work+Sans&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
</head>
<!-- Spinner Start -->
<!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> -->
<!-- Spinner End -->
<!-- Navbar Start -->
<div class="container-fluid bg-light sticky-top p-0">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <a href="index.php" class="navbar-brand bg-primary py-4 px-5 me-0">
            <img class="img-fluid logo" src="img/logo.png" alt="Tenjal Logo">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse p-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="Blog.php" class="nav-item nav-link">Blog</a> <!-- Fixed case -->
                <a href="service.php" class="nav-item nav-link">Service</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <div class="d-flex justify-content-start mt-4">
                <a class="btn btn-sm-square btn-prime me-3" href="https://twitter.com" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square btn-prime me-3" href="https://facebook.com" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square btn-prime me-3" href="https://youtube.com" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a class="btn btn-sm-square btn-prime me-3" href="https://instagram.com" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->
<body> <!-- Open body here for consistency -->
<script>
    $(document).ready(function(){
        $(".testimonial-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            dots: true,
            nav: false
        });
        new WOW().init();
    });
</script>