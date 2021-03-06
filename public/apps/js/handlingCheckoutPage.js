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
const createAddressform = document.querySelector('.createAddressform');
const closeCreateAddressFormBtn = document.querySelector('.closeCreateAddressFormBtn');
const changeAddressFormDetail = [...document.querySelectorAll('.changeAddressFormDetail')];
const changeAddressFormSubmmit = document.querySelector('#changeAddressFormSubmmit');
const changeAddressFormArea = document.querySelector('.changeAddressForm');
const showChangeAddressFormBtn = document.querySelector('.showChangeAddressForm');
const closeChangeAddressFormBtn = document.querySelector('.closeChangeAddressFormBtn');
const currentIdHiddenInput = document.querySelector('input[type="hidden"][name="id"]');
const combinedAddressArea = document.querySelector('.combinedAddress');
const cartHiddenInput = document.querySelector('input[name="cart"]');
const totalPriceHiddenInput = document.querySelector('input[name="totalPrice"]');
const shippingHiddenInput = document.querySelector('input[name="shippingType"]');
const submitBtn = document.querySelector('[name="submitBtn"]');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

async function renderChangeAddressForm() {
    let getData = await Promise.all(changeAddressFormDetail.map(async (item, index) => {
        const id_city = document.querySelector(`[data-address="${item.dataset.address}"] [name="id_city"]`).value;
        const id_district = document.querySelector(`[data-address="${item.dataset.address}"] [name="id_district"]`).value;
        const id_ward = document.querySelector(`[data-address="${item.dataset.address}"] [name="id_ward"]`).value;
        const address = document.querySelector(`[data-address="${item.dataset.address}"] [name="address"]`).value;

        const city = await fetch(`api/cities/${id_city}`).then(res => res.json());
        const district = await fetch(`api/districts/${id_district}`).then(res => res.json());
        const ward = await fetch(`api/wards/${id_ward}`).then(res => res.json());

        const combinedAddress = `${address}, ${ward.Title}, ${district.Title}, ${city.Title}`;

        if (+item.dataset.address === +currentIdHiddenInput.value) {
            combinedAddressArea.innerHTML = `Địa chỉ: ${combinedAddress}.`;
        }

        const exportHtml = `
            <input id="${item.dataset.address}" form="submitChange" type="radio" name="addressOfChanging" value="${item.dataset.address}" ${+item.dataset.address === +currentIdHiddenInput.value ? 'checked' : ''}>
            <label for="${item.dataset.address}">${combinedAddress}</label><br>
        `;
        return exportHtml;
    }));
    changeAddressFormSubmmit.innerHTML = getData.join('');
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

function IsValidJSONString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

async function checkCart() {
    if (!IsValidJSONString(localStorage.getItem('carts'))) {
        localStorage.removeItem('carts');
        window.location.replace('/');
    }

    const cartStorage = JSON.parse(localStorage.getItem('carts'));

    if (cartStorage === null || cartStorage.length === 0 || !Array.isArray(cartStorage)) {
        localStorage.removeItem('carts');
        window.location.replace('/');
    }

    cartStorage.forEach(item => {
        if (JSON.stringify(Object.keys(item)) !== JSON.stringify(["id", "qty"]) && JSON.stringify(Object.keys(item)) !== JSON.stringify(["id", "qty", "valuation"])) {
            localStorage.removeItem('carts');
            window.location.replace('/');
        }

        Object.values(item).forEach(num => {
            if (typeof num === 'string' || !Number.isInteger(num) || num < 0) {
                localStorage.removeItem('carts');
                window.location.replace('/');
            }
        })
    })
}

async function renderCart() {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    const cartIdList = cartStorage.map(item => item.id).join(',');

    const data = await fetch(`/api/carts/${cartIdList}`).then(res => res.json());
    let district = null;

    // if (hiddenShippingAddressArea === null) {
    //     checkoutInfoAddressNotifyArea.innerHTML = 'Sản phẩm chi giao trong khu vực TPHCM! <br /> Vui lòng nhập địa chỉ khác.';
    // } else {
    //     district = await fetch(`/api/districts/${hiddenShippingAddressArea.value}`).then(res => res.json());
    //     checkoutDistrictLabelArea.innerHTML = district.Title;
    // }

    const exportCartHtml = data.map((cart) => {
        return `
            <div class="d-flex flex-row p-2">
                <span class="mr-3 text-success">${cartStorage.find(el => el.id === cart.id).qty}x</span>
                <span style="color:peru; font-size:18px;" data-id="${cart.id}" data-price="${cart.price}">${cart.name}</span>
            </div>
        `;
    }).join('');
    checkoutCart.innerHTML = exportCartHtml;
    checkoutShippingArea.innerHTML = `${formatPrice(document.querySelector('[name="shipping_infos"]').value)} đ`;
    checkoutShippingArea.dataset.price = document.querySelector('[name="shipping_infos"]').value;

    const totalPrice = cartStorage.reduce((total, cart) => {
        const quantity = cart.qty;
        let price = 0;
        if (!cart.valuation) {
            price = data.find(item => item.id === cart.id).price;
        } else {
            const valuations = data.find(item => item.id === cart.id).valuations;
            price = valuations.find(item => item.id == cart.valuation).price;
        }
        return total + (price * quantity);
    }, 0)

    checkoutPriceArea.innerHTML = `${formatPrice(totalPrice)} đ`;
    checkoutPriceArea.dataset.price = totalPrice;

    checkoutFinalTotalPriceArea.innerHTML = `${formatPrice(renderFinalTotalPrice())} đ`;
    checkoutFinalTotalPriceArea.dataset.totalPrice = renderFinalTotalPrice();
    let oldPrice = 0;

    if (hiddenShippingAddressArea === null) {
        oldPrice = renderOldPrice() + parseInt(checkoutShippingArea.dataset.price) + 0;
    } else {
        oldPrice = renderOldPrice() + parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutDistrictArea.dataset.price);
    }

    oldPriceArea.innerHTML = formatPrice(oldPrice);

    renderDistrictsSelectInfo();
    // if (showChangeAddressFormBtn !== null) {
    //     renderChangeAddressForm();
    // }
}

function renderShippingAndTotalPrice(e) {
    checkoutShippingArea.innerHTML = `${formatPrice(this.value)} đ`;
    checkoutShippingArea.dataset.price = this.value;
    checkoutFinalTotalPriceArea.innerHTML = `${formatPrice(renderFinalTotalPrice())} đ`;
    checkoutFinalTotalPriceArea.dataset.totalPrice = renderFinalTotalPrice();

    const oldPrice = renderOldPrice() + parseInt(checkoutShippingArea.dataset.price) + parseInt(checkoutDistrictArea.dataset.price);
    oldPriceArea.innerHTML = formatPrice(oldPrice);
}

function handingCheckout() {
    submitBtn.value = 'Đang xử lý...';
    submitBtn.classList.replace('btn-danger', 'btn-secondary');
    document.querySelector('[name="submitBtn"]').disabled='true';
    submitBtn.style.cursor = 'wait';

    cartHiddenInput.value = localStorage.getItem('carts');
    totalPriceHiddenInput.value = checkoutFinalTotalPriceArea.dataset.totalPrice;
    shippingHiddenInput.value = document.querySelector('input[name="shipping_infos"]:checked').id;

    localStorage.removeItem('carts');

    return true;
}

shippingInfoRadioBtn.forEach(item => {
    item.addEventListener('change', renderShippingAndTotalPrice);
});

window.addEventListener('DOMContentLoaded', () => {
    checkCart();
});

window.addEventListener('load', () => {
    renderCart();
})
idDistrictSelect.addEventListener('change', (e) => { renderWardsSelectInfo(e.target.value) });

if (showChangeAddressFormBtn !== null) {
    showChangeAddressFormBtn.addEventListener('click', () => {
        createAddressform.classList.remove('createAddressform--show');
        changeAddressFormArea.classList.add('changeAddressForm--show')
    });
    closeChangeAddressFormBtn.addEventListener('click', () => { changeAddressFormArea.classList.remove('changeAddressForm--show') });
}

showCreateAddressFormBtn.addEventListener('click', () => {
    showChangeAddressFormBtn !== null && changeAddressFormArea.classList.remove('changeAddressForm--show')
    createAddressform.classList.add('createAddressform--show');
});
closeCreateAddressFormBtn.addEventListener('click', () => { createAddressform.classList.remove('createAddressform--show') });
window.addEventListener('storage', () => {
    localStorage.removeItem('carts');
    window.location.replace('/');
});