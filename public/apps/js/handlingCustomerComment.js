const writeCommentBtn = document.querySelector('.writeCommentBtn');
const writeCommentArea = document.querySelector('.writeCommentArea');
const ratingStarList = [...document.querySelectorAll('#rating input[type="radio"]')];
const addCommentBtn = document.querySelector('.addCommentBtn');
const commentTitleInput = document.querySelector('input[name="commentTitle"]');
const commentContentInput = document.querySelector('textarea[name="commentContent"]');
const commentImageInput = document.querySelector('input[name="commentImage"]');
const ratingErrArea = document.querySelector('.rating-err');
const contentErrArea = document.querySelector('.commentContent-err');
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
    if (!validateForm(rating, content)) {
        return;
    }
}

function handlingPreviewImage(){
    console.log('qwe')
}

writeCommentBtn.addEventListener('click', () => {
    writeCommentArea.classList.contains('d-none') ? writeCommentArea.classList.remove('d-none') : writeCommentArea.classList.add('d-none');
});

ratingStarList.forEach(ratingStarItem => {
    ratingStarItem.addEventListener('click', (e) => { alert(e.target.value) });
});

addCommentBtn.addEventListener('click', handlingAddNewComment);
commentImageInput.addEventListener('change', handlingPreviewImage);