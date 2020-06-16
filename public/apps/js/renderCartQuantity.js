const cartQuantity = document.querySelector('.cartQuantity');
const cartNotify = document.querySelector('.cartNotify');
const cartNotifyClose = document.querySelector('.cartNotify__close');
const cartNotifyCoffee = document.querySelector('.cartNotify__coffee');

function handingCartQuantity() {
    const carts = JSON.parse(localStorage.getItem('carts'));
    if (carts?.length === 0 || carts === null) {
        cartQuantity.innerHTML = 0;
    }else{
        cartQuantity.innerHTML = carts.length;
    }
    
}

function closeCartNotify(e) {
    cartNotify.classList.remove('cartNotify-show');
}

cartNotifyClose.addEventListener('click', closeCartNotify);
window.addEventListener('load', handingCartQuantity);