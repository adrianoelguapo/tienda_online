<?php

    session_start();
    require 'vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $productsCollection = $db->products;
    $products = $productsCollection->find();

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Stocks</title>
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel = "stylesheet" href = "style.css">
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

    </head>

    <body>

        <!-- Cabecera (Barra de Navegación) -->
        <nav class = "navbar navbar-expand-lg">

            <div class = "container-fluid navbar-container">

                <a class = "navbar-brand  main-navbar-brand" href = "admin.php">Allure</a>

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

                                <a href = "admin.php" class = "nav-link">Home</a>

                            </li>

                            <li class = "nav-item">

                                <a href = "orders.php" class = "nav-link">Orders</a>

                            </li>

                            <li class = "nav-item">

                                <a href = "stock.php" class = "nav-link">Stock</a>

                            </li>

                        </ul>

                        <div class = "d-flex justify-content-center offcanvas-icons">

                            <a class = "navbar-brand admin-logout" href = "logout.php">Log Out</a>

                        </div>

                    </div>

                </div>

            </div>

        </nav>

        <!-- Contenido principal -->
        <main class = "container-fluid stock-main pt-2">

            <div class = "container">

                <h1 class = "text-center mb-4 stock-main-title">Manage Stock</h1>

                <div class = "row">

                    <?php foreach ($products as $product): ?>

                        <div class = "col-12 col-md-6 col-lg-4 mb-4">

                            <div class = "card stock-card h-100">

                                <img src = "<?php echo htmlspecialchars($product['photo']);?>" alt = "<?php echo htmlspecialchars($product['name']);?>">

                                <div class = "card-body">

                                    <h5 class = "card-title"><?php echo htmlspecialchars($product['name']);?></h5>

                                    <p class = "card-text">Current Stock: <?php echo htmlspecialchars($product['stock']);?></p>

                                    <div class = "input-group mb-3">

                                        <input type = "number" class = "form-control add-stock-quantity" placeholder = "Quantity" min = "1">

                                        <button class = "btn btn-dark add-stock-btn" data-product-id = "<?php echo (string)$product['_id'];?>">Add Stock</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach;?>

                </div>

            </div>

        </main>

        <!-- Modal de Notificación -->
        <div class = "modal fade" id = "notificationModal" tabindex = "-1" aria-labelledby = "notificationModalLabel" aria-hidden = "true">

            <div class = "modal-dialog">

                <div class = "modal-content">

                    <div class = "modal-header">

                        <h5 class = "modal-title" id = "notificationModalLabel">Notification</h5>

                        <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>

                    </div>

                    <div class = "modal-body">

                        <!-- Aquí se mostrará el mensaje -->

                    </div>

                    <div class = "modal-footer">

                        <button type = "button" class = "btn btn-dark" data-bs-dismiss = "modal">Close</button>

                    </div>

                </div>

            </div>
            
        </div>

        <script src = "https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src = "stock.js"></script>
        
    </body>

</html>