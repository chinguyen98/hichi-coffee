const previewImg = document.querySelector('#previewImg');
const fileImg = document.querySelector('input[name="image"]');

function changePreviewImage(e) {
    let file = e.srcElement.files[0];//or fileImg.files[0]
    if (file.type.match("image.*")) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            var fileContent = reader.result;
            previewImg.src = fileContent;
        }
    } else {
        alert("Vui lòng upload file hình ảnh!!!");
        fileImg.value="";
    }
}

fileImg.addEventListener('change', changePreviewImage);