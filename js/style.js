document.addEventListener('DOMContentLoaded', () => {
    // --- Password Visibility Toggle ---
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#login-password');

    if (togglePassword && passwordField) {
        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the icon class
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    } else {
        console.warn("Password toggle elements not found."); // Warning if elements are missing
    }

    // --- Theme Toggle Functionality ---
    const themeToggleBtn = document.getElementById('theme-toggle');
    const body = document.body;

    // Check if theme toggle button exists
    if (themeToggleBtn) {
        const themeIcon = themeToggleBtn.querySelector('i'); // Get the icon element inside the button

        // Function to set the theme based on 'dark' or 'light' string
        const setTheme = (theme) => {
            if (!themeIcon) return; // Exit if icon not found

            if (theme === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun'); // Sun icon for dark mode
                localStorage.setItem('theme', 'dark'); // Save preference
            } else {
                body.classList.remove('dark-mode');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon'); // Moon icon for light mode
                localStorage.setItem('theme', 'light'); // Save preference
            }
        };

        // Event listener for the toggle button click
        themeToggleBtn.addEventListener('click', () => {
            // Check current mode by looking for the class on the body
            const isDarkMode = body.classList.contains('dark-mode');
            // Set the opposite theme
            setTheme(isDarkMode ? 'light' : 'dark');
        });

        // Apply the saved theme on initial page load
        // Default to 'light' if no theme is saved in localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

    } else {
        console.warn("Theme toggle button not found."); // Warning if button is missing
    }
});