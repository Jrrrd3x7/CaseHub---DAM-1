function initMenus() {
    const menuItem1 = document.getElementById('menu-item1');
    const submenu1 = document.getElementById('submenu1');
    const menuTrigger1 = menuItem1 ? menuItem1.querySelector('a') : null;

    const menuItem2 = document.getElementById('menu-item2');
    const submenu2 = document.getElementById('submenu2');
    const menuTrigger2 = menuItem2 ? menuItem2.querySelector('a') : null;

    function hideMenu(submenu) {
        if (!submenu) return;
        submenu.style.visibility = 'hidden';
    }

    function toggleMenu(submenu) {
        if (!submenu) return;
        submenu.style.visibility =
            submenu.style.visibility === 'visible' ? 'hidden' : 'visible';
    }

    hideMenu(submenu1);
    hideMenu(submenu2);

    if (menuTrigger1 && submenu1) {
        menuTrigger1.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            toggleMenu(submenu1);
            hideMenu(submenu2);
        });
    }

    if (menuTrigger2 && submenu2) {
        menuTrigger2.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            toggleMenu(submenu2);
            hideMenu(submenu1);
        });
    }

    document.addEventListener('click', function (event) {
        if (menuItem1 && !menuItem1.contains(event.target)) hideMenu(submenu1);
        if (menuItem2 && !menuItem2.contains(event.target)) hideMenu(submenu2);
    });
}
