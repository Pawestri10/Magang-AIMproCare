<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'AIMpro Care') ?></title>

    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#08090B">
    <meta name="application-name" content="AIMpro Technology">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/topbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/mobile-nav.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/tables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/buttons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/modal.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/forms.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/badges.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/product-units.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/sales.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/activity-logs.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/alerts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/warranty-card.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/reports.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/search.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/pagination.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/notification-settings.css') ?>">

    <?= $this->renderSection('styles') ?>

</head>

<body>

    <div class=" app-shell">

        <?= $this->include('components/sidebar') ?>

        <div class="app-main">

            <?= $this->include('components/topbar') ?>

            <main class="app-content">

                <?= $this->include('components/alert') ?>

                <?= $this->renderSection('content') ?>

            </main>

        </div>

    </div>

    <?= $this->include('components/mobile-nav') ?>

    <script src="<?= base_url('assets/js/components/modal.js') ?>"></script>

    <script>
        document.querySelectorAll('.alert').forEach((alert) => {
            setTimeout(() => {
                alert.classList.add('is-hiding');

                setTimeout(() => {
                    alert.remove();
                }, 250);
            }, 5000);
        });
    </script>

    <script src="<?= base_url('assets/js/pages/product-units.js') ?>"></script>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register(
                    '<?= base_url('sw.js') ?>'
                ).catch((error) => {
                    console.error('Pendaftaran Service Worker gagal:', error);
                });
            });
        }
    </script>

    <script src="<?= base_url('assets/js/pwa.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>