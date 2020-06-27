const fromInput = document.querySelector('input[name="from"]');
const toInput = document.querySelector('input[name="to"]');

function handlingQueryParams() {
    if (fromInput.value !== '') {
        fromInput.setAttribute('form', 'searchForm');
    }
    if (toInput.value !== '') {
        toInput.setAttribute('form', 'searchForm');
    }

    return true;
}