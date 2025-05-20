function toggleDropdown(button) {
    const menu = button.nextElementSibling;
    const isOpen = menu.style.display === "block";
    document.querySelectorAll('.dropdown-menu-custom').forEach(el => el.style.display = "none");
    if (!isOpen) {
        menu.style.display = "block";
    }
    document.addEventListener('click', function handler(e) {
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.style.display = "none";
            document.removeEventListener('click', handler);
        }
    });
}

