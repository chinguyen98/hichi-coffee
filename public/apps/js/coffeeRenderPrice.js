const hidValuationList = [...document.querySelectorAll('input[name="hidValuation"]')].map(item => JSON.parse(item.value));
const btnAddToCart = document.querySelector('#btnAddToCart');
const quantityInput = document.querySelector('.quantity');
const btnQuantityInsc = document.querySelector('#btn-quantity-insc');
const btnQuantityDesc = document.querySelector('#btn-quantity-desc');
const oldPriceSpan = document.querySelector('.oldPrice');
const newPriceSpan = document.querySelector('.newPrice');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

function handingValuation(quantity) {
    if (quantityInput.value <= 0)
        quantityInput.value = 1;

    if (hidValuationList.length === 0) return;

    let valuation = null;
    hidValuationList.every(item => {
        if (quantity >= item.quantity) {
            valuation = { ...item };
            return false;
        }
        return true;
    })

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
quantityInput.addEventListener('change', (e) => { handingValuation(e.target.value) })