document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    const passwordFieldType = passwordField.getAttribute('type');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');

    if (passwordFieldType === 'password') {
        passwordField.setAttribute('type', 'text');
        eyeOpen.style.display = 'none';
        eyeClosed.style.display = 'block';
    } else {
        passwordField.setAttribute('type', 'password');
        eyeOpen.style.display = 'block';
        eyeClosed.style.display = 'none';
    }
});

document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
    const confirmPasswordField = document.getElementById('password-confirm');
    const confirmPasswordFieldType = confirmPasswordField.getAttribute('type');
    const eyeOpenConfirm = document.getElementById('eye-open-confirm');
    const eyeClosedConfirm = document.getElementById('eye-closed-confirm');

    if (confirmPasswordFieldType === 'password') {
        confirmPasswordField.setAttribute('type', 'text');
        eyeOpenConfirm.style.display = 'none';
        eyeClosedConfirm.style.display = 'block';
    } else {
        confirmPasswordField.setAttribute('type', 'password');
        eyeOpenConfirm.style.display = 'block';
        eyeClosedConfirm.style.display = 'none';
    }
});