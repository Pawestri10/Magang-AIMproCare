<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'AIMpro Care') ?></title>

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

    <?= $this->renderSection('styles') ?>

</head>

<body>

    <div class="app-shell">

        <?= $this->include('components/sidebar') ?>

        <div class="app-main">

            <?= $this->include('components/topbar') ?>

            <main class="app-content">

                <?= $this->renderSection('content') ?>

            </main>

        </div>

    </div>

    <?= $this->include('components/mobile-nav') ?>

    <script src="<?= base_url('assets/js/components/modal.js') ?>"></script>
    <script src="<?= base_url('assets/js/pages/product-units.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>