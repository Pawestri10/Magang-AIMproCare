<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<div class="public-claim-tracking">

    <section class="public-claim-hero">
        <div class="public-claim-container">

            <div class="public-claim-eyebrow">
                AIMPro Technology
            </div>

            <h1 class="public-claim-title">
                Lacak Klaim Garansi
            </h1>

            <p class="public-claim-subtitle">
                Pantau perkembangan penanganan klaim garansi Anda secara berkala.
            </p>

        </div>
    </section>


    <section class="public-claim-content">
        <div class="public-claim-container">

            <!-- Claim Summary -->
            <div class="public-claim-card public-claim-summary">

                <div class="public-claim-summary-header">

                    <div>
                        <span class="public-claim-label">
                            Nomor Klaim
                        </span>

                        <h2 class="public-claim-number">
                            <?= esc($claim['claim_number']) ?>
                        </h2>
                    </div>

                    <div class="public-claim-status">
                        <span class="public-claim-label">
                            Status Saat Ini
                        </span>

                        <span class="public-claim-status">
                            <?= esc($claim['status']) ?>
                        </span>
                    </div>

                </div>

                <div class="public-claim-summary-meta">

                    <div class="public-claim-meta-item">
                        <span class="public-claim-label">
                            Tanggal Pengajuan
                        </span>

                        <span>
                            <?= esc(date('d/m/Y H:i', strtotime($claim['created_at']))) ?>
                        </span>
                    </div>

                    <div class="public-claim-meta-item">
                        <span class="public-claim-label">
                            Nomor Serial
                        </span>

                        <span>
                            <?= esc($claim['serial_number']) ?>
                        </span>
                    </div>

                </div>

            </div>

            <div class="public-claim-card">

                <div class="public-claim-section-heading">
                    <span class="public-claim-label">
                        Produk
                    </span>

                    <h2>
                        Informasi Produk
                    </h2>
                </div>

                <div class="public-claim-product-grid">

                    <div class="public-claim-meta-item">
                        <span class="public-claim-label">
                            Produk
                        </span>

                        <span class="public-claim-value">
                            <?= esc($claim['product_name']) ?>
                        </span>
                    </div>

                    <div class="public-claim-meta-item">
                        <span class="public-claim-label">
                            Brand
                        </span>

                        <span class="public-claim-value">
                            <?= esc($claim['brand']) ?>
                        </span>
                    </div>

                    <div class="public-claim-meta-item">
                        <span class="public-claim-label">
                            Model
                        </span>

                        <span class="public-claim-value">
                            <?= esc($claim['model']) ?>
                        </span>
                    </div>

                    <div class="public-claim-meta-item">
                        <span class="public-claim-label">
                            Serial Number
                        </span>

                        <span class="public-claim-value">
                            <?= esc($claim['serial_number']) ?>
                        </span>
                    </div>

                </div>

            </div>

            <div class="public-claim-card">

                <div class="public-claim-section-heading">
                    <span class="public-claim-label">
                        Perkembangan
                    </span>

                    <h2>
                        Riwayat Klaim
                    </h2>
                </div>

                <div class="public-claim-timeline">

                    <?php foreach ($history as $index => $item): ?>

                        <div class="public-claim-timeline-item">

                            <div class="public-claim-timeline-marker">
                                <span></span>
                            </div>

                            <div class="public-claim-timeline-content">

                                <div class="public-claim-timeline-header">

                                    <h3>
                                        <?= esc($item['status']) ?>
                                    </h3>

                                    <time>
                                        <?= esc(
                                            date(
                                                'd/m/Y H:i',
                                                strtotime($item['changed_at'])
                                            )
                                        ) ?>
                                    </time>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="public-claim-actions">

                <a
                    href="<?= base_url('cek-garansi') ?>"
                    class="public-claim-action secondary">
                    Cek Garansi
                </a>

                <a
                    href="<?= base_url('klaim-garansi') ?>"
                    class="public-claim-action primary">
                    Ajukan Klaim
                </a>

            </div>

        </div>
    </section>

</div>

<?= $this->endSection() ?>