async function sendFavorite() {
    const favoriteStorage = localStorage.getItem('favo');
    if (favoriteStorage === null) {
        return;
    }

    const info = favoriteStorage.split('-');

    if (document.querySelector('.favorite')) {
        if (info[1] == 1) {
            favoriteBtn.children[0].classList.add('text-danger');
        } else {
            favoriteBtn.children[0].classList.remove('text-danger');
        }
    }

    const formData = new FormData();
    formData.append('id_coffee', info[0]);
    formData.append('status', info[1]);

    const data = await fetch('/api/favorites', {
        method: 'POST',
        credentials: 'same-origin',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(res => res.json()).then(resJson => resJson);

    localStorage.removeItem('favo');
}

window.addEventListener('load', sendFavorite);