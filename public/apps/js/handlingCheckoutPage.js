const checkoutCart = document.querySelector('.checkout-cart');
const checkoutShippingArea = document.querySelector('.checkout-shipping');
const checkoutPriceArea = document.querySelector('.checkout-price');
const shippingInfoRadioBtn = document.querySelectorAll('input[type="radio"][name="shipping_infos"]');
const checkoutFinalTotalPriceArea = document.querySelector('.checkout-total-price');
const oldPriceArea = document.querySelector('.oldPrice');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

function renderFinalTotalPrice() {
    return parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutPriceArea.dataset.price);
}

function renderOldPrice() {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    const cartIdList = cartStorage.map(item => item.id);
    let price = cartIdList.reduce((total, item) => {
        let quantity = parseInt(cartStorage.find(el => el.id === item).qty);
        let price = document.querySelector(`span[data-id="${item}"]`).dataset.price;
        return total + (price * quantity);
    }, 0);
    return price;
}

async function renderCart() {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    const cartIdList = cartStorage.map(item => item.id).join(',');

    const data = await fetch(`/api/carts/${cartIdList}`).then(res => res.json());
    console.log(data);

    const exportCartHtml = data.map((cart) => {
        return `
            <div class="d-flex flex-row p-2">
                <span class="mr-3 text-primary">${cartStorage.find(el => el.id === cart.id).qty}x</span>
                <span data-id="${cart.id}" data-price="${cart.price}">${cart.name}</span>
            </div>
        `;
    }).join('');
    checkoutCart.innerHTML = exportCartHtml;
    checkoutShippingArea.innerHTML = `${formatPrice(document.querySelector('[name="shipping_infos"]').value)} VNĐ`;
    checkoutShippingArea.dataset.price = document.querySelector('[name="shipping_infos"]').value;

    const totalPrice = cartStorage.reduce((total, cart) => {
        const quantity = cart.qty;
        let price = 0;
        if (!cart.valuation) {
            price = data.find(item => item.id === cart.id).price;
        } else {
            const valuations = data.find(item => item.id === cart.id).valuations;
            price = valuations.find(item => item.id === cart.valuation).price;
        }
        return total + (price * quantity);
    }, 0)

    checkoutPriceArea.innerHTML = `${formatPrice(totalPrice)} VNĐ`;
    checkoutPriceArea.dataset.price = totalPrice;

    checkoutFinalTotalPriceArea.innerHTML = `${formatPrice(renderFinalTotalPrice())} VNĐ`;
    const oldPrice = renderOldPrice() + parseInt(document.querySelector('[name="shipping_infos"]').value);
    oldPriceArea.innerHTML = formatPrice(oldPrice);
}

function renderShippingAndTotalPrice(e) {
    checkoutShippingArea.innerHTML = `${formatPrice(this.value)} VNĐ`;
    checkoutShippingArea.dataset.price = this.value;
    checkoutFinalTotalPriceArea.innerHTML = `${formatPrice(renderFinalTotalPrice())} VNĐ`;
    const oldPrice = renderOldPrice() + parseInt(document.querySelector('[name="shipping_infos"]').value);
    oldPriceArea.innerHTML = formatPrice(oldPrice);
}

shippingInfoRadioBtn.forEach(item => {
    item.addEventListener('change', renderShippingAndTotalPrice);
});

window.addEventListener('load', renderCart)