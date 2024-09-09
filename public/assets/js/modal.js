document.addEventListener('DOMContentLoaded', function() {
    // Функция для открытия модального окна
    const openModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
        }
    };

    // Функция для закрытия модального окна
    const closeModal = (modal) => {
        modal.style.display = 'none';
    };

    // Найти все кнопки с классом 'open-modal-btn'
    const openModalButtons = document.querySelectorAll('.open-modal-btn');

    // Добавить обработчик события для открытия модального окна
    openModalButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const modalId = this.getAttribute('data-modal');
            openModal(modalId);
        });
    });

    // Закрытие модальных окон по нажатию на элементы с классом 'close-modal'
    const closeModalButtons = document.querySelectorAll('.close-modal');

    closeModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            closeModal(modal);
        });
    });

    // Закрытие по клику вне модального окна
    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });
    });
});