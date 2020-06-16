const hidValuationList = [...document.querySelectorAll('input[name="hidValuation"]')].map(item => JSON.parse(item.value));
const btnAddToCart = document.querySelector('#btnAddToCart');
const quantityInput = document.querySelector('.quantity');
const btnQuantityInsc = document.querySelector('#btn-quantity-insc');
const btnQuantityDesc = document.querySelector('#btn-quantity-desc');
const oldPriceSpan = document.querySelector('.oldPrice');
const newPriceSpan = document.querySelector('.newPrice');
const addToCartBtn = document.querySelector('#btnAddToCart');
const idHidInput = document.querySelector('input[name="hidId"]');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

function getValuation(quantity) {
    let valuation = null;
    hidValuationList.every(item => {
        if (quantity >= item.quantity) {
            valuation = { ...item };
            return false;
        }
        return true;
    })
    return valuation;
}

function addToCart() {
    cartNotify.classList.remove('cartNotify-show');
    let quantity = quantityInput.value;
    const id = idHidInput.value;

    const cartStorage = JSON.parse(localStorage.getItem('carts'));

    if (cartStorage === null || cartStorage.length === 0) {
        localStorage.setItem('carts', JSON.stringify([{
            id: +id,
            qty: parseInt(quantity),
            valuation: getValuation(quantity)?.id,
        }]));
        cartQuantity.innerHTML = 1;
    } else if (cartStorage.findIndex(item => +item.id === +id) !== -1) {
        const index = cartStorage.findIndex(item => +item.id === +id);
        cartStorage[index].qty = parseInt(+cartStorage[index].qty) + parseInt(quantity);
        cartStorage[index].valuation = getValuation(cartStorage[index].qty)?.id;
        localStorage.setItem('carts', JSON.stringify(cartStorage));
        cartQuantity.innerHTML = cartStorage.length;
    } else {
        cartStorage.push({
            id: +id,
            qty: parseInt(quantity),
            valuation: getValuation(quantity)?.id,
        })
        localStorage.setItem('carts', JSON.stringify(cartStorage));
        cartQuantity.innerHTML = cartStorage.length;
    }

    cartNotifyCoffee.innerHTML = `Đã thêm ${quantity} sản phẩm vào giỏ hàng!`;
    cartNotify.classList.add('cartNotify-show');
}

function handingValuation(quantity) {
    if (quantity <= 0 || isNaN(quantity))
        quantityInput.value = 1;

    if (hidValuationList.length === 0) return;

    const valuation = getValuation(quantity);

    if (valuation) {
        oldPriceSpan.classList.remove('text-danger');
        oldPriceSpan.style.textDecoration = 'line-through';
        newPriceSpan.innerHTML = formatPrice(valuation.price);
        newPriceSpan.classList.add('text-danger', 'ml-4');
    } else {
        oldPriceSpan.classList.add('text-danger');
        oldPriceSpan.style.textDecoration = 'none';
        newPriceSpan.innerHTML = ''
        newPriceSpan.classList.remove('text-danger', 'ml-4');
    }
}

function increaseQuantity(e) {
    e.preventDefault();
    quantityInput.value++;
    handingValuation(quantityInput.value);
}

function descreaseQuantity(e) {
    e.preventDefault();
    quantityInput.value--;
    handingValuation(quantityInput.value);
}

btnQuantityInsc.addEventListener('click', increaseQuantity);
btnQuantityDesc.addEventListener('click', descreaseQuantity);
quantityInput.addEventListener('change', (e) => { handingValuation(e.target.value) });
addToCartBtn.addEventListener('click', addToCart);