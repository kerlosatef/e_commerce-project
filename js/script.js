
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDarkMode = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
    updateThemeIcons(isDarkMode);
}


function updateThemeIcons(isDarkMode) {
    const icons = document.querySelectorAll('.theme-icon');
    icons.forEach(icon => {
        icon.className = isDarkMode ? 'fas fa-sun theme-icon' : 'fas fa-moon theme-icon';
    });
}
function loadThemePreference() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }
    updateThemeIcons(isDarkMode);
}


function initThemeToggles() {
    const themeToggles = document.querySelectorAll('.theme-toggle-button');
    themeToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleDarkMode();
        });
    });
}


function initProductsDropdown() {
    const productsMenuButton = document.getElementById('products-menu-button');
    const productsMenu = document.getElementById('products-menu');

    if (productsMenuButton && productsMenu) {
        productsMenuButton.addEventListener('click', function (e) {
            e.stopPropagation();
            const expanded = productsMenuButton.getAttribute('aria-expanded') === 'true';
            productsMenuButton.setAttribute('aria-expanded', !expanded);
            productsMenu.style.display = expanded ? 'none' : 'block';
        });

        document.addEventListener('click', function () {
            productsMenu.style.display = 'none';
            productsMenuButton.setAttribute('aria-expanded', 'false');
        });
    }
}


document.addEventListener('DOMContentLoaded', function () {
    loadThemePreference();
    initThemeToggles();
    initProductsDropdown();
});

if (document.readyState === 'complete') {
    loadThemePreference();
    initThemeToggles();
    initProductsDropdown();
}