const rightBox = document.querySelector('.rightBox');
const closeMenu = document.querySelector('.closeMenu');
const openMenu = document.querySelector('.openMenu');

openMenu.addEventListener('click', show);
closeMenu.addEventListener('click', close);

function show() {
    // console.log ("BEFORE IS " +rightBox.style.top);
    // rightBox.style.display = 'flex';
    rightBox.style.right = '0px';
    // rightBox.style.top = '0';
    // openMenu.style.display = 'none';
    closeMenu.style.display = 'block';
    // console.log ("BEFORE IS " +rightBox.style.top);
}
function close () {
    // console.log ("AFTER IS " +rightBox.style.top);
    // rightBox.style.display = 'none';
    rightBox.style.right = '-100%';
    // openMenu.style.display = 'block';
    closeMenu.style.display = 'none';
    // console.log ("AFTER IS " +rightBox.style.top);
    rightBox.style.display = 'flex';
    // rightBox.style.right = '0';

}
