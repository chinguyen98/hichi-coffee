const writeCommentBtn = document.querySelector('.writeCommentBtn');
const writeCommentArea = document.querySelector('.writeCommentArea');
const ratingStarList = [...document.querySelectorAll('#rating input[type="radio"]')];
const addCommentBtn = document.querySelector('.addCommentBtn');
const commentTitleInput = document.querySelector('input[name="commentTitle"]');
const commentContentInput = document.querySelector('textarea[name="commentContent"]');
const commentImageInput = document.querySelector('input[name="commentImage"]');
const commentCoffeeIdInput = document.querySelector('input[name="commentCoffeeId"]');
const ratingErrArea = document.querySelector('.rating-err');
const contentErrArea = document.querySelector('.commentContent-err');
const imagesErrArea = document.querySelector('.commentImage-err');
const previewImageArea = document.querySelector('.previewImageArea');
let scaleImage = [];

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

    for (let i of formData) {
        console.log(i)
    }

    const data = await fetch('/api/comments', {
        method: 'POST',
        credentials: 'same-origin',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(res => res.json()).then(dataJson => dataJson);

    console.log(data);
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

// ratingStarList.forEach(ratingStarItem => {
//     ratingStarItem.addEventListener('click', (e) => { alert(e.target.value) });
// });

addCommentBtn !== null && addCommentBtn.addEventListener('click', handlingAddNewComment);
commentImageInput !== null && commentImageInput.addEventListener('change', handlingPreviewImage);