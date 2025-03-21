<?php

    session_start();

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Story</title>
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel = "stylesheet" href = "style.css">
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

    </head>

    <body>

        <!-- Cabecera (Barra de Navegación) -->
        <nav class = "navbar navbar-expand-lg">

            <div class = "container-fluid navbar-container">

                <a class = "navbar-brand  main-navbar-brand" href = "index.php">Allure</a>

                <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "offcanvas" data-bs-target = "#offcanvasNavbar" aria-controls = "offcanvasNavbar" aria-label = "Toggle navigation">

                    <span class = "navbar-toggler-icon"></span>

                </button>

                <div class = "sidebar offcanvas offcanvas-start" tabindex = "-1" id = "offcanvasNavbar" aria-labelledby = "offcanvasNavbarLabel">

                    <div class = "offcanvas-header border-bottom">

                        <h5 class = "offcanvas-title" id = "offcanvasNavbarLabel">Allure</h5>
                        <button type = "button" class = "btn-close btn-close-dark" data-bs-dismiss = "offcanvas" aria-label = "Close"></button>

                    </div>

                    <div class = "offcanvas-body">

                        <ul class = "navbar-nav justify-content-start align-items-center flex-grow-1 text-center">

                            <li class = "nav-item">

                                <a href = "index.php" class = "nav-link">Home</a>

                            </li>

                            <li class = "nav-item">

                                <a href = "products.php" class = "nav-link">Products</a>

                            </li>

                            <li class = "nav-item">

                                <a href = "story.php" class = "nav-link">Our Story</a>

                            </li>

                        </ul>

                        <div class = "d-flex justify-content-center offcanvas-icons">

                            <?php

                                if(isset($_SESSION['username'])) {
                                    echo '<a class="navbar-brand" href="profile.php"><i class="bi bi-person"></i></a>';
                                } else {
                                    echo '<a class="navbar-brand" href="login.php"><i class="bi bi-person"></i></a>';
                                }

                            ?>

                            <a class = "navbar-brand" href = "favs.php"><i class = "bi bi-heart"></i></a>
                            <a class = "navbar-brand" href = "cart.php"><i class = "bi bi-bag"></i></a>

                        </div>

                    </div>

                </div>

            </div>

        </nav>

        <!-- Sección principal de Our Story -->
        <main class = "story-main">

            <div class = "container-fluid">

                <div class = "row">

                    <div class = "col-12 d-flex flex-column justify-content-center align-items-center story-main-container">

                        <p class = "story-main-title">UNPARALLED JEWELRY LUXURY</p>

                    </div>

                </div>

            </div>

        </main>

        <!-- Sección de la Historia de la Empresa -->
        <section class = "row m-0 container-fluid story-section p-0">
            
            <div class = "col-12 col-lg-6 p-0">

                <img src = "images/story-photo-1.jpg" alt = "story-img-1" class = "story-img w-100 h-100">

            </div>

            <div class = "col-12 col-lg-6 d-flex align-items-center">

                <div class = "story-section-container d-flex flex-column justify-content-center align-items-center">

                    <p class = "story-section-title w-50 mt-3">OUR STORY</p>

                    <p class = "story-section-desc w-50 mb-4">Allure is a luxury jewelry brand that offers a wide range of exquisite pieces that are designed to captivate your senses. Our collection is meticulously crafted with attention to detail, ensuring that each piece is a work of art that will stand the test of time. From classic designs to modern styles, our jewelry is made with the finest materials and the highest quality craftsmanship. Whether you are looking for a statement piece to add to your collection or a special gift for someone you love, Allure has something for everyone.</p>

                </div>

            </div>

            <div class = "col-12 col-lg-6 d-flex align-items-center order-2 order-lg-1">

                <div class = "story-section-container d-flex flex-column justify-content-center align-items-center">

                    <p class = "story-section-title w-50 mt-3">OUR FOCUS</p>

                    <p class = "story-section-desc w-50 mb-4">At Allure, our focus is on creating timeless pieces that blend elegance and sophistication. We are committed to sustainability and ethical practices, ensuring that every jewel not only enhances your beauty but also respects the environment and the communities involved in its creation. We are deeply committed to sustainability and ethical practices, ensuring that every piece not only enhances your beauty but also respects the environment and the communities involved in its creation.</p>

                </div>

            </div>

            <div class = "col-12 col-lg-6 p-0 order-1 order-lg-2">

                <img src = "images/story-photo-2.webp" alt = "story-img-1" class = "story-img w-100 h-100">

            </div>

        </section>

        <!-- Sección de Nuestros Valores -->
        <div class = "container-fluid story-values-section mt-5 mb-3">

            <div class = "container">

                <p class = "story-values-title text-center">OUR VALUES</p>

                <div class = "row g-3 justify-content-center story-values-container">

                    <div class = "col-12 col-md-6 col-lg-4 mb-4">

                        <div class = "story-values-card text-center">

                            <img src = "images/story-photo-3.webp" alt = "quality-img" class = "img-fluid story-values-img">
                            <p class = "story-values-subtitle mt-2">QUALITY</p>
                            <p class = "story-values-desc">We are committed to creating jewelry of the highest quality, using the finest materials and the most skilled craftsmen to ensure that every piece is a work of art.</p>
                        
                        </div>

                    </div>

                    <div class = "col-12 col-md-6 col-lg-4 mb-4">

                        <div class = "story-values-card text-center">

                            <img src = "images/story-photo-4.webp" alt = "innovation-img" class = "img-fluid story-values-img">
                            <p class = "story-values-subtitle mt-2">INNOVATION</p>
                            <p class = "story-values-desc">Our design embraces modern trends while remaining true to elegance. Each piece is made with an innovative spirit that fuses classic artistry with contemporary flair.</p>
                        
                        </div>

                    </div>

                    <div class = "col-12 col-md-6 col-lg-4 mb-4">

                        <div class = "story-values-card text-center">

                            <img src = "images/story-photo-5.webp" alt = "sustainability-img" class = "img-fluid story-values-img">
                            <p class = "story-values-subtitle mt-2">SUSTAINABILITY</p>
                            <p class = "story-values-desc">We are dedicated to sourcing and eco-friendly practices, ensuring our jewelry not only dazzles but also honors the environment and supports the communities involved.</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
          

        <!-- Sección de Best Sellers -->
        <section class = "container-fluid best-sellers-section">

            <div class = "row">

                <div class = "col-12 best-sellers-section d-flex flex-column justify-content-center align-items-center">

                    <p class = "best-sellers-section-title mt-4">BEST SELLERS</p>

                    <p class = "best-sellers-section-subtitle mb-4">Discover our most popular products</p>

                </div>

            </div>

            <div class = "row">

                <div id = "best-sellers-carousel" class = "carousel slide" data-bs-ride = "carousel">

                    <div class = "carousel-inner">

                        <div class = "carousel-item active">

                            <div class = "row justify-content-center">

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "images/earring-1.webp" alt = "best-sellers-item-1" class = "item-card-img w-100">
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">AVAILABLE NOW</span>

                                        </div>

                                        <p class = "item-card-title">Earrings</p>

                                        <p class = "item-card-price">$100</p>

                                        <a href = "#" class = "item-card-btn">View Product</a>

                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "images/earring-1.webp" alt = "best-sellers-item-1" class = "item-card-img w-100">
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">AVAILABLE NOW</span>

                                        </div>

                                        <p class = "item-card-title">Earrings</p>

                                        <p class = "item-card-price">$100</p>

                                        <a href = "#" class = "item-card-btn">View Product</a>

                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "images/earring-1.webp" alt = "best-sellers-item-1" class = "item-card-img w-100">
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">AVAILABLE NOW</span>

                                        </div>

                                        <p class = "item-card-title">Earrings</p>

                                        <p class = "item-card-price">$100</p>

                                        <a href = "#" class = "item-card-btn">View Product</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class = "carousel-item active">

                            <div class = "row justify-content-center">

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "images/earring-1.webp" alt = "best-sellers-item-1" class = "item-card-img w-100">
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">AVAILABLE NOW</span>

                                        </div>

                                        <p class = "item-card-title">Earrings</p>

                                        <p class = "item-card-price">$100</p>

                                        <div class = "d-flex align-items-center justify-content-between">

                                            <a href = "#" class = "item-card-btn">View Product</a>
                                            <i class = "bi bi-heart item-card-heart fs-5"></i>
            
                                        </div>

                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "images/earring-1.webp" alt = "best-sellers-item-1" class = "item-card-img w-100">
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">AVAILABLE NOW</span>

                                        </div>

                                        <p class = "item-card-title">Earrings</p>

                                        <p class = "item-card-price">$100</p>

                                        <div class = "d-flex align-items-center justify-content-between">

                                            <a href = "#" class = "item-card-btn">View Product</a>
                                            <i class = "bi bi-heart item-card-heart fs-5"></i>
            
                                        </div>

                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "images/earring-1.webp" alt = "best-sellers-item-1" class = "item-card-img w-100">
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">AVAILABLE NOW</span>

                                        </div>

                                        <p class = "item-card-title">Earrings</p>

                                        <p class = "item-card-price">$100</p>

                                        <div class = "d-flex align-items-center justify-content-between">

                                            <a href = "#" class = "item-card-btn">View Product</a>
                                            <i class = "bi bi-heart item-card-heart fs-5"></i>
            
                                        </div>

                                    </div>

                                </div>
                                
                            </div>

                        </div>

                        <button class = "carousel-control-prev" type = "button" data-bs-target = "#best-sellers-carousel" data-bs-slide = "prev">

                            <span class = "carousel-control-prev-icon" aria-hidden = "true"></span>
                            <span class = "visually-hidden">Previous</span>

                        </button>

                        <button class = "carousel-control-next" type = "button" data-bs-target = "#best-sellers-carousel" data-bs-slide = "next">

                            <span class = "carousel-control-next-icon" aria-hidden = "true"></span>
                            <span class = "visually-hidden">Next</span>

                        </button>

                    </div>

                </div>

            </div>

        </section>

        <!-- Sección previa al footer -->
        <section class = "container-fluid prefooter-section">

            <div class = "col-12 text-center d-flex flex-column align-items-center prefooter-section-container">

                <p class = "prefooter-section-title">Jewels Of The Best Quality</p>
                <p class = "prefooter-section-desc">Discover the exquisite craftsmanship behind every piece in our collection. Each jewel is meticulously designed with attention to detail, ensuring timeless elegance and unparalleled quality that will captivate your senses.</p>

            </div>

        </section>

        <!-- Pie de Página -->
        <footer class = "footer py-4">

            <div class = "container">

                <div class = "row text-start ms-5 ms-md-0">

                    <div class = "col-md-4 mb-3">

                        <h5 class = "footer-brand">Allure</h5>
                        <p>Luxury Jewels &copy; 2025. All rights reserved.</p>

                    </div>

                    <div class = "col-md-4 mb-3">

                        <h5>Links</h5>

                        <ul class = "list-unstyled">

                            <li><a href = "index.php" class = "text-dark text-decoration-none">Home</a></li>
                            <li><a href = "products.php" class = "text-dark text-decoration-none">Products</a></li>
                            <li><a href = "story.php" class = "text-dark text-decoration-none">Our Story</a></li>

                        </ul>

                    </div>

                    <div class = "col-md-4 mb-3">

                        <h5>Contact Us</h5>

                        <ul class = "list-unstyled">

                            <li>Email: info@allure.com</li>
                            <li>Phone Number: +123 456 789</li>
                            <li>Design Avenue, 123</li>

                        </ul>

                    </div>
                    
                </div>

            </div>

        </footer>
        
    </body>

</html>