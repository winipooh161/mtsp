document.addEventListener('DOMContentLoaded', function() {
    const tgInput = document.querySelector('.maskTg');
    tgInput.addEventListener('input', function() {
        // Ensure the input starts with '@'
        if (!tgInput.value.startsWith('@')) {
            tgInput.value = '@' + tgInput.value.replace(/@+/g, '');
        }
        // Remove any non-allowed characters
        tgInput.value = tgInput.value.replace(/[^@a-zA-Z0-9_]/g, '');
    });
    tgInput.addEventListener('blur', function() {
        // If the input is just '@', clear it
        if (tgInput.value === '@') {
            tgInput.value = '';
        }
    });
});