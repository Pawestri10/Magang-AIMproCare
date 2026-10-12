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

<div class="dashboard-grid">

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">▦</div>
            <span class="dashboard-stat-badge">UNIT</span>
        </div>

        <div class="dashboard-stat-label">Total Unit</div>

        <div class="dashboard-stat-value">
            <?= number_format($totalUnits) ?>
        </div>

        <div class="dashboard-stat-description">
            Seluruh unit produk terdaftar
        </div>
    </div>


    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">✓</div>
            <span class="dashboard-stat-badge">QC</span>
        </div>

        <div class="dashboard-stat-label">Siap Dijual</div>

        <div class="dashboard-stat-value">
            <?= number_format($readyUnits) ?>
        </div>

        <div class="dashboard-stat-description">
            Unit lolos pemeriksaan QC
        </div>
    </div>


    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">↗</div>
            <span class="dashboard-stat-badge">PENJUALAN</span>
        </div>

        <div class="dashboard-stat-label">Terjual</div>

        <div class="dashboard-stat-value">
            <?= number_format($soldUnits) ?>
        </div>

        <div class="dashboard-stat-description">
            Unit telah tercatat terjual
        </div>
    </div>
</div>

<div class="section-header dashboard-section-header">
    <h2>Informasi Garansi</h2>
</div>

<div class="dashboard-grid">

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">✓</div>
            <span class="dashboard-stat-badge">AKTIF</span>
        </div>

        <div class="dashboard-stat-label">Garansi Aktif</div>

        <div class="dashboard-stat-value">
            <?= number_format($activeWarranties) ?>
        </div>

        <div class="dashboard-stat-description">
            Garansi aktif yang belum berakhir
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">◷</div>
            <span class="dashboard-stat-badge">PERHATIAN</span>
        </div>

        <div class="dashboard-stat-label">Segera Berakhir</div>

        <div class="dashboard-stat-value">
            <?= number_format($expiringWarranties) ?>
        </div>

        <div class="dashboard-stat-description">
            Garansi berakhir dalam 30 hari ke depan
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">!</div>
            <span class="dashboard-stat-badge">BERAKHIR</span>
        </div>

        <div class="dashboard-stat-label">Garansi Berakhir</div>

        <div class="dashboard-stat-value">
            <?= number_format($expiredWarranties) ?>
        </div>

        <div class="dashboard-stat-description">
            Garansi yang sudah melewati tanggal akhir
        </div>
    </div>

</div>

<div class="section-header dashboard-section-header">
    <h2>Informasi Klaim Garansi</h2>
</div>

<div class="dashboard-grid dashboard-grid-two">

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">＋</div>
            <span class="dashboard-stat-badge">BARU</span>
        </div>

        <div class="dashboard-stat-label">Pengajuan Klaim Baru</div>

        <div class="dashboard-stat-value">
            <?= number_format($newClaims) ?>
        </div>

        <div class="dashboard-stat-description">
            Klaim dengan status Pengajuan Baru
        </div>
    </div>

    <div class="card dashboard-stat-card">
        <div class="dashboard-stat-top">
            <div class="dashboard-stat-icon">↻</div>
            <span class="dashboard-stat-badge">PROSES</span>
        </div>

        <div class="dashboard-stat-label">Klaim Sedang Diproses</div>

        <div class="dashboard-stat-value">
            <?= number_format($processingClaims) ?>
        </div>

        <div class="dashboard-stat-description">
            Klaim yang masih dalam tahapan penanganan
        </div>
    </div>

</div>

<div class="section-header dashboard-section-header">
    <h2>Grafik Aktivasi Garansi</h2>
    <p>Jumlah garansi berdasarkan bulan mulai berlakunya.</p>
</div>

<div class="card dashboard-chart-card">
    <?php if (!empty($chartLabels)): ?>
        <?php
        $chartCount = count($chartLabels);
        $chartWidth = 900;
        $chartHeight = 300;

        $chartPaddingLeft = 55;
        $chartPaddingRight = 25;
        $chartPaddingTop = 30;
        $chartPaddingBottom = 45;

        $plotWidth = $chartWidth - $chartPaddingLeft - $chartPaddingRight;
        $plotHeight = $chartHeight - $chartPaddingTop - $chartPaddingBottom;

        $chartMaxValue = max(
            1,
            ...array_map('intval', $chartValues ?? [0])
        );

        $chartPoints = [];

        foreach ($chartLabels as $index => $label) {
            $value = (int) ($chartValues[$index] ?? 0);

            $x = $chartCount > 1
                ? $chartPaddingLeft + ($index / ($chartCount - 1)) * $plotWidth
                : $chartPaddingLeft + ($plotWidth / 2);

            $y = $chartPaddingTop
                + $plotHeight
                - (($value / $chartMaxValue) * $plotHeight);

            $chartPoints[] = [
                'x' => $x,
                'y' => $y,
                'label' => $label,
                'value' => $value,
            ];
        }

        $linePoints = implode(' ', array_map(
            fn($point) => $point['x'] . ',' . $point['y'],
            $chartPoints
        ));
        ?>

        <div class="dashboard-line-chart-wrapper">
            <svg
                class="dashboard-line-chart"
                viewBox="0 0 <?= $chartWidth ?> <?= $chartHeight ?>"
                role="img"
                aria-label="Grafik garis aktivasi garansi berdasarkan bulan">

                <?php for ($i = 0; $i <= 4; $i++): ?>
                    <?php
                    $gridY = $chartPaddingTop + ($plotHeight / 4) * $i;
                    $gridValue = (int) round(
                        $chartMaxValue * (1 - ($i / 4))
                    );
                    ?>

                    <line
                        x1="<?= $chartPaddingLeft ?>"
                        y1="<?= $gridY ?>"
                        x2="<?= $chartWidth - $chartPaddingRight ?>"
                        y2="<?= $gridY ?>"
                        class="dashboard-chart-grid-line" />

                    <text
                        x="<?= $chartPaddingLeft - 12 ?>"
                        y="<?= $gridY + 4 ?>"
                        class="dashboard-chart-axis-value"
                        text-anchor="end">
                        <?= number_format($gridValue) ?>
                    </text>
                <?php endfor; ?>

                <?php if (count($chartPoints) > 1): ?>
                    <polyline
                        points="<?= esc($linePoints) ?>"
                        class="dashboard-line-chart-path" />
                <?php endif; ?>

                <?php foreach ($chartPoints as $point): ?>
                    <circle
                        cx="<?= $point['x'] ?>"
                        cy="<?= $point['y'] ?>"
                        r="5"
                        class="dashboard-line-chart-dot">
                        <title><?= esc($point['label']) ?>: <?= number_format($point['value']) ?> aktivasi</title>
                    </circle>

                    <text
                        x="<?= $point['x'] ?>"
                        y="<?= $chartHeight - 15 ?>"
                        class="dashboard-chart-month-label"
                        text-anchor="middle">
                        <?= esc($point['label']) ?>
                    </text>

                    <text
                        x="<?= $point['x'] ?>"
                        y="<?= $point['y'] - 12 ?>"
                        class="dashboard-chart-point-value"
                        text-anchor="middle">
                        <?= number_format($point['value']) ?>
                    </text>
                <?php endforeach; ?>
            </svg>
        </div>
    <?php else: ?>
        <div class="empty-state">
            Belum ada data aktivasi garansi.
        </div>
    <?php endif; ?>
</div>

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