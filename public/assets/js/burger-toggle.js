document.addEventListener('DOMContentLoaded', function() {
    var burgerToggle = document.getElementById('burger-toggle');
    var burger = document.querySelector('.burger');
    var burgerLinks = document.querySelector('.burger .links');

    // Добавляем обработчик клика на всё окно документа 
    document.addEventListener('click', function(event) {
        // Проверяем, что клик произошел не по бургеру и его дочерним элементам
        if (!burger.contains(event.target) && event.target !== burger) {
            // Клик произошел вне бургера, активируем input
            burgerToggle.checked = false; // Меняем состояние на false (не отмечен)
        }
    });

    // Для предотвращения закрытия при клике на сам бургер и его дочерние элементы
    burger.addEventListener('click', function(event) {
        event.stopPropagation(); // Предотвращаем всплытие события клика
    });

    burgerLinks.addEventListener('click', function(event) {
        event.stopPropagation(); // Предотвращаем всплытие события клика
    });
});