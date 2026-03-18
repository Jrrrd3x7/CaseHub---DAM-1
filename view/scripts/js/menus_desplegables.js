
const menuItem1 = document.getElementById('menu-item1');
const submenu1 = document.getElementById('submenu1');

const menuItem2 = document.getElementById('menu-item2');
const submenu2 = document.getElementById('submenu2');


submenu1.style.visibility = 'hidden';
submenu2.style.visibility = 'hidden';

document.addEventListener('click', function(event) {
    if (menuItem1.contains(event.target)) {
        submenu1.style.visibility = (submenu1.style.visibility === 'hidden') ? 'visible' : 'hidden';
    } else if (!submenu1.contains(event.target)) {
        submenu1.style.visibility = 'hidden';
    }
});

document.addEventListener('click', function(event) {
    if (menuItem2.contains(event.target)) {
        submenu2.style.visibility = (submenu2.style.visibility === 'hidden') ? 'visible' : 'hidden';
    } else if (!submenu2.contains(event.target)) {
        submenu2.style.visibility = 'hidden';
    }
});

