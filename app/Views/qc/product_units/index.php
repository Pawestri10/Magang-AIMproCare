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

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>

<?= view('qc/product_units/create', [
    'products' => $products,
]) ?>

<?= $this->endSection() ?>