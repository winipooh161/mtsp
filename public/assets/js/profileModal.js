document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const avatarInput = document.querySelector('#avatar');
    const avatarPreview = document.querySelector('#avatar-preview img');
    const submitButton = document.querySelector('button[type="submit"]');
    const successMessageContainer = document.createElement('div');
    const modalProfile = document.getElementById('profileModal');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    
    successMessageContainer.classList.add('alert', 'alert-success');
    successMessageContainer.style.display = 'none';  // Initially hidden
    form.insertBefore(successMessageContainer, form.firstChild);  // Add success message above form

    form.addEventListener('submit', function(e) {
        e.preventDefault();  // Prevent traditional form submission

        const formData = new FormData(form);
        submitButton.disabled = true;

        axios.post(form.action, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => {
            document.querySelectorAll('.invalid-feedback').forEach(element => element.textContent = '');
            document.querySelectorAll('.is-invalid').forEach(input => input.classList.remove('is-invalid'));

            successMessageContainer.textContent = response.data.success;
            successMessageContainer.style.display = 'block';
            submitButton.disabled = false;
        })
        .catch(error => {
            submitButton.disabled = false;
            document.querySelectorAll('.invalid-feedback').forEach(element => element.textContent = '');
            document.querySelectorAll('.is-invalid').forEach(input => input.classList.remove('is-invalid'));

            if (error.response && error.response.data.errors) {
                const errors = error.response.data.errors;
                Object.keys(errors).forEach(function(key) {
                    const errorMessage = errors[key][0];
                    const inputField = document.querySelector(`[name="${key}"]`);
                    if (inputField) {
                        const errorElement = inputField.closest('label').querySelector('.invalid-feedback');
                        if (errorElement) {
                            errorElement.textContent = errorMessage;
                            inputField.classList.add('is-invalid');
                        }
                    }
                });
            }
        });
    });

    // Avatar preview
    avatarInput.addEventListener('change', function() {
        const file = avatarInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Telegram input mask
    const tgInput = document.querySelector('.maskTg');
    tgInput.addEventListener('input', function() {
        if (!tgInput.value.startsWith('@')) {
            tgInput.value = '@' + tgInput.value.replace(/@+/g, '');
        }
        tgInput.value = tgInput.value.replace(/[^@a-zA-Z0-9_]/g, '');
    });

    tgInput.addEventListener('blur', function() {
        if (tgInput.value === '@') {
            tgInput.value = '';
        }
    });

    // Function to open modal
    function openModal(modal) {
        modal.style.display = 'block';
    }

    // Function to close modal
    function closeModal(modal) {
        modal.style.display = 'none';
    }

    // Close modal on clicking close buttons
    closeModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            closeModal(modalProfile);
        });
    });

    // Check URL for modal parameter
    const urlParams = new URLSearchParams(window.location.search);
    const modalName = urlParams.get('modal');

    if (modalName === 'profileModal') {
        openModal(modalProfile);
    }

});
