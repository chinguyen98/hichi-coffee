const customerRateList = [...document.querySelectorAll('.customRating')];
const favoriteListArea = document.querySelector('.favoriteListArea');

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

window.addEventListener('load', () => {
    customerRateList !== null && customerRateList.forEach(item => {
        calcRating(item.dataset.star, 'customerRate', item.dataset.id);
    })
});