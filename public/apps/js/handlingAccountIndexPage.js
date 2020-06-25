const changePasswordFormArea = document.querySelector('.changePasswordForm');
const showChangePasswordFormCheckbox = document.querySelector('input[name="showChangePasswordForm"]');

showChangePasswordFormCheckbox.addEventListener('change', () => {
    changePasswordFormArea.classList.contains('d-none') ? changePasswordFormArea.classList.remove('d-none') : changePasswordFormArea.classList.add('d-none');
});