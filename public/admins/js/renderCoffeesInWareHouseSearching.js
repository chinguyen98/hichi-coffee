const listCoffeeSelect = document.querySelector('select[name="listCoffee"]');
const searchCoffeeInput = document.querySelector('input[name="searchCoffee"]');
const addNewInputDetailBtn = document.querySelector('.addNewInputDetail');
const capacityInput = document.querySelector('input[name="capacity"]');
const inputListContainer = document.querySelector('#inputListContainer');
const dataInput = document.querySelector('input[name="data"]');

const renderListCoffee = (coffees) => {
    return coffees.map(coffee => {
        return `
        <option data-name="${coffee.name}" value="${coffee.id}">${coffee.name}</option>
        `;
    }).join('');
}

const handlingSearchCoffee = async (searchText) => {
    const coffees = await fetch(`http://127.0.0.1:8000/api/coffees?searchingName=${searchText}`).then(res => res.json());
    const exportHtml = renderListCoffee(coffees);
    listCoffeeSelect.innerHTML = exportHtml;
}

const handlingDeleteCoffee = (coffeeId) => {
    document.querySelector(`[data-container="${coffeeId}"]`).parentNode.innerHTML = '';
}

const handlingAppendData = (coffeeId, quantity) => {
    const data = JSON.parse(dataInput.value);
    const index = data.findIndex(item => item.coffeeId === coffeeId);
    if (index === -1) {
        const coffeeInput = { coffeeId, quantity };
        data.push(coffeeInput);
    } else {
        data[index].quantity = quantity;
    }
    dataInput.value = JSON.stringify(data);
}

const addInputDetail = () => {
    const index = listCoffeeSelect.selectedIndex;

    if (index === -1) {
        alert('Vui lòng chọn sản phẩm!');
        return;
    }

    const coffeeName = listCoffeeSelect[index].dataset.name;
    const coffeeId = listCoffeeSelect.value;
    const quantity = capacityInput.value;

    if (quantity === '' || isNaN(quantity) || quantity <= 0) {
        alert('Vui lòng nhập lại số lượng!');
        return;
    }

    const checkCoffee = document.querySelector(`[data-quantity="${coffeeId}"]`);
    if (checkCoffee !== null) {
        checkCoffee.innerHTML = quantity;
        handlingAppendData(coffeeId, quantity);
        return;
    }

    const exportHtml = `
        <div>
            <div data-container="${coffeeId}" class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="input-group mg-b-pro-edt">
                        <div class="input-group-addon">${coffeeId}</div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="input-group mg-b-pro-edt">
                        <span class="input-group-addon">${coffeeName}</span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="input-group mg-b-pro-edt">
                        <span data-quantity="${coffeeId}" class="input-group-addon">${quantity}</span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <a onclick="handlingDeleteCoffee(${coffeeId})" data-toggle="tooltip" title="Xóa" class="btn pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    `;
    const wrapper = document.createElement('div');
    wrapper.innerHTML = exportHtml;
    inputListContainer.appendChild(wrapper);

    handlingAppendData(coffeeId, quantity);
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

searchCoffeeInput.addEventListener('input', debouce(e => {
    handlingSearchCoffee(e.target.value);
}));
addNewInputDetailBtn.addEventListener('click', addInputDetail);