/* MODALS */

/* Modal Controller */

document.addEventListener('DOMContentLoaded', () => {

    const modalOpenButtons = document.querySelectorAll('[data-modal-open]');

    const deleteModalOpenButtons = document.querySelectorAll('[data-delete-modal-open]');

    const modalCloseButtons = document.querySelectorAll('[data-modal-close]');

    const deleteConfirmButtons = document.querySelectorAll('[data-delete-confirm]');


    function openModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.add('is-open');

        document.body.classList.add('modal-open');

    }


    function closeModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.remove('is-open');

        document.body.classList.remove('modal-open');

    }


    modalOpenButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const modalId = button.dataset.modalOpen;

            const modal = document.getElementById(modalId);

            openModal(modal);

        });

    });

    deleteModalOpenButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const modalId = button.dataset.deleteModalOpen;

            const modal = document.getElementById(modalId);

            openModal(modal);

        });

    });

    modalCloseButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const modal = button.closest('.modal');

            closeModal(modal);

        });

    });

    deleteConfirmButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const formId = button.dataset.deleteConfirm;

            const form = document.getElementById(formId);

            if (!form) {
                return;
            }

            form.submit();

        });

    });

    document.addEventListener('keydown', (event) => {

        if (event.key !== 'Escape') {
            return;
        }

        const openModalElement = document.querySelector('.modal.is-open');

        closeModal(openModalElement);

    });

});