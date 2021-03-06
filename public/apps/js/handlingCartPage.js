const cartComponent = document.querySelector('#cart-component');
const totalPrice = document.querySelector('.total-price');
const showNoCart = document.querySelector('.showNoCart');
const cartContainer = document.querySelector('.cart-container');
const totalSumContainer = document.querySelector('.total-sum-container');
const hidValuationArea = document.querySelector('.hidValuationArea');
let cartFromApi = null;

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

// function checkRemainQuantity(id, quantity) {
//     const remainQuantity = parseInt(cartFromApi.find(item => +item.id === +id).quantity);
//     if (parseInt(quantity) > remainQuantity) {
//         document.querySelector(`input[data-val="${id}"]`).value = remainQuantity;

//         document.querySelector('.notify').classList.remove('notify--show')
//         document.querySelector('.notity__error').innerHTML = `Sản phẩm này số lượng còn ${remainQuantity}!`;
//         document.querySelector('.notify').classList.add('notify--show');
//         setTimeout(() => {
//             document.querySelector('.notify').classList.remove('notify--show')
//         }, 1500);

//         return remainQuantity;
//     }

//     return quantity;
// }

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
            cartFromApi = cartAsJson;
            renderCart(cartAsJson, cartStorage);
            renderPriceSum(cartAsJson, cartStorage);
        })
}

function renderCart(cartList, cartStorage) {
    const html = cartList.map(item => {
        let hidValInput = [];
        if (item.valuations.length !== 0) {
            hidValInput = item.valuations.map(val => `<input name="hidValuation" type="hidden" value=${val.id} data-quantity=${val.quantity} data-price="${val.price}">`);
            let wrapper = document.createElement('div');
            wrapper.setAttribute('data-valuation-container', item.id);
            wrapper.innerHTML = hidValInput.join('');
            hidValuationArea.appendChild(wrapper);
        }

        const finalprice = item.valuations.length === 0 ? item.price : item.valuations.find(val => val.id === cartStorage.find(el => el.id === item.id).valuation)?.price;

        const exportData = `
        <div class="col-md-12 my-4 d-flex flex-row justify-content-between">
            <div class="d-flex flex-row align-items-start">
                <div class="cart-image-container mr-4"><a href="/coffees/${item.slug}"><img class="cart-image" src="/apps/images/coffees/${item.image}"></a></div>
                <div>
                    <a href="/coffees/${item.slug}"><h5>${item.name}</h5></a>
                    <span class="text-danger" data-notifyQty="${item.id}"></span>
                    <button class="btn btn-danger btn-delete-cart-item mt-2" onclick="deleteItem(${item.id})">Xoá</button>
                    <div class="mt-2">
                    ${
            item.valuations
                .filter(item => item.quantity !== null)
                .map(val => `<span> * Giá chỉ còn <span class="text-danger">${formatPrice(val.price)} đ</span> khi mua trên ${val.quantity} sản phẩm</span><br />`).join('')
            }
                </div>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div>
                    <h5 data-oldPrice${item.id}="${item.price}" data-finalprice${item.id}="${finalprice === undefined ? item.price : finalprice}">Giá: ${formatPrice(finalprice === undefined ? item.price : finalprice)} </h5>
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
    cartComponent.classList.add('border');
}

function renderPriceSum(cartList, cartStorage) {
    let sum = cartList.reduce((total, item) => {
        const price = { ...document.querySelector(`[data-finalprice${item.id}]`).dataset }[`finalprice${item.id}`]
        return total + parseInt(cartStorage.find(el => el.id === item.id).qty) * price;
    }, 0);
    let price = String(sum).replace(/(.)(?=(\d{3})+$)/g, '$1,') + " đ";
    totalPrice.innerHTML = price;
}

function changeToTalPrice(id) {
    let sum = Array.from(document.querySelectorAll('input[data-val]')).reduce((total, item) => {
        const price = { ...document.querySelector(`[data-oldprice${item.dataset.val}]`).dataset }[`finalprice${item.dataset.val}`];
        return total + parseInt(item.value) * parseInt(price);
    }, 0);
    let price = String(sum).replace(/(.)(?=(\d{3})+$)/g, '$1,') + " đ";
    totalPrice.innerHTML = price;
}

function deleteItem(id) {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    const index = cartStorage.findIndex(item => +item.id === +id);
    cartStorage.splice(index, 1);
    localStorage.setItem('carts', JSON.stringify(cartStorage));
    getCartData();
    cartQuantity.innerHTML = cartStorage.length;
}

function desCartQuantity(id) {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    let getQuantity = cartStorage.find(el => el.id === id).qty;
    let valueInput = document.querySelector(`input[data-val="${id}"]`);
    const index = cartStorage.findIndex(item => +item.id === +id);

    getQuantity = getQuantity - 1;
    if (getQuantity <= 0)
        getQuantity = 1;

    cartStorage[index].qty = +getQuantity;
    valueInput.value = cartStorage[index].qty;

    const arrValuaion = [...document.querySelectorAll(`[data-valuation-container="${id}"] input[name="hidValuation"]`)];
    if (arrValuaion.length !== 0) {
        for (let i = arrValuaion.length - 1; i >= -1; i--) {
            if (i === -1) {
                const price = { ...document.querySelector(`[data-oldprice${id}]`).dataset }[`oldprice${id}`]
                document.querySelector(`[data-finalprice${id}]`).innerHTML = `Giá: ${formatPrice(price)}`;
                document.querySelector(`[data-finalprice${id}]`).dataset[`finalprice${id}`] = price;
                delete cartStorage[index].valuation;
                break;
            }

            if (arrValuaion[i].dataset.quantity <= getQuantity) {
                document.querySelector(`[data-finalprice${id}]`).innerHTML = `Giá: ${formatPrice(arrValuaion[i].dataset.price)}`;
                document.querySelector(`[data-finalprice${id}]`).dataset[`finalprice${id}`] = arrValuaion[i].dataset.price;
                cartStorage[index].valuation = +arrValuaion[i].value;
                break;
            }
        }
    }

    localStorage.setItem('carts', JSON.stringify(cartStorage));

    changeToTalPrice(id);
}

function incCartQuantity(id) {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    let getQuantity = cartStorage.find(el => el.id === id).qty;
    let valueInput = document.querySelector(`input[data-val="${id}"]`);
    const index = cartStorage.findIndex(item => +item.id === +id);

    getQuantity = getQuantity + 1;
    if (getQuantity <= 0)
        getQuantity = 1;

    cartStorage[index].qty = +getQuantity;
    valueInput.value = cartStorage[index].qty;

    const arrValuaion = [...document.querySelectorAll(`[data-valuation-container="${id}"] input[name="hidValuation"]`)];
    if (arrValuaion.length !== 0) {
        for (let i = arrValuaion.length - 1; i >= -1; i--) {
            if (i === -1) {
                const price = { ...document.querySelector(`[data-oldprice${id}]`).dataset }[`oldprice${id}`]
                document.querySelector(`[data-finalprice${id}]`).innerHTML = `Giá: ${formatPrice(price)}`;
                delete cartStorage[index].valuation;
                break;
            }

            if (arrValuaion[i].dataset.quantity <= getQuantity) {
                document.querySelector(`[data-finalprice${id}]`).innerHTML = `Giá: ${formatPrice(arrValuaion[i].dataset.price)}`;
                document.querySelector(`[data-finalprice${id}]`).dataset[`finalprice${id}`] = arrValuaion[i].dataset.price;
                cartStorage[index].valuation = +arrValuaion[i].value;
                break;
            }
        }
    }

    localStorage.setItem('carts', JSON.stringify(cartStorage));

    changeToTalPrice(id);
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

    if (cartStorage !== null || cartStorage.length !== 0) {
        if (!Array.isArray(cartStorage)) {
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
}

function valCartQuantity(id) {
    const cartStorage = JSON.parse(localStorage.getItem('carts'));
    let getQuantity = cartStorage.find(el => el.id === id).qty;
    let valueInput = document.querySelector(`input[data-val="${id}"]`);
    const index = cartStorage.findIndex(item => +item.id === +id);

    if (isNaN(valueInput.value)) {
        valueInput.value = 1;
        document.querySelector('.notify').classList.remove('notify--show')
        document.querySelector('.notity__error').innerHTML = `Số lượng bạn nhập vào không hợp lệ!`;
        document.querySelector('.notify').classList.add('notify--show');
        setTimeout(() => {
            document.querySelector('.notify').classList.remove('notify--show')
        }, 1500);
    }
    if (valueInput.value <= 0)
        valueInput.value = 1;

    const remainQuantity = parseInt(cartFromApi.find(item => +item.id === +id).quantity);
    if (valueInput.value > remainQuantity) {
        document.querySelector(`span[data-notifyQty="${id}"]`).innerHTML = `Đã quá số lượng trong kho (${remainQuantity}).<br /> Chúng tôi sẽ xác nhận với bạn để nhập hàng.<br />`;
    } else {
        document.querySelector(`span[data-notifyQty="${id}"]`).innerHTML = '';
    }

    cartStorage[index].qty = +valueInput.value;

    const arrValuaion = [...document.querySelectorAll(`[data-valuation-container="${id}"] input[name="hidValuation"]`)];
    if (arrValuaion.length !== 0) {
        for (let i = arrValuaion.length - 1; i >= -1; i--) {
            if (i === -1) {
                const price = { ...document.querySelector(`[data-oldprice${id}]`).dataset }[`oldprice${id}`]
                document.querySelector(`[data-finalprice${id}]`).innerHTML = `Giá: ${formatPrice(price)}`;
                document.querySelector(`[data-finalprice${id}]`).dataset[`finalprice${id}`] = price;
                delete cartStorage[index].valuation;
                break;
            }

            if (arrValuaion[i].dataset.quantity <= +valueInput.value) {
                document.querySelector(`[data-finalprice${id}]`).innerHTML = `Giá: ${formatPrice(arrValuaion[i].dataset.price)}`;
                document.querySelector(`[data-finalprice${id}]`).dataset[`finalprice${id}`] = arrValuaion[i].dataset.price;
                cartStorage[index].valuation = +arrValuaion[i].value;
                break;
            }
        }
    }

    localStorage.setItem('carts', JSON.stringify(cartStorage));

    changeToTalPrice(id);
}

window.addEventListener('DOMContentLoaded', () => {
    checkCart();
});
window.addEventListener('storage', () => {
    checkCart();
});
window.addEventListener('load', getCartData);
