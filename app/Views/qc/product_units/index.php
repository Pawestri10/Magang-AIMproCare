<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Produk - AIMpro Care</title>
</head>

<body>
    <h1>Unit Produk & Nomor Serial</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

    <p>
        <a href="<?= site_url('qc/product-units/create') ?>">
            Tambah Unit
        </a>
    </p>

    <?php if (empty($units)): ?>

        <p>Belum ada unit produk.</p>

    <?php else: ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Nomor Serial</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($units as $index => $unit): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($unit['product_name']) ?></td>
                        <td><?= esc($unit['brand']) ?></td>
                        <td><?= esc($unit['model']) ?></td>
                        <td><?= esc($unit['serial_number']) ?></td>
                        <td><?= esc($unit['status']) ?></td>
                        <td><?= esc($unit['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</body>

</html>