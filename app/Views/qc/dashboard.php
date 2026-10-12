<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$waitingUnits = (int) ($unitStats['waiting_units'] ?? 0);
$reinspectionUnits = (int) ($unitStats['reinspection_units'] ?? 0);

$inspectedToday = (int) ($inspectionStats['inspected_today'] ?? 0);
$passedInspections = (int) ($inspectionStats['passed_inspections'] ?? 0);
$failedInspections = (int) ($inspectionStats['failed_inspections'] ?? 0);
?>

<div class="page-header">
    <div>
        <h1>Dashboard Petugas QC</h1>
        <p>Ringkasan pemeriksaan kualitas unit produk AIMpro Care.</p>
    </div>
</div>

<div class="dashboard-grid">

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">◷</div>
            <span class="dashboard-stat-badge">ANTREAN</span>
        </div>

        <div class="dashboard-stat-label">
            Menunggu QC
        </div>

        <div class="dashboard-stat-value">
            <?= number_format($waitingUnits) ?>
        </div>

        <div class="dashboard-stat-description">
            Unit yang belum menjalani pemeriksaan
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">↻</div>
            <span class="dashboard-stat-badge">ULANG</span>
        </div>

        <div class="dashboard-stat-label">
            Pemeriksaan Ulang
        </div>

        <div class="dashboard-stat-value">
            <?= number_format($reinspectionUnits) ?>
        </div>

        <div class="dashboard-stat-description">
            Unit yang memerlukan pemeriksaan kembali
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">✓</div>
            <span class="dashboard-stat-badge">HARI INI</span>
        </div>

        <div class="dashboard-stat-label">
            Diperiksa Hari Ini
        </div>

        <div class="dashboard-stat-value">
            <?= number_format($inspectedToday) ?>
        </div>

        <div class="dashboard-stat-description">
            Jumlah pemeriksaan pada hari ini
        </div>
    </div>

</div>

<div class="section-header dashboard-section-header">
    <h2>Ringkasan Hasil Pemeriksaan</h2>
    <p>Rekap hasil seluruh pemeriksaan yang tercatat.</p>
</div>

<div class="dashboard-grid dashboard-grid-two">

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">✓</div>
            <span class="dashboard-stat-badge">LOLOS</span>
        </div>

        <div class="dashboard-stat-label">
            Lolos QC
        </div>

        <div class="dashboard-stat-value">
            <?= number_format($passedInspections) ?>
        </div>

        <div class="dashboard-stat-description">
            Pemeriksaan dengan hasil Lolos QC
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">!</div>
            <span class="dashboard-stat-badge">TIDAK LOLOS</span>
        </div>

        <div class="dashboard-stat-label">
            Tidak Lolos QC
        </div>

        <div class="dashboard-stat-value">
            <?= number_format($failedInspections) ?>
        </div>

        <div class="dashboard-stat-description">
            Pemeriksaan dengan hasil Tidak Lolos QC
        </div>
    </div>

</div>

<div class="section-header dashboard-section-header">
    <h2>Riwayat Pemeriksaan Terbaru</h2>
    <p>Lima pemeriksaan QC terakhir yang tercatat di sistem.</p>
</div>

<div class="card">
    <?php if (!empty($recentInspections)): ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Nomor Seri</th>
                        <th>Kondisi Fisik</th>
                        <th>Kelengkapan</th>
                        <th>Hasil QC</th>
                        <th>Petugas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($recentInspections as $index => $inspection): ?>
                        <?php
                        $result = $inspection['result'] ?? '';

                        $resultClass = match ($result) {
                            'Lolos QC' => 'qc-result-passed',
                            'Tidak Lolos QC' => 'qc-result-failed',
                            'Perlu Pemeriksaan Ulang' => 'qc-result-reinspection',
                            default => 'qc-result-default',
                        };
                        ?>

                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <?= !empty($inspection['inspection_date'])
                                    ? esc(date(
                                        'd-m-Y',
                                        strtotime($inspection['inspection_date'])
                                    ))
                                    : '-' ?>
                            </td>

                            <td>
                                <strong>
                                    <?= esc($inspection['product_name'] ?? '-') ?>
                                </strong>

                                <div class="qc-product-meta">
                                    <?= esc($inspection['brand'] ?? '-') ?>
                                    <?= !empty($inspection['model'])
                                        ? ' · ' . esc($inspection['model'])
                                        : '' ?>
                                </div>
                            </td>

                            <td>
                                <?= esc($inspection['serial_number'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($inspection['physical_condition'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($inspection['completeness'] ?? '-') ?>
                            </td>

                            <td>
                                <span class="qc-result-badge <?= esc($resultClass) ?>">
                                    <?= esc($result ?: 'Belum ada hasil') ?>
                                </span>
                            </td>

                            <td>
                                <?= esc($inspection['officer_name'] ?? '-') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            Belum ada riwayat pemeriksaan QC.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>