<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header sales-page-header">

    <div>

        <h1>
            Penjualan & Aktivasi Garansi
        </h1>

        <p>
            Pilih unit yang telah lolos QC dan siap diproses untuk penjualan.
        </p>

    </div>

</div>


<div class="card">

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

                                            <rect x="4" y="4" width="16" height="16" rx="3"></rect>

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

        <?php foreach ($units as $unit): ?>

            <?= view('admin/sales/select', [
                'unit' => $unit,
            ]) ?>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>