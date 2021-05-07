const rightMenu = document.querySelector('.rightMenu');
const closeMenu = document.querySelector('.closeMenu');
const openMenu = document.querySelector('.openMenu');

openMenu.addEventListener('click', show);
closeMenu.addEventListener('click', close);

function show() {
    console.log ("BEFORE IS " +rightMenu.style.top);
    rightMenu.style.display = 'flex';
    rightMenu.style.top = '0';
    // openMenu.style.display = 'none';
    closeMenu.style.display = 'block';
    console.log ("BEFORE IS " +rightMenu.style.top);
}
function close () {
    console.log ("AFTER IS " +rightMenu.style.top);
    rightMenu.style.top = '-100%';
    // openMenu.style.display = 'block';
    closeMenu.style.display = 'none';
    console.log ("AFTER IS " +rightMenu.style.top);
    if (screen > 820) {
        
    }
}

let screen = screen.width;