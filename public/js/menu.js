const rightBox = document.querySelector('.rightBox');
const closeMenu = document.querySelector('.closeMenu');
const openMenu = document.querySelector('.openMenu');

openMenu.addEventListener('click', show);
closeMenu.addEventListener('click', close);

function show() {
    rightBox.style.right = '0px';
    closeMenu.style.display = 'block';
}
function close () {
    rightBox.style.right = '-100%';
    closeMenu.style.display = 'none';
    rightBox.style.display = 'flex';
}
