<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Unit Produk - AIMpro Care</title>
</head>

<body>
    <h1>Tambah Unit Produk</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="<?= site_url('qc/product-units') ?>">
        <?= csrf_field() ?>

        <div>
            <label for="product_id">Produk</label>
            <select id="product_id" name="product_id" required>
                <option value="">-- Pilih Produk --</option>

                <?php foreach ($products as $product): ?>
                    <option
                        value="<?= esc($product['id']) ?>"
                        <?= old('product_id') == $product['id'] ? 'selected' : '' ?>>
                        <?= esc($product['name']) ?>
                        - <?= esc($product['brand']) ?>
                        - <?= esc($product['model']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="serial_number">Nomor Serial</label>
            <input
                type="text"
                id="serial_number"
                name="serial_number"
                value="<?= old('serial_number') ?>"
                maxlength="100"
                required>
        </div>

        <div>
            <button type="submit">Simpan Unit</button>
            <a href="<?= site_url('qc/product-units') ?>">Batal</a>
        </div>
    </form>
</body>

</html>