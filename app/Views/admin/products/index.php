<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - AIMpro Care</title>
</head>

<body>

    <h1>Master Data Produk</h1>

    <a href="<?= site_url('admin/products/create') ?>">
        Tambah Produk
    </a>

    <?php if (empty($products)): ?>
        <p>Belum ada data produk.</p>
    <?php else: ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $index => $product): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($product['name']) ?></td>
                        <td><?= esc($product['brand']) ?></td>
                        <td><?= esc($product['model']) ?></td>
                        <td><?= esc($product['created_at']) ?></td>

                        <td>
                            <a href="<?= site_url('admin/products/' . $product['id'] . '/edit') ?>">
                                Edit
                            </a>

                            <form
                                method="post"
                                action="<?= site_url('admin/products/' . $product['id'] . '/delete') ?>"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                <?= csrf_field() ?>

                                <button type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

</body>

</html>