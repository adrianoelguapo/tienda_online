<?php

    session_start();
    require 'vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $productsCollection = $db->products;

    $allProducts = $productsCollection->find()->toArray();

    $positions = [1, 2, 3, 4, 6, 7];

    $product1 = isset($allProducts[1]) ? $allProducts[1] : null;
    $product2 = isset($allProducts[2]) ? $allProducts[2] : null;
    $product3 = isset($allProducts[3]) ? $allProducts[3] : null;
    $product4 = isset($allProducts[4]) ? $allProducts[4] : null;
    $product6 = isset($allProducts[6]) ? $allProducts[6] : null;
    $product7 = isset($allProducts[7]) ? $allProducts[7] : null;

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset="UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Home</title>
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

        <!-- Contenido Principal -->
        <main class = "container-fluid home-main">

            <div class = " col-12 col-lg-6 ml-5 d-flex flex-column home-main-content">

                <p class = "home-main-title">LUXURY JEWELS</p>

                <p class = "home-main-text">Designed to the greatest extent</p>

                <a href = "products.php"><button class = "px-3 py-1" id = "home-main-shop-btn">SHOP NOW</button></a>

            </div>

        </main>

        <!-- Primera sección -->
        <section class = "container-fluid mt-4 mb-4 d-flex flex-column align-items-center home-first-section">

            <div class = "row">

                <div class = "col-12 home-first-section-text d-flex flex-column justify-content-center align-items-center">

                    <p class = "home-first-section-title">DISCOVER</p>

                    <p class = "home-first-section-subtitle mb-4">Our Luxury Jewelry Collection</p>

                </div>

            </div>

            <div class = "row d-flex justify-content-center home-first-section-items">

                <div class = "col-lg-4 home-first-section-item">

                    <img src = "images/home-first-section-photo-1.webp" alt = "home-first-section-item-1" class = "home-first-section-item-img">

                    <a href = "http://localhost/tienda-online/products.php?filter=earrings" class = "home-first-section-item-desc text-decoration-none">Look at our Collection of Earrings</a>

                </div>

                <div class = "col-lg-4 home-first-section-item">

                    <img src = "images/home-first-section-photo-2.jpg" alt = "home-first-section-item-2" class = "home-first-section-item-img">

                    <a href = "http://localhost/tienda-online/products.php?filter=rings" class = "home-first-section-item-desc text-decoration-none">Look at our Collection of Rings</a>

                </div>

                <div class = "col-lg-4 home-first-section-item">

                    <img src = "images/home-first-section-photo-3.jpg" alt = "home-first-section-item-3" class = "home-first-section-item-img">

                    <a href = "http://localhost/tienda-online/products.php?filter=necklaces" class = "home-first-section-item-desc text-decoration-none">Look at our Collection of Necklaces</a>

                </div>

            </div>

        </section>

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

                                            <img src = "<?php echo htmlspecialchars($product1['photo']);?>" alt = "<?php echo htmlspecialchars($product1['name']);?>" class = "item-card-img w-100">

                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">

                                                <?php echo ((int)$product1['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>

                                            </span>

                                        </div>

                                        <p class = "item-card-title"><?php echo htmlspecialchars($product1['name']);?></p>

                                        <p class = "item-card-price">$<?php echo htmlspecialchars($product1['price']);?></p>

                                        <a href = "view-product.php?id=<?php echo (string)$product1['_id'];?>" class = "item-card-btn">View Product</a>

                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "<?php echo htmlspecialchars($product2['photo']);?>" alt = "<?php echo htmlspecialchars($product2['name']);?>" class = "item-card-img w-100">
                                            
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">
                                                
                                                <?php echo ((int)$product2['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>
                                            
                                            </span>
                                        
                                        </div>
                                        
                                        <p class = "item-card-title"><?php echo htmlspecialchars($product2['name']);?></p>

                                        <p class = "item-card-price">$<?php echo htmlspecialchars($product2['price']);?></p>
 
                                        <a href = "view-product.php?id=<?php echo (string)$product2['_id'];?>" class = "item-card-btn">View Product</a>
                                    
                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "<?php echo htmlspecialchars($product3['photo']);?>" alt = "<?php echo htmlspecialchars($product3['name']);?>" class = "item-card-img w-100">
                                            
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">
                                               
                                                <?php echo ((int)$product3['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>
                                            
                                            </span>

                                        </div>

                                        <p class = "item-card-title"><?php echo htmlspecialchars($product3['name']);?></p>

                                        <p class = "item-card-price">$<?php echo htmlspecialchars($product3['price']);?></p>

                                        <a href = "view-product.php?id=<?php echo (string)$product3['_id'];?>" class = "item-card-btn">View Product</a>
                                    
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class = "carousel-item">

                            <div class = "row justify-content-center">

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "<?php echo htmlspecialchars($product4['photo']);?>" alt = "<?php echo htmlspecialchars($product4['name']);?>" class = "item-card-img w-100">
                                            
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">
                                                
                                                <?php echo ((int)$product4['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>
                                            
                                            </span>

                                        </div>

                                        <p class = "item-card-title"><?php echo htmlspecialchars($product4['name']);?></p>
                                        <p class = "item-card-price">$<?php echo htmlspecialchars($product4['price']);?></p>

                                        <a href = "view-product.php?id=<?php echo (string)$product4['_id'];?>" class = "item-card-btn">View Product</a>

                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">

                                            <img src = "<?php echo htmlspecialchars($product6['photo']);?>" alt = "<?php echo htmlspecialchars($product6['name']);?>" class = "item-card-img w-100">
                                            
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">
                                                
                                                <?php echo ((int)$product6['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>
                                            
                                            </span>

                                        </div>

                                        <p class = "item-card-title"><?php echo htmlspecialchars($product6['name']);?></p>

                                        <p class = "item-card-price">$<?php echo htmlspecialchars($product6['price']);?></p>

                                        <a href = "view-product.php?id=<?php echo (string)$product6['_id'];?>" class = "item-card-btn">View Product</a>
                                    
                                    </div>

                                </div>

                                <div class = "col-12 col-md-4">

                                    <div class = "item-card-container">

                                        <div class = "position-relative">
                                            
                                            <img src = "<?php echo htmlspecialchars($product7['photo']);?>" alt = "<?php echo htmlspecialchars($product7['name']);?>" class = "item-card-img w-100">
                                            
                                            <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">
                                                
                                                <?php echo ((int)$product7['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>
                                            
                                            </span>

                                        </div>

                                        <p class = "item-card-title"><?php echo htmlspecialchars($product7['name']);?></p>

                                        <p class = "item-card-price">$<?php echo htmlspecialchars($product7['price']);?></p>

                                        <a href = "view-product.php?id=<?php echo (string)$product7['_id']; ?>" class = "item-card-btn">View Product</a>

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