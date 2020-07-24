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

async function getFavorites() {
    const favorites = await fetch('/api/favorites', {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    }).then(res => res.json()).then(res => res);

    const exportHtml = favorites.map(item => {
        return `
                <div class="pt-3 row dmsp-main-container__list d-lg-flex flex-wrap my-4">
                    <div class="col col-md-2">
                    <a href="/coffees/${item.coffee.slug}">
                        <img style="width: 100%; height: auto;" src="/apps/images/coffees/${item.coffee.image}" alt="{{$favorite->coffee->image}}">
                    </a>
                </div>  
                <div class="col col-md-8">
                    <a href="/coffees/${item.coffee.slug}">
                        <p>${item.coffee.name}</p>
                    </a>
                    <span>${item.coffee.brand.name}</span><br>

                    <div data-star="${item.coffee.avgRating}" data-id="${item.coffee.id}" class="customRating customerRate">
                        <label class="full" for="sstar5"></label>

                        <label class="half" for="sstar4half"></label>

                        <label class="full" for="sstar4"></label>

                        <label class="half" for="sstar3half"></label>

                        <label class="full" for="sstar3"></label>

                        <label class="half" for="sstar2half"></label>

                        <label class="full" for="star2"></label>

                        <label class="half" for="star1half"></label>

                        <label class="full" for="sstar1"></label>

                        <label class="half" for="sstarhalf"></label>
                    </div>
                </div>
            </div>
        `;
    }).join('');
    favoriteListArea.innerHTML = exportHtml;

    const customerRateList = [...document.querySelectorAll('.customRating')];
    customerRateList !== null && customerRateList.forEach(item => {
        calcRating(item.dataset.star, 'customerRate', item.dataset.id);
    })
}

window.addEventListener('load', () => {
    getFavorites();
});