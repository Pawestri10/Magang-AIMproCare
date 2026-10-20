
let installPrompt = null;
let installButton = null;

function createInstallButton() {
    if (installButton) return;

    installButton = document.createElement('button');
    installButton.type = 'button';
    installButton.textContent = 'Install AIMpro Care';
    installButton.setAttribute('aria-label', 'Install AIMpro Care');

    Object.assign(installButton.style, {
        position: 'fixed',
        right: '24px',
        bottom: '24px',
        zIndex: '9999',
        padding: '12px 18px',
        border: '1px solid #C7CBD1',
        borderRadius: '14px',
        background: 'linear-gradient(135deg, #F5F5F5, #C7CBD1)',
        color: '#08090B',
        fontFamily: 'Poppins, sans-serif',
        fontSize: '13px',
        fontWeight: '600',
        cursor: 'pointer',
        boxShadow: '0 8px 24px rgba(0,0,0,.25)',
        display: 'none'
    });

    installButton.addEventListener('click', async () => {
        if (!installPrompt) return;

        installButton.disabled = true;
        installPrompt.prompt();

        await installPrompt.userChoice;

        installPrompt = null;
        installButton.disabled = false;
        installButton.style.display = 'none';
    });

    document.body.appendChild(installButton);
}

window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    installPrompt = event;

    createInstallButton();
    installButton.style.display = 'block';
});

window.addEventListener('appinstalled', () => {
    installPrompt = null;

    if (installButton) {
        installButton.style.display = 'none';
    }
});
