<?php

    session_start();
    require 'vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $products = $db->products->find();

    $filterQuery = [];
    if (isset($_GET['filter']) && !empty($_GET['filter']) && strtolower($_GET['filter']) != "all") {
        $filterQuery['category'] = strtolower($_GET['filter']);
    }

    $options = [];
    if (isset($_GET['sort']) && !empty($_GET['sort'])) {
        $sortOrder = ($_GET['sort'] == 'asc') ? 1 : -1;
        $options['sort'] = ['price' => $sortOrder];
    }

    $products = $db->products->find($filterQuery, $options);

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Shop</title>
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

        <!-- Listado de productos -->
        <main class = "container-fluid products-main py-3">

            <div class = "container mb-4">

                <h2 class = "products-heading mb-3 text-center text-md-start">All Products</h2>

                <div class = "row align-items-center justify-content-between products-filter-bar">

                    <div class = "col-12 col-md-4 mb-2 mb-md-0 text-center text-md-start">

                        <div class = "dropdown d-inline">

                            <button class = "btn btn-light dropdown-toggle" type = "button" data-bs-toggle = "dropdown" aria-expanded = "false">Filter</button>

                            <ul class = "dropdown-menu">

                                <li><a class = "dropdown-item" href = "?filter=all">All</a></li>
                                <li><a class = "dropdown-item" href = "?filter=earrings">Earrings</a></li>
                                <li><a class = "dropdown-item" href = "?filter=rings">Rings</a></li>
                                <li><a class = "dropdown-item" href = "?filter=necklaces">Necklaces</a></li>

                            </ul>

                        </div>

                    </div>

                    <div class = "col-12 col-md-4 text-center text-md-end">

                        <div class = "dropdown d-inline">

                            <button class = "btn btn-light dropdown-toggle" type = "button" data-bs-toggle = "dropdown" aria-expanded = "false">Sort by</button>

                            <ul class = "dropdown-menu dropdown-menu-end">

                                <li><a class = "dropdown-item" href = "?filter=<?php echo isset($_GET['filter']) ? $_GET['filter'] : 'all';?>&sort=asc">Price: Low to High</a></li>
                                <li><a class = "dropdown-item" href = "?filter=<?php echo isset($_GET['filter']) ? $_GET['filter'] : 'all';?>&sort=desc">Price: High to Low</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

            <div class = "container">

                <div class = "row">

                    <?php foreach($products as $product):?>

                        <div class = "col-12 col-md-4 mb-4">

                            <div class = "item-card-container">

                                <div class = "position-relative">

                                    <img src = "<?php echo $product['photo'];?>" alt = "<?php echo $product['name'];?>" class = "item-card-img w-100">

                                    <span class = "badge bg-light text-dark border position-absolute top-0 start-0 m-2 item-card-badge">

                                        <?php echo ((int)$product['stock'] > 0) ? "AVAILABLE NOW" : "NO STOCK";?>

                                    </span>

                                </div>

                                <p class = "item-card-title"><?php echo $product['name'];?></p>
                                <p class = "item-card-price">$<?php echo $product['price'];?></p>
                                <a href = "view-product.php?id=<?php echo $product['_id']; ?>" class = "item-card-btn">View Product</a>

                            </div>

                        </div>

                    <?php endforeach; ?>

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