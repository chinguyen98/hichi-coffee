const favoriteListArea = document.querySelector('.favoriteListArea');

function formatPrice(price) {
    return String(price).replace(/(.)(?=(\d{3})+$)/g, '$1,');
}

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

async function deleteFavorite(id) {
    await fetch(`/api/favorites/${id}`, {
        method: 'DELETE',
        credentials: "same-origin",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    });

    let count = parseInt(document.querySelector('.favoriteCount').innerHTML);
    count = count - 1;

    document.querySelector(`.favoContainer-${id}`).remove();
    document.querySelector('.favoriteCount').innerHTML = count;
}

async function getFavorites() {
    const favorites = await fetch('/api/favorites', {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    }).then(res => res.json()).then(res => res);

    document.querySelector('.favoriteCount').innerHTML = favorites.length;

    const exportHtml = favorites.map(item => {
        return `
                <div style="background-color: rgba(255, 255, 255, 0.05);" class="p-3 row dmsp-main-container__list d-lg-flex flex-wrap my-4 favoContainer-${item.coffee.id}">
                    <div class="col col-md-2">
                        <a href="/coffees/${item.coffee.slug}">
                            <img style="width: 100%; height: auto;" src="/apps/images/coffees/${item.coffee.image}" alt="{{$favorite->coffee->image}}">
                        </a>
                    </div>
                    <div class="col col-md-9">
                        <a href="/coffees/${item.coffee.slug}">
                            <p style="font-size:20px"><b>${item.coffee.name}</b></p>
                        </a>
                        <span class="text-white"><b>${item.coffee.brand.name}</b></span><br>

                        <div class="d-flex flex-row align-items-center">
                            <div data-star="${item.coffee.avgRating}" data-id="${item.coffee.id}" class="customRating customerRate mr-3">
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
                            <div>
                                <span class="text-white">(${item.coffee.coffee_comment_count} nhận xét)</span>
                            </div>
                        </div>
                        <p class="text-danger" style="font-size:20px"><b>${formatPrice(item.coffee.price)} đ</b></p>
                    </div>
                    <div class="col col-md-1">
                        <button class='btn btn-danger' onclick="deleteFavorite(${item.coffee.id})">XOÁ</button>
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