const favoriteBtn = document.querySelector('.favorite');

async function handlingFavorate() {
    favoriteBtn.children[0].classList.contains('text-danger')
        ? favoriteBtn.children[0].classList.remove('text-danger')
        : favoriteBtn.children[0].classList.add('text-danger');

    const formData = new FormData();
    formData.append('id_coffee', commentCoffeeIdInput.value);

    const data = await fetch('/api/favorites', {
        method: 'POST',
        credentials: 'same-origin',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(res => res.json()).then(resJson => resJson);

    console.log(data);
}

favoriteBtn.addEventListener('click', handlingFavorate);