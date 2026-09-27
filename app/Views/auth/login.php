<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AIMpro Care</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/main.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/pages/login.css') ?>">
</head>

<body>

    <main class="login-page">

        <div class="login-wrapper">

            <div class="login-brand">

                <div class="login-brand-name">
                    AIMpro Care
                </div>

                <p class="login-brand-subtitle">
                    Warranty & After-Sales System
                </p>

            </div>


            <section class="login-card">

                <div class="login-heading">

                    <h1>
                        Selamat Datang, <?= esc($role) ?>
                    </h1>

                    <p>
                        Silakan login untuk melanjutkan.
                    </p>

                </div>

                <?php if (session()->getFlashdata('error')): ?>

                    <div
                        class="login-alert"
                        role="alert">

                        <?= esc(session()->getFlashdata('error')) ?>

                    </div>

                <?php endif; ?>


                <form
                    method="post"
                    class="login-form">

                    <?= csrf_field() ?>


                    <div class="login-form-group">

                        <label
                            for="email"
                            class="login-form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="login-form-input"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            required>

                    </div>


                    <div class="login-form-group">

                        <label
                            for="password"
                            class="login-form-label">

                            Password

                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="login-form-input"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required>

                    </div>


                    <button
                        type="submit"
                        class="login-submit">

                        Login

                    </button>

                </form>

            </section>

        </div>

    </main>

</body>

</html>