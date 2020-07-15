const writeCommentBtn = document.querySelector('.writeCommentBtn');
const writeCommentArea = document.querySelector('.writeCommentArea');
const ratingStarList = [...document.querySelectorAll('#rating input[type="radio"]')];
const addCommentBtn = document.querySelector('.addCommentBtn');
const commentTitleInput = document.querySelector('input[name="commentTitle"]');
const commentContentInput = document.querySelector('textarea[name="commentContent"]');
const commentImageInput = document.querySelector('input[name="commentImage"]');
const commentCoffeeIdInput = document.querySelector('input[name="commentCoffeeId"]');
const avgRatingInput = document.querySelector('input[name="avgRating"]');
const ratingErrArea = document.querySelector('.rating-err');
const contentErrArea = document.querySelector('.commentContent-err');
const imagesErrArea = document.querySelector('.commentImage-err');
const previewImageArea = document.querySelector('.previewImageArea');
const customerRateList = [...document.querySelectorAll('.customerRate')];
const replyBtnList = [...document.querySelectorAll('.replyBtn')];
const replyCloseBtnList = [...document.querySelectorAll('.replyCloseBtn')];
const sendReplyBtnList = [...document.querySelectorAll('.sendReplyBtn')];
let scaleImage = [];

function countWord(str) {
    return str.trim().split(' ')
        .filter(function (n) { return n != '' })
        .length;
}

function validateForm(rating, content) {
    let flag = true;
    ratingErrArea.innerHTML = '';
    contentErrArea.innerHTML = '';
    if (rating === undefined) {
        ratingErrArea.innerHTML = 'Vui lòng chọn đánh giá của bạn về sản phẩm này';
        flag = false;
    }
    if (content === '') {
        contentErrArea.innerHTML = 'Vui lòng nhập đánh giá của bạn';
        flag = false;
    }
    return flag;
}

async function handlingAddNewComment() {
    const rating = document.querySelector('#rating input[type="radio"]:checked')?.value;
    const title = commentTitleInput.value;
    const content = commentContentInput.value;
    const id_coffee = commentCoffeeIdInput.value;
    if (!validateForm(rating, content)) {
        return;
    }

    const formData = new FormData();
    formData.append('rating', rating);
    formData.append('title', title);
    formData.append('content', content);
    formData.append('id_coffee', id_coffee);
    scaleImage.forEach(image => {
        formData.append('image[]', image);
    });

    // for (let i of formData) {
    //     console.log(i)
    // }

    const data = await fetch('/api/comments', {
        method: 'POST',
        credentials: 'same-origin',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(res => res.json()).then(dataJson => dataJson);

    writeCommentArea.innerHTML = '';
    document.querySelector('.writeYourComment').innerHTML = '<h1 class="text-center text-danger">Cảm ơn bạn đã đánh giá sản phẩm!</h1>';
    document.querySelector('#flag').scrollIntoView(true);
    //console.log(data);
}

function handlingPreviewImage() {
    imagesErrArea.innerHTML = '';
    previewImageArea.innerHTML = '';
    scaleImage.length = 0;

    if (this.files) {
        if (this.files.length > 5) {
            imagesErrArea.innerHTML = 'Vui lòng upload tối đa 5 hình ảnh!';
            commentImageInput.value = '';
            return;
        }

        [...this.files].forEach((file, index) => {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                imagesErrArea.innerHTML = 'Vui lòng upload đúng định dạng hình ảnh!';
                return;
            }

            const fileReader = new FileReader();
            fileReader.addEventListener('load', () => {
                let image = new Image();
                image.height = '100';
                image.width = '100';
                image.title = file.name;
                image.src = fileReader.result;
                image.style.borderRadius = '20%';
                image.style.margin = '0 0.2rem';
                previewImageArea.appendChild(image);

                image.addEventListener('load', (e) => {
                    const canvas = document.createElement('canvas');
                    const MAX_WIDTH = 175;

                    const scaleSize = MAX_WIDTH / e.target.width;
                    canvas.width = MAX_WIDTH;
                    canvas.height = e.target.height * scaleSize;

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);

                    const srcEncoded = ctx.canvas.toDataURL(e.target, 'image/jpeg');
                    scaleImage.push(srcEncoded);
                })
            })

            fileReader.readAsDataURL(file);
        })
    }
}

function setPreviousUrl() {
    localStorage.setItem('previousUrl', window.location.pathname);
    return true;
}

writeCommentBtn !== null && writeCommentBtn.addEventListener('click', () => {
    writeCommentArea.classList.contains('d-none') ? writeCommentArea.classList.remove('d-none') : writeCommentArea.classList.add('d-none');
});

function calcRating(r, areaRating, id = null) {
    const f = Math.floor(r * 2);
    let ratingStarList;
    console.log(f);
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

function openReplyArea(e) {
    //e.preventDefault();
    const replyArea = document.querySelector(`.replyArea-${e.target.dataset.id}`);
    replyArea.classList.contains('d-none') ? replyArea.classList.remove('d-none')
        : replyArea.classList.add('d-none'); document.querySelector(`.replyArea-${e.target.dataset.id} > textarea`).value = '';
    document.querySelector(`.replyContent-err-${e.target.dataset.id}`).innerHTML = '';
}

async function handlingSendReply(e) {
    const replyContent = document.querySelector(`.replyContent-${e.target.dataset.id}`);
    const errArea = document.querySelector(`.replyContent-err-${e.target.dataset.id}`);
    if (replyContent.value === '') {
        errArea.innerHTML = '<p class="text-danger">Vui lòng nhập nội dung này!</p>';
        return;
    }
    if (countWord(replyContent.value) > 1450) {
        errArea.innerHTML = '<p class="text-danger">Nội dung không được quá 1500 từ!</p>';
        return;
    }

    const formData = new FormData();
    formData.append('id_comment', e.target.dataset.id);
    formData.append('content', replyContent.value);

    for (let i of formData) {
        console.log(i)
    }

    const data = await fetch('/api/comments/reply', {
        method: 'POST',
        credentials: 'same-origin',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(res => res.json()).then(dataJson => dataJson);

    errArea.innerHTML = `<p class="text-success">${data}</p>`;
}

async function viewMoreReplyComment(id) {
    const offset = document.querySelectorAll(`.allReplyCommentArea-${id} > div`).length;
    const allReplyCommentArea = document.querySelector(`.allReplyCommentArea-${id}`);
    const data = await fetch(`/api/comments/reply?id_comment=${id}&offset=${offset}`, {
        method: 'GET',
        credentials: 'same-origin',
    }).then(res => res.json()).then(dataJson => dataJson);

    const replyBtn = document.querySelector(`.viewMoreReplyCommentBtn-${id}`);
    replyBtn.remove();

    data.forEach((item, index) => {
        let htmlContent = '';
        if (index === 5) {
            htmlContent=`
                <div>
                    <button onclick="viewMoreReplyComment(${id})" class="btn btn-success viewMoreReplyCommentBtn-${id}">Xem thêm</button>
                </div>
            `;
        }
        else {
            htmlContent = `
                <div class="mb-3 text-justify d-block">
                    <h4>${item.name}</h4>
                    <p>${item.content}</p>
                </div>
            `;
        }
        const wrapper = document.createElement('div');
        wrapper.innerHTML = htmlContent;
        allReplyCommentArea.appendChild(wrapper);
    })
}


addCommentBtn !== null && addCommentBtn.addEventListener('click', handlingAddNewComment);
commentImageInput !== null && commentImageInput.addEventListener('change', handlingPreviewImage);
window.addEventListener('load', () => {
    calcRating(avgRatingInput.value, 'loadAvg');
    customerRateList !== null && customerRateList.forEach(item => {
        calcRating(item.dataset.star, 'customerRate', item.dataset.id);
    })
});
replyBtnList.forEach(replyBtn => {
    replyBtn.addEventListener('click', openReplyArea)
})
replyCloseBtnList.forEach(replyCloseBtn => {
    replyCloseBtn.addEventListener('click', openReplyArea)
})
sendReplyBtnList.forEach(sendReplyBtn => {
    sendReplyBtn.addEventListener('click', handlingSendReply);
})