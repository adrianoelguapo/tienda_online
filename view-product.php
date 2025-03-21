<?php

    session_start();
    require 'vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $collection = $db->products;

    if(!isset($_GET['id'])){
        echo "No product ID provided.";
        exit;
    }

    try {
        $objectId = new MongoDB\BSON\ObjectId($_GET['id']);
    } catch (Exception $e) {
        echo "Invalid product ID.";
        exit;
    }

    $product = $collection->findOne(['_id' => $objectId]);

    if(!$product){
        echo "Product not found.";
        exit;
    }

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Nombre de producto</title>
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

        <!-- Contenido principal -->
        <main class = "container-fluid view-product-main">

            <div class = "container py-4">

                <div class = "row">

                    <div class = "col-12 col-md-6 mb-4">
                        
                        <img src = "<?php echo htmlspecialchars($product['photo']);?>" alt = "<?php echo htmlspecialchars($product['name']);?>" class = "img-fluid product-img"/>
                    
                    </div>

                    <div class = "col-12 col-md-6">

                        <h1 class = "mb-3">

                            <?php echo htmlspecialchars($product['name']); ?>

                        </h1>

                        <p class = "mb-2 product-price">$<?php echo htmlspecialchars($product['price']);?>

                            <span class = "ms-3"><?php echo ((int)$product['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?></span>

                        </p>

                        <p class = "mb-4 text-muted">Category: <?php echo $product['category'];?></p>

                        <div class = "d-flex align-items-center mb-4">

                            <button class = "btn btn-dark me-3" <?php if((int)$product['stock'] <= 0) echo 'disabled';?>>Add to Cart</button>
                            <button class = "btn btn-outline-dark add-to-wishlist" data-product-id = "<?php echo (string)$product['_id'];?>">Add to Wishlist</button>

                        </div>

                        <div class = "accordion" id = "productAccordion">

                            <div class = "accordion-item">

                                <h2 class = "accordion-header" id = "headingDesc">
                                    
                                    <button class = "accordion-button collapsed" type = "button" data-bs-toggle = "collapse" data-bs-target = "#collapseDesc" aria-expanded = "true" aria-controls = "collapseDesc">Description</button>
                                
                                </h2>

                                <div id = "collapseDesc" class = "accordion-collapse collapse show" aria-labelledby = "headingDesc" data-bs-parent = "#productAccordion">
                                    
                                    <div class = "accordion-body">
                                        
                                        <?php echo htmlspecialchars($product['desc']);?>
                                    
                                    </div>
                                
                                </div>
                            
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

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
                            <li><a href = "bio.html" class = "text-dark text-decoration-none">Products</a></li>
                            <li><a href = "music.html" class = "text-dark text-decoration-none">Our Story</a></li>

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

        <script src = "https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src = "view-product.js"></script>

    </body>

</html>