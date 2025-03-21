<?php

    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    require 'vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");

    $db = $mongoClient->tienda_online;
    $ordersCollection = $db->orders;

    $username = $_SESSION['username'];

    $orders = $ordersCollection->find(['user' => $username]);

?>

<!DOCTYPE html>
<html lang = "en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Allure - Order History</title>
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
        <main class = "container-fluid orders-main py-5">

            <div class = "container">

                <h1 class = "orders-title text-center mb-5">Your Order History</h1>

                <div class = "row">

                    <?php 

                        $i = 1;
                        foreach($orders as $order):

                    ?>

                    <div class = "col-12 col-md-6 col-lg-4 mb-4">

                        <div class = "card order-card h-100">

                            <div class = "card-body">

                                <h5 class = "card-title">Order <?php echo $i; ?></h5>

                                <p class = "card-text"><strong>Total:</strong> $<?php echo number_format($order['total'], 2);?></p>

                                <p class = "card-text"><strong>State:</strong> <?php echo htmlspecialchars($order['state'], 2);?></p>

                                <p class = "card-text"><strong>Note:</strong> <?php echo htmlspecialchars($order['note']);?></p>

                                <div class = "order-products mt-3">

                                    <h6 class = "mb-2">Products:</h6>

                                    <?php if (isset($order['products'])):

                                        $products = is_array($order['products']) ? $order['products'] : iterator_to_array($order['products']);

                                    ?>
                                    
                                    <ul class = "list-unstyled">
                                        
                                        <?php foreach($products as $product):?>

                                            <li class = "mb-2">

                                                <div class = "d-flex align-items-center">

                                                    <img src = "<?php echo htmlspecialchars($product['photo']);?>" alt = "<?php echo htmlspecialchars($product['name']);?>" class = "img-fluid order-history-photo">

                                                    <div>

                                                        <p class = "mb-0"><strong><?php echo htmlspecialchars($product['name']);?></strong></p>

                                                        <p class = "mb-0">$<?php echo number_format((float)$product['price'], 2);?> x <?php echo (int)$product['quantity'];?></p>

                                                    </div>
                                                
                                                </div>

                                            </li>

                                        <?php endforeach;?>

                                    </ul>

                                    <?php else:?>

                                        <p>No products found in this order.</p>

                                    <?php endif;?>
                                
                                </div>

                            </div>

                        </div>

                    </div>

                    <?php 

                        $i++;
                        endforeach; 

                    ?>
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