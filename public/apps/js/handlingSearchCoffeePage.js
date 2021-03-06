const fromInput = document.querySelector('input[name="from"]');
const toInput = document.querySelector('input[name="to"]');
const moreFilterArea = document.querySelector('.moreFilter');
const moreFilterBtn = document.querySelector('.moreFilterBtn');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

function handlingQueryParams() {
    if (fromInput.value !== '') {
        fromInput.setAttribute('form', 'searchForm');
    }
    if (toInput.value !== '') {
        toInput.setAttribute('form', 'searchForm');
    }
    if (+toInput.value.split(',').join('') < +fromInput.value.split(',').join('')) {
        alert('Vui lòng nhập đúng giá!');
        fromInput.removeAttribute('form', 'searchForm');
        toInput.removeAttribute('form', 'searchForm');
        return false;
    }

    return true;
}

fromInput.addEventListener('input', (e) => {
    fromInput.value = formatPrice(e.target.value.split(',').join(''));
});
toInput.addEventListener('input', (e) => {
    toInput.value = formatPrice(e.target.value.split(',').join(''));
});
moreFilterBtn.addEventListener('click', (e) => {
    e.preventDefault();
    moreFilterArea.classList.contains('d-none') ? moreFilterArea.classList.remove('d-none') : moreFilterArea.classList.add('d-none');
})