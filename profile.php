<?php

    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang = "en">

    <head>

        <meta charset = "UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile - Allure</title>
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
        <main class = "profile-main container-fluid">

            <div class = "container">

                <h2 class = "text-center mb-4 profile-main-title">User Profile</h2>

                <form class = "profile-form" method = "POST" action = "update_profile.php">

                    <div class = "mb-3">

                        <label for = "username" class = "form-label">Username</label>
                        <input type = "text" class = "form-control" id = "username" name = "username" value = "<?php echo $_SESSION['username']; ?>">

                    </div>

                    <div class = "mb-3">

                        <label for = "password" class = "form-label">New Password</label>
                        <input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Enter new password">
                        <small class = "form-text text-muted">Leave blank to keep your current password.</small>

                    </div>

                    <div class = "profile-buttons">

                        <button type = "submit" class = "btn btn-dark">Save Changes</button>
                        <a href = "logout.php" class = "btn btn-link">Log Out</a>

                    </div>

                </form>

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

        <!-- Modal -->
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
        <script src = "profile.js"></script>

    </body>

</html>
