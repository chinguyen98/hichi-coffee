function calcRating(r, areaRating, id = null) {
    const f = Math.floor(r * 2);
    let ratingStarList;
    if (areaRating == 'loadAvg') {
        ratingStarList = [...document.querySelectorAll(`.${areaRating} > label`)].reverse();
    } else {
        ratingStarList = [...document.querySelectorAll(`.${areaRating}[data-id="${id}"] > label`)].reverse();
    }

    ratingStarList.every((item, index) => {
        if (index === f)
            return false;
        item.classList.add('customRating-checked');
        return true;
    });
}

function showRating() {
    const customerRateList = [...document.querySelectorAll('.customRating')];
    customerRateList !== null && customerRateList.forEach(item => {
        calcRating(item.dataset.star, 'customerRate', item.dataset.id);
    })
}

async function deleteComment(id) {
    const data = await fetch(`/api/comments/${id}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(res => res.json()).then(res => res);

    document.querySelector(`.favoContainer-${id}`).remove();
}

window.addEventListener('load', showRating);