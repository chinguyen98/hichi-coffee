const writeCommentBtn = document.querySelector('.writeCommentBtn');
const writeCommentArea = document.querySelector('.writeCommentArea');
const ratingStarList = [...document.querySelectorAll('#rating input[type="radio"]')];
const addCommentBtn = document.querySelector('.addCommentBtn');
const commentTitleInput = document.querySelector('input[name="commentTitle"]');
const commentContentInput = document.querySelector('textarea[name="commentContent"]');
const commentImageInput = document.querySelector('input[name="commentImage"]');
const ratingErrArea = document.querySelector('.rating-err');
const contentErrArea = document.querySelector('.commentContent-err');
const imagesErrArea = document.querySelector('.commentImage-err');
const previewImageArea = document.querySelector('.previewImageArea');

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

function handlingAddNewComment() {
    const rating = document.querySelector('#rating input[type="radio"]:checked')?.value;
    const title = commentTitleInput.value;
    const content = commentContentInput.value;
    const images = Object.values(commentImageInput.files);
    if (!validateForm(rating, content)) {
        return;
    }

    const formData = new FormData();
    formData.append('rating', rating);
    formData.append('title', title);
    formData.append('content', content);
    images.forEach(image => {
        formData.append('image[]', image);
    });

    for (let i of formData) {
        console.log(i)
    }
}

function handlingPreviewImage() {
    imagesErrArea.innerHTML = '';
    previewImageArea.innerHTML = '';

    if (this.files) {
        if (this.files.length > 5) {
            imagesErrArea.innerHTML = 'Vui lòng upload tối đa 5 hình ảnh!';
            commentImageInput.value = '';
            return;
        }

        [...this.files].forEach(file => {
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
            })

            fileReader.readAsDataURL(file);
        })
    }
}

writeCommentBtn.addEventListener('click', () => {
    writeCommentArea.classList.contains('d-none') ? writeCommentArea.classList.remove('d-none') : writeCommentArea.classList.add('d-none');
});

// ratingStarList.forEach(ratingStarItem => {
//     ratingStarItem.addEventListener('click', (e) => { alert(e.target.value) });
// });

addCommentBtn.addEventListener('click', handlingAddNewComment);
commentImageInput.addEventListener('change', handlingPreviewImage);