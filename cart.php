<?php

    session_start();
    require 'vendor/autoload.php';

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $usersCollection = $db->users;
    $user = $usersCollection->findOne(['username' => $_SESSION['username']]);
    $cart = isset($user['cart']) ? $user['cart'] : [];

?>

<!DOCTYPE html>
<html lang = "en">
    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Cart</title>
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
        <main class="container-fluid cart-main py-5">
        <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
            <div class="row align-items-center mb-3">
                <div class="col-6 col-lg-6">
                <h2 class="cart-page-title mb-0">BASKET</h2>
                </div>
                <div class="col-6 col-lg-6 text-lg-end">
                <a href="products.php" class="btn btn-light cart-continue-btn">Continue Shopping</a>
                </div>
            </div>
            <hr class="mb-4"/>
            <?php 
                $subtotal = 0;
                foreach ($cart as $item):
                $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                $price = (float)$item['price'];
                $totalItem = $price * $quantity;
                $subtotal += $totalItem;
            ?>
            <div class="row align-items-center mb-4 cart-item" data-product-id="<?php echo (string)$item['_id']; ?>">
                <div class="col-3 col-lg-2">
                <img src="<?php echo htmlspecialchars($item['photo']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-fluid cart-item-img"/>
                </div>
                <div class="col-9 col-lg-6">
                <p class="cart-item-title"><?php echo htmlspecialchars($item['name']); ?></p>
                <!-- Detalles opcionales -->
                </div>
                <div class="col-12 col-lg-4 mt-2 mt-lg-0 d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-end">
                <p class="cart-item-price me-lg-4 mb-2 mb-lg-0">$<?php echo number_format($totalItem, 2); ?></p>
                <div class="d-flex align-items-center quantity-controls">
                    <button class="btn btn-light btn-sm minus-btn">-</button>
                    <input type="text" value="<?php echo $quantity; ?>" class="form-control text-center mx-2 cart-item-qty" style="width: 50px;"/>
                    <button class="btn btn-light btn-sm plus-btn">+</button>
                </div>
                <button class="btn btn-link text-dark ms-lg-3 mt-2 mt-lg-0 cart-item-remove">REMOVE</button>
                </div>
            </div>
            <hr class="mb-4"/>
            <?php endforeach; ?>
            </div>
            <div class="col-12 col-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="cart-total-label">TOTAL</span>
                <span class="cart-total-amount">$<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="mb-3 d-flex flex-column align-items-end">
                <label for="orderNotes" class="form-label cart-notes-label">Add order notes</label>
                <textarea class="form-control cart-notes-textarea" id="orderNotes" rows="3"></textarea>
            </div>
            <button class="btn btn-dark w-100 cart-checkout-btn">CHECK OUT</button>
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
        <script src = "cart.js"></script>
        
    </body>

</html>