document.getElementById('avatar').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const maxFileSize = 4.9 * 1024 * 1024; // 4.9 MB в байтах
    const errorElement = document.getElementById('avatar-error');
    if (file) {
        // Проверка размера файла
        if (file.size > maxFileSize) {
            errorElement.textContent = "Файл слишком большой! Пожалуйста, выберите файл меньше 4.9 MB.";
            errorElement.style.display = "block";
            event.target.value = ''; // Очистить поле загрузки файла
            document.getElementById('avatar-preview').style.backgroundImage = ''; // Очистить предпросмотр
            return;
        } else {
            // Убираем сообщение об ошибке, если файл подходит по размеру
            errorElement.style.display = "none";
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').style.backgroundImage = 'url(' + e.target.result + ')';
        }
        reader.readAsDataURL(file);
    }
});