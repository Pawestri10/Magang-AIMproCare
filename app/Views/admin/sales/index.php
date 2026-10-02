<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header sales-page-header">

    <div>

        <h1>
            Penjualan & Aktivasi Garansi
        </h1>

        <p>
            Kelola unit siap dijual dan lihat riwayat penjualan serta aktivasi garansi.
        </p>

    </div>

</div>

<div class="card">

    <div class="section-header">

        <div>

            <h2>
                Unit Siap Dijual
            </h2>

            <p>
                Unit yang telah lolos QC dan belum memiliki transaksi penjualan.
            </p>

        </div>

    </div>


    <?php if (empty($units)): ?>

        <div class="empty-state">

            <p>
                Belum ada unit yang siap dijual.
            </p>

        </div>

    <?php else: ?>

        <div class="table-wrapper">

            <table class="data-table">

                <thead>

                    <tr>

                        <th>
                            No.
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Brand
                        </th>

                        <th>
                            Model
                        </th>

                        <th>
                            Nomor Serial
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($units as $index => $unit): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= esc($unit['product_name']) ?>
                            </td>

                            <td>
                                <?= esc($unit['brand']) ?>
                            </td>

                            <td>
                                <?= esc($unit['model']) ?>
                            </td>

                            <td>
                                <?= esc($unit['serial_number']) ?>
                            </td>

                            <td>

                                <span class="badge badge-success">
                                    <?= esc($unit['status']) ?>
                                </span>

                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        type="button"
                                        class="button button-icon button-icon-view"
                                        data-tooltip="Pilih Unit"
                                        aria-label="Pilih Unit"
                                        data-modal-open="sales-select-modal-<?= esc($unit['id']) ?>">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">

                                            <rect
                                                x="4"
                                                y="4"
                                                width="16"
                                                height="16"
                                                rx="3">
                                            </rect>

                                            <path d="m8 12 2.5 2.5L16 9"></path>

                                        </svg>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>

<div class="card sales-history-card">

    <div class="section-header">

        <div>

            <h2>
                Riwayat Penjualan
            </h2>

            <p>
                Daftar transaksi penjualan dan aktivasi garansi yang telah dilakukan.
            </p>

        </div>

    </div>


    <?php if (empty($sales)): ?>

        <div class="empty-state">

            <p>
                Belum ada riwayat penjualan.
            </p>

        </div>

    <?php else: ?>

        <div class="table-wrapper">

            <table class="data-table">

                <thead>

                    <tr>

                        <th>
                            No.
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Nomor Serial
                        </th>

                        <th>
                            Pembeli
                        </th>

                        <th>
                            Tanggal Pembelian
                        </th>

                        <th>
                            Nomor Garansi
                        </th>

                        <th>
                            Status Garansi
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($sales as $index => $sale): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>

                                <div>
                                    <?= esc($sale['product_name']) ?>
                                </div>

                                <small>
                                    <?= esc($sale['brand']) ?>
                                    —
                                    <?= esc($sale['model']) ?>
                                </small>

                            </td>

                            <td>
                                <?= esc($sale['serial_number']) ?>
                            </td>

                            <td>
                                <?= esc($sale['customer_name']) ?>
                            </td>

                            <td>
                                <?= esc($sale['purchase_date']) ?>
                            </td>

                            <td>
                                <?= esc($sale['warranty_number'] ?? '-') ?>
                            </td>

                            <td>

                                <?php if (($sale['warranty_status'] ?? '') === 'Garansi Aktif'): ?>

                                    <span class="badge badge-success">
                                        <?= esc($sale['warranty_status']) ?>
                                    </span>

                                <?php else: ?>

                                    <span class="badge">
                                        <?= esc($sale['warranty_status'] ?? 'Belum tersedia') ?>
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        type="button"
                                        class="button button-icon button-icon-view"
                                        data-tooltip="Lihat Detail"
                                        aria-label="Lihat Detail"
                                        data-modal-open="sales-detail-modal-<?= esc($sale['id']) ?>">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">

                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="16"
                                                rx="3">
                                            </rect>

                                            <path d="M8 9h8"></path>

                                            <path d="M8 13h5"></path>

                                        </svg>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>


<?php foreach ($units as $unit): ?>

    <?= view('admin/sales/select', [
        'unit' => $unit,
    ]) ?>

    <?= view('admin/sales/customer', [
        'unit' => $unit,
        'customers' => $customers,
    ]) ?>

    <?= view('admin/sales/transaction', [
        'unit' => $unit,
    ]) ?>

<?php endforeach; ?>

<?php foreach ($sales as $sale): ?>

    <?= view('admin/sales/detail', [
        'sale' => $sale,
    ]) ?>

<?php endforeach; ?>


<?= $this->endSection() ?>