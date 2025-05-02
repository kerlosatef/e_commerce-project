<?php
session_start();
include('db_connection.php'); // الاتصال بقاعدة البيانات

// التحقق من إرسال البيانات عبر النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // التحقق من أن كلمة المرور وتأكيد كلمة المرور متطابقتان
    if ($password !== $confirmPassword) {
        $error_message = "Passwords do not match!";
    } else {
        // التحقق إذا كان البريد الإلكتروني موجود بالفعل في قاعدة البيانات
        $query = "SELECT * FROM users WHERE email=?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // إذا كان البريد الإلكتروني موجودًا، إظهار رسالة الخطأ
            $error_message = "Email is already registered!";
        } else {
            // تشفير كلمة المرور
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // الاستعلام لإدخال البيانات في قاعدة البيانات
            $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                // توجيه المستخدم إلى صفحة الدخول بعد التسجيل الناجح
                header('Location: login.php');
                exit();
            } else {
                $error_message = "Registration failed, please try again!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-commerce Store - Register</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="container navbar-container">
            <div class="navbar-brand-wrapper">
                <a href="index.php" class="navbar-brand">My Store</a>
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

    <main class="container page-content" id="register">
        <div class="auth-container">
            <div class="auth-card">
                <h2 class="auth-title">Create a New Account</h2>
                <?php if (isset($error_message)) { echo "<div class='error-message'>$error_message</div>"; } ?>
                <form class="auth-form" action="" method="POST">
                    <div class="register-input-group">
                        <div>
                            <label for="register-name" class="sr-only">Full Name</label>
                            <input id="register-name" name="name" type="text" autocomplete="name" required
                                placeholder="Full Name">
                        </div>
                        <div>
                            <label for="register-email-address" class="sr-only">Email Address</label>
                            <input id="register-email-address" name="email" type="email" autocomplete="email" required
                                placeholder="Email Address">
                        </div>
                        <div>
                            <label for="register-password" class="sr-only">Password</label>
                            <input id="register-password" name="password" type="password" autocomplete="new-password"
                                required placeholder="Password">
                        </div>
                        <div>
                            <label for="confirm-password" class="sr-only">Confirm Password</label>
                            <input id="confirm-password" name="confirm-password" type="password"
                                autocomplete="new-password" required placeholder="Confirm Password">
                        </div>
                    </div>

                    <button type="submit" class="button button-primary button-fullwidth">
                        Register
                    </button>

                    <div class="auth-switch">
                        <p>
                            Already have an account?
                            <a href="login.php" class="auth-link">Login here</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="container footer-content">
            <p>&copy; 2025 My Store. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>

</body>

</html>
