<?php

    session_start();

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Admin Panel</title>
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
        <main class = "container-fluid admin-main">

            <div class = "container">


                <h1 class = "admin-welcome text-center mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']);?></h1>

                <div class = "row">

                    <div class = "col-md-6 mb-4">


                        <div class = "card admin-card">

                            <img src = "images/admin-photo-1.jpg" alt = "Orders">
                            
                            <div class = "card-body">

                                <h5 class = "card-title">Manage Orders</h5>

                                <p class = "card-text">View and manage customer orders, update order statuses, and review order details.</p>
                                
                                <a href = "orders.php" class = "btn btn-dark">View Orders</a>

                            </div>

                        </div>

                    </div>

                    <div class = "col-md-6 mb-4">

                        <div class = "card admin-card">

                            <img src = "images/admin-photo-2.jpg" alt = "Stock"">
                            
                            <div class = "card-body">
                                
                                <h5 class = "card-title">Manage Stock</h5>
                                <p class = "card-text">Update product inventory, adjust stock levels, and manage product listings.</p>
                                <a href = "stock.php" class = "btn btn-dark">View Stock</a>
                            
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </body>

</html>