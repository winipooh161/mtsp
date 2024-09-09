document.addEventListener('DOMContentLoaded', function() {

    // Маска для ввода даты (ДД/ММ/ГГГГ)
    function applyDateMask(field) {
        field.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Удаляем все, кроме цифр
            if (value.length >= 3) {
                value = value.slice(0, 2) + '/' + value.slice(2); // Добавляем первый слэш
            }
            if (value.length >= 6) {
                value = value.slice(0, 5) + '/' + value.slice(5); // Добавляем второй слэш
            }
            this.value = value.slice(0, 10); // Ограничиваем до 10 символов
        });
    }

    // Маска для ввода Discord (@имя)
    function applyDiscordMask(field) {
        field.addEventListener('input', function(e) {
            let value = this.value;
            if (!value.startsWith('@')) {
                value = '@' + value.replace(/^@+/, ''); // Убедимся, что начинается с @
            }
            this.value = value.slice(0, 30); // Ограничиваем длину строки
        });
    }

    // Маска для ввода Telegram (@имя)
    function applyTelegramMask(field) {
        field.addEventListener('input', function(e) {
            let value = this.value;
            if (!value.startsWith('@')) {
                value = '@' + value.replace(/^@+/, ''); // Убедимся, что начинается с @
            }
            this.value = value.slice(0, 30); // Ограничиваем длину строки
        });
    }

    // Функция для сохранения значений в localStorage
    function saveToLocalStorage(field) {
        const name = field.getAttribute('name');
        if (name) {
            localStorage.setItem(name, field.value);
        }
    }

    // Функция для загрузки значений из localStorage
    function loadFromLocalStorage(field) {
        const name = field.getAttribute('name');
        if (name && localStorage.getItem(name)) {
            field.value = localStorage.getItem(name);
        }
    }

    // Применение масок ко всем существующим полям
    const dateFields = document.querySelectorAll('.date-mask');
    dateFields.forEach(field => {
        applyDateMask(field);
        loadFromLocalStorage(field);
        field.addEventListener('input', () => saveToLocalStorage(field));
    });

    const discordFields = document.querySelectorAll('input[name*="discord"]');
    discordFields.forEach(field => {
        applyDiscordMask(field);
        loadFromLocalStorage(field);
        field.addEventListener('input', () => saveToLocalStorage(field));
    });

    const telegramFields = document.querySelectorAll('input[name*="telegram"]');
    telegramFields.forEach(field => {
        applyTelegramMask(field);
        loadFromLocalStorage(field);
        field.addEventListener('input', () => saveToLocalStorage(field));
    });

    const inputFields = document.querySelectorAll('input, select');
    inputFields.forEach(field => {
        loadFromLocalStorage(field);
        field.addEventListener('input', () => saveToLocalStorage(field));
        field.addEventListener('change', () => saveToLocalStorage(field));
    });

    // Наблюдаем за изменениями в DOM для динамических полей
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Только если это элемент
                    if (node.matches('.date-mask')) {
                        applyDateMask(node);
                        loadFromLocalStorage(node);
                        node.addEventListener('input', () => saveToLocalStorage(
                            node));
                    }
                    if (node.matches('input[name*="discord"]')) {
                        applyDiscordMask(node);
                        loadFromLocalStorage(node);
                        node.addEventListener('input', () => saveToLocalStorage(
                            node));
                    }
                    if (node.matches('input[name*="telegram"]')) {
                        applyTelegramMask(node);
                        loadFromLocalStorage(node);
                        node.addEventListener('input', () => saveToLocalStorage(
                            node));
                    }
                }
            });
        });
    });

    // Наблюдаем за изменениями в DOM
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});