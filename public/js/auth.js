/**
 * Tự động điền tài khoản demo trên trang đăng nhập
 * @param {string} email
 * @param {string} pwd
 */
function fillAccount(email, pwd) {
    const emailInput = document.getElementById('email');
    const pwdInput = document.getElementById('password');
    if (emailInput) emailInput.value = email;
    if (pwdInput) pwdInput.value = pwd;
}
