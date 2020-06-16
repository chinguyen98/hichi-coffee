const cartComponent = document.querySelector('#cart-component');
const totalPrice = document.querySelector('.total-price');
const showNoCart = document.querySelector('.showNoCart');
const cartContainer = document.querySelector('.cart-container');
const totalSumContainer = document.querySelector('.total-sum-container');
const hidValuationArea = document.querySelector('.hidValuationArea');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

async function getCartData() {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    if (cartStorage === null || cartStorage.length === 0) {
        cartComponent.innerHTML = "";
        cartComponent.classList.add('cart-close');
        totalSumContainer.classList.add('cart-close');
        const html = `
            <h1 class="text-center">Không có sản phẩm nào trong giỏ hàng</h1>
            <a class="btn btn-primary btn-lg" href="/coffees"><h3 class="d-inline">Tiếp tục mua sắm</h3></a>
        `;
        showNoCart.innerHTML = html;
        return;
    }

    const cartIdList = cartStorage.map(item => item.id).join(',');
    showNoCart.innerHTML = "";

    await fetch(`/api/carts/${cartIdList}`)
        .then(res => {
            return res.json();
        }).then(cartAsJson => {
            renderCart(cartAsJson, cartStorage);
            renderPriceSum(cartAsJson, cartStorage);
        })
}

function renderCart(cartList, cartStorage) {
    const html = cartList.map(item => {
        let hidValInput = [];
        if (item.valuations.length !== 0) {
            hidValInput = item.valuations.map(val => `<input name="hidValuation" type="text" value=${val.id} data-quantity=${val.quantity} data-price="${val.price}">`);
            let wrapper = document.createElement('div');
            wrapper.innerHTML = hidValInput.join('');
            hidValuationArea.appendChild(wrapper);
        }

        const finalPrice = item.valuations.length === 0 ? item.price : item.valuations.find(val => val.id === cartStorage.find(el => el.id === item.id).valuation).price;

        const exportData = `
        <div class="col-md-12 my-4 d-flex flex-row justify-content-between">
            <div class="d-flex flex-row align-items-start">
                <div class="cart-image-container mr-4"><a href="/coffees/${item.id}"><img class="cart-image" src="/apps/images/coffees/${item.image}"></a></div>
                <div>
                    <a href="/coffees/${item.id}"><h5>${item.name}</h5></a>
                    <button class="btn btn-danger btn-delete-cart-item" onclick="deleteItem(${item.id})">Xoá</button>
                    <div class="mt-2">
                    ${
            item.valuations.map(val => `<span> * Giá chỉ còn <span class="text-danger">${formatPrice(val.price)} VNĐ</span> khi mua trên ${val.quantity} sản phẩm</span><br />`).join('')
            }
                </div>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div>
                    <h5 data-finalPrice${item.id}="${finalPrice}">Giá: ${formatPrice(finalPrice)}</h5>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <span data-des="${item.id}" onclick="desCartQuantity(${item.id})" class="quantity-updown text-center">-</span>
                    <input data-price="${item.price}" data-val="${item.id}" onChange="valCartQuantity(${item.id})" style="width:3em" class="text-center" type="text" name="quantity" class="quantity" value="${cartStorage.find(el => el.id === item.id).qty}" />
                    <span data-inc="${item.id}" onclick="incCartQuantity(${item.id})" class="quantity-updown text-center">+</span>
                </div>
            </div>
        </div>
        `;
        return exportData;
    }).join('');
    cartComponent.innerHTML = html;
}

function renderPriceSum(cartList, cartStorage) {
    let sum = cartList.reduce((total, item) => {
        const price = { ...document.querySelector(`[data-finalPrice${item.id}]`).dataset }[`finalprice${item.id}`]
        console.log(price);
        return total + parseInt(cartStorage.find(el => el.id === item.id).qty) * price;
    }, 0);
    let price = String(sum).replace(/(.)(?=(\d{3})+$)/g, '$1,') + " VND";
    totalPrice.innerHTML = price;
}

window.addEventListener('load', getCartData);