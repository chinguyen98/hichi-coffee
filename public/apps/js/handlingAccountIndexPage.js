const changePasswordFormArea = document.querySelector('.changePasswordForm');
const showChangePasswordFormCheckbox = document.querySelector('input[name="showChangePasswordForm"]');

function displayChangePassword() {
    showChangePasswordFormCheckbox.checked === true ? changePasswordFormArea.classList.remove('d-none') : changePasswordFormArea.classList.add('d-none');
}

showChangePasswordFormCheckbox.addEventListener('change', (e) => {
    displayChangePassword();
});

window.addEventListener('load', () => {
    displayChangePassword();
});