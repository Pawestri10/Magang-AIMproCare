<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$totalUnits = (int) ($unitStats['total_units'] ?? 0);
$readyUnits = (int) ($unitStats['ready_units'] ?? 0);
$soldUnits = (int) ($unitStats['sold_units'] ?? 0);

$activeWarranties = (int) ($warrantyStats['active_warranties'] ?? 0);
$expiringWarranties = (int) ($warrantyStats['expiring_warranties'] ?? 0);
$expiredWarranties = (int) ($warrantyStats['expired_warranties'] ?? 0);

$newClaims = (int) ($claimStats['new_claims'] ?? 0);
$processingClaims = (int) ($claimStats['processing_claims'] ?? 0);

$maxChartValue = max(1, ...array_map(
    'intval',
    $chartValues ?? [0]
));
?>

<div class="page-header">
    <div>
        <h1>Dashboard Administrator</h1>
        <p>Ringkasan data unit produk, garansi, dan klaim AIMpro Care.</p>
    </div>
</div>

<!-- Statistik Unit Produk -->
<div class="dashboard-grid">
    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">▦</div>
        <div class="dashboard-stat-label">Total Unit</div>
        <div class="dashboard-stat-value">
            <?= number_format($totalUnits) ?>
        </div>
        <div class="dashboard-stat-description">
            Seluruh unit produk terdaftar
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">✓</div>
        <div class="dashboard-stat-label">Siap Dijual</div>
        <div class="dashboard-stat-value">
            <?= number_format($readyUnits) ?>
        </div>
        <div class="dashboard-stat-description">
            Unit lolos pemeriksaan QC
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">↗</div>
        <div class="dashboard-stat-label">Terjual</div>
        <div class="dashboard-stat-value">
            <?= number_format($soldUnits) ?>
        </div>
        <div class="dashboard-stat-description">
            Unit telah tercatat terjual
        </div>
    </div>
</div>

<!-- Statistik Garansi -->
<div class="section-header dashboard-section-header">
    <h2>Informasi Garansi</h2>
</div>

<div class="dashboard-grid">
    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">✓</div>
        <div class="dashboard-stat-label">Garansi Aktif</div>
        <div class="dashboard-stat-value">
            <?= number_format($activeWarranties) ?>
        </div>
        <div class="dashboard-stat-description">
            Garansi aktif yang belum berakhir
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">◷</div>
        <div class="dashboard-stat-label">Segera Berakhir</div>
        <div class="dashboard-stat-value">
            <?= number_format($expiringWarranties) ?>
        </div>
        <div class="dashboard-stat-description">
            Garansi berakhir dalam 30 hari ke depan
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">!</div>
        <div class="dashboard-stat-label">Garansi Berakhir</div>
        <div class="dashboard-stat-value">
            <?= number_format($expiredWarranties) ?>
        </div>
        <div class="dashboard-stat-description">
            Garansi yang sudah melewati tanggal akhir
        </div>
    </div>
</div>

<!-- Statistik Klaim -->
<div class="section-header dashboard-section-header">
    <h2>Informasi Klaim Garansi</h2>
</div>

<div class="dashboard-grid dashboard-grid-two">
    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">＋</div>
        <div class="dashboard-stat-label">Pengajuan Klaim Baru</div>
        <div class="dashboard-stat-value">
            <?= number_format($newClaims) ?>
        </div>
        <div class="dashboard-stat-description">
            Klaim dengan status Pengajuan Baru
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-icon">↻</div>
        <div class="dashboard-stat-label">Klaim Sedang Diproses</div>
        <div class="dashboard-stat-value">
            <?= number_format($processingClaims) ?>
        </div>
        <div class="dashboard-stat-description">
            Klaim yang masih dalam tahapan penanganan
        </div>
    </div>
</div>

<!-- Grafik Aktivasi Garansi -->
<div class="section-header dashboard-section-header">
    <h2>Grafik Aktivasi Garansi</h2>
    <p>Jumlah garansi berdasarkan bulan mulai berlakunya.</p>
</div>

<div class="card dashboard-chart-card">
    <?php if (!empty($chartLabels)): ?>
        <div class="dashboard-chart">
            <?php foreach ($chartLabels as $index => $label): ?>
                <?php
                $value = (int) ($chartValues[$index] ?? 0);
                $height = $value > 0
                    ? max(8, ($value / $maxChartValue) * 100)
                    : 0;
                ?>

                <div class="dashboard-chart-column">
                    <div class="dashboard-chart-bar-area">
                        <?php if ($value > 0): ?>
                            <span class="dashboard-chart-value">
                                <?= number_format($value) ?>
                            </span>
                        <?php endif; ?>

                        <div
                            class="dashboard-chart-bar"
                            style="height: <?= $height ?>%;"
                            title="<?= esc($label) ?>: <?= $value ?> aktivasi"></div>
                    </div>

                    <div class="dashboard-chart-label">
                        <?= esc($label) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            Belum ada data aktivasi garansi.
        </div>
    <?php endif; ?>
</div>

<!-- Produk Terlaris -->
<div class="section-header dashboard-section-header">
    <h2>Produk Paling Banyak Terjual</h2>
    <p>Lima produk dengan jumlah penjualan tertinggi.</p>
</div>

<div class="card">
    <?php if (!empty($bestSellingProducts)): ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Total Terjual</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($bestSellingProducts as $index => $product): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <?= esc($product['name'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($product['brand'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($product['model'] ?? '-') ?>
                            </td>

                            <td>
                                <strong>
                                    <?= number_format((int) ($product['total_sold'] ?? 0)) ?>
                                </strong>
                                unit
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            Belum ada data penjualan produk.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>