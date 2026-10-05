document.addEventListener('DOMContentLoaded', function () {
    const openButton = document.getElementById('open-qr-scanner');
    const closeButton = document.getElementById('close-qr-scanner');
    const modal = document.getElementById('qr-scanner-modal');
    const readerElement = document.getElementById('qr-reader');
    const statusElement = document.getElementById('qr-scanner-status');

    if (
        !openButton ||
        !closeButton ||
        !modal ||
        !readerElement ||
        !statusElement
    ) {
        return;
    }

    let qrScanner = null;
    let scannerRunning = false;
    let scanHandled = false;

    function setStatus(message) {
        statusElement.textContent = message;
    }

    function getWarrantyUrl(decodedText) {
        let scannedUrl;

        try {
            scannedUrl = new URL(decodedText);
        } catch (error) {
            return null;
        }

        if (scannedUrl.origin !== window.location.origin) {
            return null;
        }

        const expectedPath = /^\/cek-garansi\/([a-f0-9]{64})$/i;
        const match = scannedUrl.pathname.match(expectedPath);

        if (!match) {
            return null;
        }

        return `${window.location.origin}/cek-garansi/${match[1]}`;
    }

    async function stopScanner() {
        if (!qrScanner || !scannerRunning) {
            return;
        }

        try {
            await qrScanner.stop();
        } catch (error) {
            console.warn('QR scanner stop failed:', error);
        }

        scannerRunning = false;
    }

    async function clearScanner() {
        if (!qrScanner) {
            return;
        }

        try {
            qrScanner.clear();
        } catch (error) {
            console.warn('QR scanner clear failed:', error);
        }

        qrScanner = null;
    }

    async function closeScanner() {
        await stopScanner();
        await clearScanner();

        modal.hidden = true;
        document.body.classList.remove('qr-scanner-open');

        scanHandled = false;
        setStatus(
            'Arahkan kamera ke QR Code pada kartu garansi.'
        );
    }

    async function handleScan(decodedText) {
        if (scanHandled) {
            return;
        }

        const warrantyUrl = getWarrantyUrl(decodedText);

        if (!warrantyUrl) {
            setStatus(
                'QR Code tidak dikenali. Gunakan QR Code kartu garansi AIMPro.'
            );
            return;
        }

        scanHandled = true;
        setStatus('QR Code berhasil dibaca. Membuka data garansi...');

        await stopScanner();

        window.location.href = warrantyUrl;
    }

    async function startScanner() {
        if (scannerRunning) {
            return;
        }

        setStatus('Mendeteksi kamera...');

        try {
            const cameras = await Html5Qrcode.getCameras();

            if (!cameras || cameras.length === 0) {
                setStatus(
                    'Kamera tidak ditemukan pada perangkat ini.'
                );

                return;
            }

            qrScanner = new Html5Qrcode('qr-reader');

            const backCamera = cameras.find(function (camera) {
                return /back|rear|environment/i.test(
                    camera.label
                );
            });

            const cameraId = backCamera
                ? backCamera.id
                : cameras[0].id;

            setStatus('Memulai kamera...');

            await qrScanner.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    },
                    aspectRatio: 1
                },
                handleScan,
                function () {
                    // Ignore normal frame-by-frame scan failures.
                }
            );

            scannerRunning = true;

            setStatus(
                'Arahkan kamera ke QR Code pada kartu garansi.'
            );
        } catch (error) {
            scannerRunning = false;

            console.error(
                'QR scanner start failed:',
                error
            );

            setStatus(
                'Kamera tidak dapat digunakan. Periksa izin kamera browser dan koneksi halaman.'
            );
        }
    }

    openButton.addEventListener('click', async function () {
        modal.hidden = false;
        document.body.classList.add('qr-scanner-open');

        scanHandled = false;

        await startScanner();
    });

    closeButton.addEventListener('click', closeScanner);

    modal.addEventListener('click', function (event) {
        if (event.target.closest('[data-qr-close]')) {
            closeScanner();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !modal.hidden) {
            closeScanner();
        }
    });

    window.addEventListener('beforeunload', function () {
        if (qrScanner && scannerRunning) {
            qrScanner.stop().catch(function () {});
        }
    });
});