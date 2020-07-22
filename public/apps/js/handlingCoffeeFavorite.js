const favoriteBtn = document.querySelector('.favorite');

async function handlingFavorate() {
    const id_coffee = commentCoffeeIdInput.value;
    localStorage.setItem('favo', 1);
    favoriteBtn.children[0].classList.contains('text-danger')
        ? (() => {
            favoriteBtn.children[0].classList.remove('text-danger');
            localStorage.setItem('favo', `${id_coffee}-0`);
        })()
        : (() => {
            favoriteBtn.children[0].classList.add('text-danger');
            localStorage.setItem('favo', `${id_coffee}-1`);
        })()
}

favoriteBtn.addEventListener('click', handlingFavorate);