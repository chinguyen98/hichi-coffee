const checkoutCart = document.querySelector('.checkout-cart');
const checkoutShippingArea = document.querySelector('.checkout-shipping');
const checkoutPriceArea = document.querySelector('.checkout-price');
const shippingInfoRadioBtn = document.querySelectorAll('input[type="radio"][name="shipping_infos"]');
const checkoutFinalTotalPriceArea = document.querySelector('.checkout-total-price');
const oldPriceArea = document.querySelector('.oldPrice');
const checkoutDistrictArea = document.querySelector('.checkout-district');
const checkoutDistrictLabelArea = document.querySelector('.checkout-district-label');
const hiddenShippingAddressArea = document.querySelector('input[name="id_shipping_address"]');
const checkoutInfoAddressNotifyArea = document.querySelector('.checkout-info__address-notify');
const idDistrictSelect = document.querySelector('select[name="id_district"]');
const idWardSelect = document.querySelector('select[name="id_ward"]');
const addressArea = document.querySelector('input[name="address"]');
const showCreateAddressFormBtn = document.querySelector('.showCreateAddressFormBtn');
const changeAddressForm = document.querySelector('.changeAddressForm');
const closeCreateAddressFormBtn = document.querySelector('.closeCreateAddressFormBtn');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

function renderFinalTotalPrice() {
    if (hiddenShippingAddressArea === null) {
        return parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutPriceArea.dataset.price) + 0;
    }
    return parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutPriceArea.dataset.price) + parseInt(checkoutDistrictArea.dataset.price);
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

async function renderDistrictsSelectInfo() {
    const districts = await fetch(`/api/cities/4/districts`).then(res => res.json());
    let exportDistrictsHtml = '<option value="-1" disabled selected>Chọn quận/huyện</option>';
    exportDistrictsHtml += districts.map(district => {
        return `
            <option value="${district.ID}">${district.Title}</option>
        `;
    }).join('');
    idDistrictSelect.innerHTML = exportDistrictsHtml;
}

async function renderWardsSelectInfo(id_district) {
    const wards = await fetch(`/api/districts/${id_district}/wards`).then(res => res.json());
    let exportWardsHtml = '<option value="-1" disabled selected>Chọn xã/phường</option>';
    exportWardsHtml = wards.map(ward => {
        return `
            <option value="${ward.ID}">${ward.Title}</option>
        `;
    }).join('');
    idWardSelect.innerHTML = exportWardsHtml;
}

async function renderCart() {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    const cartIdList = cartStorage.map(item => item.id).join(',');

    const data = await fetch(`/api/carts/${cartIdList}`).then(res => res.json());
    let district = null;

    if (hiddenShippingAddressArea === null) {
        checkoutInfoAddressNotifyArea.innerHTML = 'Sản phẩm chi giao trong khu vực TPHCM!';
    } else {
        district = await fetch(`/api/districts/${hiddenShippingAddressArea.value}`).then(res => res.json());
        checkoutDistrictLabelArea.innerHTML = district.Title;
    }

    console.log(district)
    console.log(data);

    renderDistrictsSelectInfo();

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
    let oldPrice = 0;

    if (hiddenShippingAddressArea === null) {
        oldPrice = renderOldPrice() + parseInt(checkoutShippingArea.dataset.price) + 0;
    } else {
        oldPrice = renderOldPrice() + parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutDistrictArea.dataset.price);
    }

    oldPriceArea.innerHTML = formatPrice(oldPrice);
}

function renderShippingAndTotalPrice(e) {
    checkoutShippingArea.innerHTML = `${formatPrice(this.value)} VNĐ`;
    checkoutShippingArea.dataset.price = this.value;
    checkoutFinalTotalPriceArea.innerHTML = `${formatPrice(renderFinalTotalPrice())} VNĐ`;

    const oldPrice = renderOldPrice() + parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutDistrictArea.dataset.price);
    oldPriceArea.innerHTML = formatPrice(oldPrice);
}

shippingInfoRadioBtn.forEach(item => {
    item.addEventListener('change', renderShippingAndTotalPrice);
});

window.addEventListener('load', renderCart)
idDistrictSelect.addEventListener('change', (e) => { renderWardsSelectInfo(e.target.value) });
showCreateAddressFormBtn.addEventListener('click', () => { changeAddressForm.classList.add('changeAddressForm--show') });
closeCreateAddressFormBtn.addEventListener('click', () => { changeAddressForm.classList.remove('changeAddressForm--show') });