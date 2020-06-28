const listCoffeeSelect = document.querySelector('select[name="id_coffee"]');
const searchCoffeeInput = document.querySelector('input[name="searchCoffee"]');
const oldPriceInput = document.querySelector('input[name="oldPrice"]');
const priceInput = document.querySelector('input[name="price"]');
const discountInput = document.querySelector('input[name="discount"]');
const quantityInput = document.querySelector('input[name="quantity"]');

const renderListCoffee = (coffees) => {
    return coffees.map(coffee => {
        return `
        <option data-quantity="${coffee.quantity}" data-price="${coffee.price}" data-name="${coffee.name}" value="${coffee.id}">${coffee.name}</option>
        `;
    }).join('');
}

const handlingSearchCoffee = async (searchText) => {
    const coffees = await fetch(`http://127.0.0.1:8000/api/coffees?searchingName=${searchText}`).then(res => res.json());
    const exportHtml = renderListCoffee(coffees);
    listCoffeeSelect.innerHTML = exportHtml;
    handlingChangeCoffeeInput();
}

const debouce = (func, wait = 500) => {
    let timeout;
    return function (...args) {
        if (timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(() => {
            func(...args);
        }, wait);
    }
}

const handlingChangeCoffeeInput = () => {
    const index = listCoffeeSelect.selectedIndex;

    if (index === -1) return;

    const oldPrice = listCoffeeSelect[index].dataset.price;
    quantityInput.max = listCoffeeSelect[index].dataset.quantity;
    oldPriceInput.value = oldPrice;
}

const renderDiscountPrice = (e) => {
    const percent = e.target.value;
    if (percent <= 0 || isNaN(percent)) {
        alert('Vui lòng nhập lại giá khuyến mãi!');
        e.target.value = '';
        return;
    }
    if (percent >= +oldPriceInput.value) {
        discountInput.value = oldPriceInput.value;

    }
    if (oldPriceInput.value === '') {
        alert('Vui lòng chọn sản phẩm được khuyến mãi!');
        return;
    }
    const discountPrice = oldPriceInput.value - discountInput.value;
    priceInput.value = discountPrice;
}

searchCoffeeInput.addEventListener('input', debouce(e => {
    handlingSearchCoffee(e.target.value);
}));
listCoffeeSelect.addEventListener('change', handlingChangeCoffeeInput)
discountInput.addEventListener('input', renderDiscountPrice);