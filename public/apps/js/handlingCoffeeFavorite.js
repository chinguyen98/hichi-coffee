const favoriteBtn = document.querySelector('.favorite');

function handlingFavorate() {
    favoriteBtn.children[0].classList.contains('text-danger')
        ? favoriteBtn.children[0].classList.remove('text-danger')
        : favoriteBtn.children[0].classList.add('text-danger');
}

favoriteBtn.addEventListener('click', handlingFavorate);