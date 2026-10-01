/* MODALS */

/* Modal Controller */

document.addEventListener('DOMContentLoaded', () => {

    const modalOpenButtons = document.querySelectorAll('[data-modal-open]');

    const deleteModalOpenButtons = document.querySelectorAll('[data-delete-modal-open]');

    const modalCloseButtons = document.querySelectorAll('[data-modal-close]');

    const deleteConfirmButtons = document.querySelectorAll('[data-delete-confirm]');

    const modalNextButtons = document.querySelectorAll('[data-modal-next]');

    const salesNextButtons = document.querySelectorAll('[data-sales-next]');
    
    const modalBackButtons = document.querySelectorAll('[data-modal-back]');


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

    modalNextButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const currentModal = button.closest('.modal');
            const nextModalId = button.dataset.modalNext;
            const nextModal = document.getElementById(nextModalId);

            closeModal(currentModal);
            openModal(nextModal);

        });

    });

    salesNextButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const currentModal = button.closest('.modal');
            const nextModalId = button.dataset.salesNext;
            const nextModal = document.getElementById(nextModalId);

            if (!nextModal) {
                return;
            }

            closeModal(currentModal);
            openModal(nextModal);

        });

    });

    modalBackButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const currentModal = button.closest('.modal');

            closeModal(currentModal);

        });

    });

    const customerSelects = document.querySelectorAll('[data-customer-select]');

    customerSelects.forEach((select) => {

        select.addEventListener('change', () => {

            const unitId = select.dataset.customerSelect;

            const option = select.options[select.selectedIndex];

            const summary = document.getElementById(
                `sales-customer-summary-${unitId}`
            );

            const name = document.getElementById(
                `sales-customer-name-${unitId}`
            );

            const whatsapp = document.getElementById(
                `sales-customer-whatsapp-${unitId}`
            );

            const email = document.getElementById(
                `sales-customer-email-${unitId}`
            );

            const address = document.getElementById(
                `sales-customer-address-${unitId}`
            );

            const nextButton = document.querySelector(
                `[data-sales-customer-next][data-customer-unit="${unitId}"]`
            );

            const transactionCustomer = document.getElementById(
                `sales-transaction-customer-${unitId}`
            );

            if (!option.value) {

                summary.hidden = true;

                name.value = '';
                whatsapp.value = '';
                email.value = '';
                address.value = '';

                if (transactionCustomer) {
                    transactionCustomer.value = '';
                }

                if (nextButton) {
                    nextButton.disabled = true;
                }

                return;
            }

            name.value = option.dataset.name || '';
            whatsapp.value = option.dataset.whatsapp || '';
            email.value = option.dataset.email || '';
            address.value = option.dataset.address || '';

            if (transactionCustomer) {
                transactionCustomer.value = option.value;
            }

            summary.hidden = false;

            if (nextButton) {
                nextButton.disabled = false;
            }

        });

    });

    const salesCustomerNextButtons = document.querySelectorAll(
        '[data-sales-customer-next]'
    );

    salesCustomerNextButtons.forEach((button) => {

        button.addEventListener('click', () => {

            if (button.disabled) {
                return;
            }

            const currentModal = button.closest('.modal');

            const nextModalId = button.dataset.salesNext;

            const nextModal = document.getElementById(nextModalId);

            if (!nextModal) {
                return;
            }

            closeModal(currentModal);
            openModal(nextModal);

        });

    });

    const salesTransactionBackButtons = document.querySelectorAll(
        '[data-sales-transaction-back]'
    );

    salesTransactionBackButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const currentModal = button.closest('.modal');

            const previousModalId = button.dataset.salesBack;

            const previousModal = document.getElementById(previousModalId);

            if (!previousModal) {
                return;
            }

            closeModal(currentModal);
            openModal(previousModal);

        });

    });

    const salesCustomerBackButtons = document.querySelectorAll(
        '[data-sales-customer-back]'
    );

    salesCustomerBackButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const currentModal = button.closest('.modal');

            const previousModalId = button.dataset.customerBack;

            const previousModal = document.getElementById(previousModalId);

            if (!previousModal) {
                return;
            }

            closeModal(currentModal);
            openModal(previousModal);

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