<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Cek Garansi') ?> — AIMPro Technology</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/main.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/pages/public-warranty.css') ?>">
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/pages/public-claim.css') ?>">
</head>

<body class="public-page">
    <main class="public-main">
        <?= $this->renderSection('content') ?>
    </main>

    <script
        src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"
        type="text/javascript"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>