const chatboxIcon = document.querySelector('.chatbox-icon');
const chatboxDialog = document.querySelector('.chatbox-dialog');
const chatboxWave = document.querySelector('.chatbox-wave');

function openChatboxDialog() {
    chatboxDialog.classList.remove('d-none')
    chatboxIcon.classList.add('d-none');
    chatboxWave.classList.add('d-none');
}

chatboxIcon.addEventListener('click', openChatboxDialog);