<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - AIMpro Care</title>
</head>

<body>

    <h1>Tambah Produk</h1>

    <form method="post" action="<?= site_url('admin/products') ?>">
        <?= csrf_field() ?>

        <div>
            <label for="name">Nama Produk</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?= old('name') ?>"
                maxlength="150"
                required>
        </div>

        <div>
            <label for="brand">Brand</label>
            <input
                type="text"
                id="brand"
                name="brand"
                value="<?= old('brand') ?>"
                maxlength="100"
                required>
        </div>

        <div>
            <label for="model">Model</label>
            <input
                type="text"
                id="model"
                name="model"
                value="<?= old('model') ?>"
                maxlength="100"
                required>
        </div>

        <div>
            <button type="submit">Simpan Produk</button>
            <a href="<?= site_url('admin/products') ?>">Batal</a>
        </div>
    </form>

</body>

</html>