/* PRODUCT UNITS */

/* Inspection Multi-Step */

document.addEventListener('DOMContentLoaded', () => {

    const inspectionModals = document.querySelectorAll('.inspection-modal');

    inspectionModals.forEach((modal) => {

        const steps = modal.querySelectorAll('[data-inspection-step]');
        const nextButton = modal.querySelector('[data-inspection-next]');
        const backButton = modal.querySelector('[data-inspection-back]');
        const submitButton = modal.querySelector('[data-inspection-submit]');

        if (!steps.length || !nextButton) {
            return;
        }

        let currentStep = 1;

        function showStep(stepNumber) {

            steps.forEach((step) => {

                const stepValue = Number(step.dataset.inspectionStep);

                step.hidden = stepValue !== stepNumber;

            });

            currentStep = stepNumber;

            if (backButton) {

                if (currentStep === 1) {
                    backButton.setAttribute('hidden', '');
                } else {
                    backButton.removeAttribute('hidden');
                }

            }

            if (currentStep === steps.length) {
                nextButton.setAttribute('hidden', '');

                if (submitButton) {
                    submitButton.removeAttribute('hidden');
                }

            } else {
                nextButton.removeAttribute('hidden');

                if (submitButton) {
                    submitButton.setAttribute('hidden', '');
                }
            }
        }

        nextButton.addEventListener('click', () => {

            if (currentStep >= steps.length) {
                return;
            }

            const currentStepElement = modal.querySelector(
                `[data-inspection-step="${currentStep}"]`
            );

            if (!currentStepElement) {
                return;
            }

            const requiredFields = currentStepElement.querySelectorAll(
                'input[required], select[required], textarea[required]'
            );

            for (const field of requiredFields) {

                if (!field.checkValidity()) {
                    field.reportValidity();
                    return;
                }

            }

            showStep(currentStep + 1);

        });

        if (submitButton) {

            submitButton.addEventListener('click', (event) => {

                const currentStepElement = modal.querySelector(
                    `[data-inspection-step="${currentStep}"]`
                );

                if (!currentStepElement) {
                    return;
                }

                const requiredFields = currentStepElement.querySelectorAll(
                    'input[required], select[required], textarea[required]'
                );

                for (const field of requiredFields) {

                    if (!field.checkValidity()) {
                        field.reportValidity();
                        event.preventDefault();
                        return;
                    }

                }

            });

        }

        if (backButton) {

            backButton.addEventListener('click', () => {

                if (currentStep > 1) {
                    showStep(currentStep - 1);
                }

            });

        }

        showStep(1);

    });

});