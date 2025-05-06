<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-commerce Store - Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
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
                <a href="login.php" class="navbar-link nav-link" data-page="login">Login</a>
                <a href="register.php" class="button button-primary nav-link" data-page="register"
                    style="margin-right: var(--space-4);">Register</a>
            </div>
            <div class="navbar-menu-desktop">

                <button id="theme-toggle" class="theme-toggle-button" aria-label="Toggle dark mode">
                    <i id="theme-icon" class="fas fa-moon"></i>
                </button>
            </div>
            <div class="navbar-mobile-button-wrapper">
                <button id="mobile-menu-button" class="navbar-mobile-button" aria-controls="mobile-menu"
                    aria-expanded="false">
                    <span class="sr-only">Open Main Menu</span>
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

    <main class="container page-content" id="login">
        <div class="auth-container">
            <div class="auth-card">
                <h2 class="auth-title">Log In to Your Account</h2>
                <?php if (isset($error_message)) {
                    echo "<div class='error-message'>$error_message</div>";
                } ?>
                <form class="auth-form" action="" method="POST">
                    <div class="login-input-group">
                        <label for="login-email-address" class="sr-only">Email Address</label>
                        <input id="login-email-address" name="email" type="email" autocomplete="email" required
                            placeholder="Email Address">

                        <label for="login-password" class="sr-only">Password</label>
                        <input id="login-password" name="password" type="password" autocomplete="current-password"
                            required placeholder="Password">
                    </div>

                    <div class="auth-options">
                        <div class="auth-remember">
                            <input id="remember-me" name="remember-me" type="checkbox">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        <a href="#" class="auth-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="button button-primary button-fullwidth">
                        Log In
                    </button>

                    <div class="auth-switch">
                        <p>
                            Don't have an account?
                            <a href="register.php" class="auth-link">Sign Up Here</a>
                        </p>
                    </div>
                </form>
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