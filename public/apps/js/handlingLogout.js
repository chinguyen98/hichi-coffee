function logout(e) {
    event.preventDefault();
    localStorage.removeItem('previousUrl');
    document.getElementById('logout-form').submit();
}