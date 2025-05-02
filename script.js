document.addEventListener('DOMContentLoaded', function () {
    const productsMenuButton = document.getElementById('products-menu-button');
    const productsMenu = document.getElementById('products-menu');

    productsMenuButton.addEventListener('click', function () {
        const expanded = productsMenuButton.getAttribute('aria-expanded') === 'true';
        productsMenuButton.setAttribute('aria-expanded', !expanded);
        productsMenu.style.display = expanded ? 'none' : 'block';
    });
});
