<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<div class="page-header">

    <div>

        <h1>
            Pemeriksaan QC
        </h1>

        <p>
            Kelola unit produk dan nomor serial untuk proses pemeriksaan QC.
        </p>

    </div>

</div>


<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success">

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>


<div class="card">

    <div class="table-toolbar">

        <button
            type="button"
            class="button button-primary"
            data-modal-open="product-unit-create-modal">

            + Tambah Unit

        </button>

    </div>


    <?php if (empty($units)): ?>

        <div class="empty-state">

            <p>
                Belum ada unit produk.
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
                            Dibuat
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($units as $index => $unit): ?>

                        <?php
                        $statusClassMap = [
                            'Draft'                   => 'badge-muted',
                            'Menunggu QC'             => 'badge-info',
                            'Perlu Pemeriksaan Ulang' => 'badge-warning',
                            'Tidak Lolos QC'          => 'badge-danger',
                            'Siap Dijual'             => 'badge-success',
                            'Terjual'                 => 'badge-purple',
                            'Dikembalikan'            => 'badge-orange',
                        ];

                        $statusClass = $statusClassMap[$unit['status']] ?? 'badge-muted';
                        ?>

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

                                <span class="badge <?= esc($statusClass) ?>">

                                    <?= esc($unit['status']) ?>

                                </span>

                            </td>

                            <td>
                                <?= esc($unit['created_at']) ?>
                            </td>

                            <td>

                                <div class="table-actions">

                                    <?php if (
                                        $unit['status'] === 'Menunggu QC' ||
                                        $unit['status'] === 'Perlu Pemeriksaan Ulang'
                                    ): ?>

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-edit"
                                            data-modal-open="product-unit-inspect-modal-<?= esc($unit['id']) ?>"
                                            data-tooltip="<?= $unit['status'] === 'Perlu Pemeriksaan Ulang'
                                                                ? 'Mulai Pemeriksaan Ulang'
                                                                : 'Mulai Pemeriksaan' ?>"
                                            aria-label="<?= $unit['status'] === 'Perlu Pemeriksaan Ulang'
                                                            ? 'Mulai Pemeriksaan Ulang'
                                                            : 'Mulai Pemeriksaan' ?>">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">

                                                <path d="M9 5h6"></path>

                                                <path d="M9 3h6a1 1 0 0 1 1 1v2H8V4a1 1 0 0 1 1-1 1z"></path>

                                                <rect
                                                    x="5"
                                                    y="5"
                                                    width="14"
                                                    height="16"
                                                    rx="2">
                                                </rect>

                                                <path d="m9 13 2 2 4-4"></path>

                                            </svg>

                                        </button>

                                    <?php endif; ?>


                                    <?php if ((int) $unit['has_inspection'] === 1): ?>

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-view"
                                            data-modal-open="product-unit-detail-modal-<?= esc($unit['id']) ?>"
                                            data-tooltip="Detail Pemeriksaan"
                                            aria-label="Detail Pemeriksaan">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">

                                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"></path>

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5">
                                                </circle>

                                            </svg>

                                        </button>

                                    <?php endif; ?>

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

    <?php if (
        $unit['status'] === 'Menunggu QC' ||
        $unit['status'] === 'Perlu Pemeriksaan Ulang'
    ): ?>

        <?= view('qc/product_units/inspect', [
            'unit' => $unit,
        ]) ?>

    <?php endif; ?>

<?php endforeach; ?>

<?= view('qc/product_units/create', [
    'products' => $products,
]) ?>

<?php foreach ($units as $unit): ?>

    <?php if ((int) $unit['has_inspection'] === 1): ?>

        <?= view('qc/product_units/detail', [
            'unit' => $unit,
            'inspections' => $inspectionHistory[$unit['id']] ?? [],
        ]) ?>

    <?php endif; ?>

<?php endforeach; ?>

<?= $this->endSection() ?>