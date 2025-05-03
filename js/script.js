// وظيفة تبديل الوضع الليلي/النهري
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDarkMode = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
    updateThemeIcons(isDarkMode);
}

// تحديث أيقونات التبديل
function updateThemeIcons(isDarkMode) {
    const icons = document.querySelectorAll('.theme-icon');
    icons.forEach(icon => {
        icon.className = isDarkMode ? 'fas fa-sun theme-icon' : 'fas fa-moon theme-icon';
    });
}

// تحميل التفضيلات
function loadThemePreference() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }
    updateThemeIcons(isDarkMode);
}

// تهيئة أحداث التبديل
function initThemeToggles() {
    const themeToggles = document.querySelectorAll('.theme-toggle-button');
    themeToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.stopPropagation(); // إيقاف انتشار الحدث لمنع التأثير على العناصر الأخرى
            toggleDarkMode();
        });
    });
}

// تهيئة القائمة المنسدلة للمنتجات
function initProductsDropdown() {
    const productsMenuButton = document.getElementById('products-menu-button');
    const productsMenu = document.getElementById('products-menu');

    if (productsMenuButton && productsMenu) {
        productsMenuButton.addEventListener('click', function (e) {
            e.stopPropagation(); // إيقاف انتشار الحدث
            const expanded = productsMenuButton.getAttribute('aria-expanded') === 'true';
            productsMenuButton.setAttribute('aria-expanded', !expanded);
            productsMenu.style.display = expanded ? 'none' : 'block';
        });

        // إغلاق القائمة عند النقر خارجها
        document.addEventListener('click', function () {
            productsMenu.style.display = 'none';
            productsMenuButton.setAttribute('aria-expanded', 'false');
        });
    }
}

// تهيئة جميع الأحداث عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function () {
    loadThemePreference();
    initThemeToggles();
    initProductsDropdown();
});

// Fallback للصفحات التي قد تكون قد تحملت قبل اكتمال DOM
if (document.readyState === 'complete') {
    loadThemePreference();
    initThemeToggles();
    initProductsDropdown();
}