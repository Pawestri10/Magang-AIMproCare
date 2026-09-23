<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AIMpro Care</title>
</head>

<body>

    <h1>Login AIMpro Care</h1>

    <h2>Login sebagai <?= esc($role) ?></h2>

    <?php if (session()->getFlashdata('error')): ?>
        <p><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

    <form method="post">
        <?= csrf_field() ?>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

</body>

</html>