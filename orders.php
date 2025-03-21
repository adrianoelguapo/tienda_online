<?php

    session_start();
    require 'vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $ordersCollection = $db->orders;

    $orders = $ordersCollection->find(['state' => 'pending']);

?>

<!DOCTYPE html>
<html lang = "en">
    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Allure - Orders</title>
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

                            <?php

                                if(isset($_SESSION['username'])) {
                                    echo '<a class="navbar-brand" href="profile.php"><i class="bi bi-person"></i></a>';
                                } else {
                                    echo '<a class="navbar-brand" href="login.php"><i class="bi bi-person"></i></a>';
                                }

                            ?>

                        </div>

                    </div>

                </div>

            </div>

        </nav>

        <!-- Contenido principal -->
        <main class = "container-fluid orders-main pt-3">

            <div class = "container">

                <h1 class = "orders-title text-center mb-5">Pending Orders</h1>
                
                    <div class = "row">

                        <?php 

                            $i = 1;
                            foreach($orders as $order):

                        ?>

                        <div class = "col-12 col-md-6 col-lg-4 mb-4">

                            <div class = "card order-card h-100">

                                <div class = "card-body">

                                    <h5 class = "card-title">Order <?php echo $i;?></h5>

                                    <p class = "card-text"><strong>User:</strong> <?php echo htmlspecialchars($order['user']);?></p>

                                    <p class = "card-text"><strong>Total:</strong> $<?php echo number_format($order['total'], 2);?></p>

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

                                    <div class = "mt-3 d-flex justify-content-between">

                                        <button class = "btn btn-success accept-order" data-order-id = "<?php echo (string)$order['_id'];?>">Accept Order</button>
                                        <button class = "btn btn-danger reject-order" data-order-id = "<?php echo (string)$order['_id'];?>">Reject Order</button>

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

                        <button type = "button" class = "modal-button" data-bs-dismiss = "modal">Close</button>

                    </div>

                </div>

            </div>
            
        </div>
        
        <script src = "https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src = "orders.js"></script>

    </body>

</html>