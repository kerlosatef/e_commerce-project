<?php
session_start(); // بدء الجلسة

// إذا لم يكن المستخدم قد سجل دخوله، يتم توجيهه إلى صفحة الدخول
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // إعادة التوجيه إلى صفحة تسجيل الدخول
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-commerce Store - Awesome Tool</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<head>
    <!-- العناصر الحالية -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>


<body>

    <nav class="navbar">
        <div class="container navbar-container">
            <div class="navbar-brand-wrapper">
                <a href="index.php" class="navbar-brand">GlowFit</a>
            </div>

            <div class="navbar-menu-desktop">
                <a href="index.php" class="navbar-link nav-link" data-page="index">Home</a>
                <a href="about.php" class="navbar-link nav-link" data-page="about">About Us</a>
                <a href="contact.php" class="navbar-link nav-link" data-page="contact">Contact Us</a>
                <div class="products-dropdown">
                    <button id="products-menu-button" class="products-dropdown-button" aria-haspopup="true"
                        aria-expanded="false">
                        Products
                    </button>
                    <div id="products-menu" class="products-dropdown-menu" role="menu" aria-orientation="vertical"
                        aria-labelledby="products-menu-button">
                        <a href="product1.php" class="products-dropdown-link nav-link" role="menuitem"
                            data-page="product1">Product 1</a>
                        <a href="product2.php" class="products-dropdown-link nav-link" role="menuitem"
                            data-page="product2">Product 2</a>
                        <a href="product3.php" class="products-dropdown-link nav-link" role="menuitem"
                            data-page="product3">Product 3</a>
                    </div>
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" class="navbar-link nav-link logout">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="navbar-link nav-link" data-page="login">Login</a>
                    <a href="register.php" class="button button-primary nav-link" data-page="register"
                        style="margin-right: var(--space-4);">Register</a>
                <?php endif; ?>
                <div class="navbar-menu-desktop">
                    <!-- الروابط الحالية -->
                    <button id="theme-toggle" class="theme-toggle-button" aria-label="Toggle dark mode">
                        <i id="theme-icon" class="fas fa-moon"></i>
                    </button>
                </div>

            </div>

            <div class="navbar-mobile-button-wrapper">
                <button id="mobile-menu-button" class="navbar-mobile-button" aria-controls="mobile-menu"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="hamburger-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg class="close-icon hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="navbar-menu-mobile">
            <a href="index.php" class="navbar-link nav-link" data-page="index">Home</a>
            <a href="about.php" class="navbar-link nav-link" data-page="about">About Us</a>
            <a href="contact.php" class="navbar-link nav-link" data-page="contact">Contact Us</a>
            <a href="product1.php" class="navbar-link nav-link" data-page="product1">Product 1</a>
            <a href="product2.php" class="navbar-link nav-link" data-page="product2">Product 2</a>
            <a href="product3.php" class="navbar-link nav-link" data-page="product3">Product 3</a>
            <a href="login.php" class="navbar-link nav-link" data-page="login">Login</a>
            <a href="register.php" class="navbar-link nav-link" data-page="register">Register</a>
        </div>
    </nav>

    <main class="container page-content" id="product1">
        <div class="product-detail-card">
            <div class="product-detail-layout">
                <div class="product-detail-image-wrapper">
                    <img class="product-detail-image" src="photo/widleg1.jpg" alt="Product 1 Large Image"
                        onerror="this.src='https://placehold.co/600x400/e2e8f0/cbd5e0?text=Image+Not+Found'">
                </div>
                <div class="product-detail-info">
                    <h1 class="product-detail-title">WIDE FIT PLEATED TROUSERS</h1>
                    <p class="product-detail-description">
                        Relaxed fit cotton corduroy trousers. Featuring front pockets, patch pockets on the back,
                        multi-functional straps and leg pockets. Zip fly and top button fastening.
                        <br><br>



                    </p>
                    <p class="product-detail-price">2,490 EGP</p>
                    <button class="button button-primary button-large product-detail-button">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container footer-content">
            <p>&copy; 2025 GlowFit. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>

</body>

</html>