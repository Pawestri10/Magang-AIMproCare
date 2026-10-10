<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="public-warranty-result">
    <div class="public-warranty-result-container">

        <header class="public-warranty-result-header">
            <span class="public-warranty-brand">
                AIMPro Technology
            </span>

            <h1>Hasil Cek Garansi</h1>

            <p>
                Informasi garansi produk berhasil ditemukan.
            </p>
        </header>

        <?php if (! empty($warranty)): ?>

            <div class="public-warranty-result-card">

                <div class="public-warranty-result-status">
                    <span class="public-warranty-result-status-label">
                        Status Garansi
                    </span>

                    <span class="public-warranty-status-badge">
                        <?= esc($warranty['warranty_status']) ?>
                    </span>
                </div>

                <div class="public-warranty-product">
                    <span class="public-warranty-section-label">
                        Produk
                    </span>

                    <h2>
                        <?= esc($warranty['product_name']) ?>
                    </h2>

                    <p>
                        <?= esc($warranty['brand']) ?>
                        <span aria-hidden="true">•</span>
                        <?= esc($warranty['model']) ?>
                    </p>
                </div>

                <div class="public-warranty-divider"></div>

                <div class="public-warranty-info-grid">

                    <div class="public-warranty-info-item">
                        <span>Nomor Seri</span>
                        <strong>
                            <?= esc($warranty['serial_number']) ?>
                        </strong>
                    </div>

                    <div class="public-warranty-info-item">
                        <span>Nomor Garansi</span>
                        <strong>
                            <?= esc($warranty['warranty_number']) ?>
                        </strong>
                    </div>

                    <div class="public-warranty-info-item public-warranty-info-item-wide">
                        <span>Periode Garansi</span>
                        <strong>
                            <?= esc($warranty['warranty_start_date']) ?>
                            <span aria-hidden="true">—</span>
                            <?= esc($warranty['warranty_end_date']) ?>
                        </strong>
                    </div>

                    <div class="public-warranty-info-item public-warranty-info-item-wide">
                        <span>Sisa Garansi</span>
                        <strong>
                            <?= esc($warranty['remaining_warranty']) ?>
                        </strong>
                    </div>

                </div>

                <div class="public-warranty-divider"></div>

                <div class="public-warranty-customer">
                    <span class="public-warranty-section-label">
                        Data Pembeli
                    </span>

                    <div class="public-warranty-customer-grid">

                        <div class="public-warranty-info-item">
                            <span>Nama</span>
                            <strong>
                                <?= esc($warranty['customer_name']) ?>
                            </strong>
                        </div>

                        <div class="public-warranty-info-item">
                            <span>WhatsApp</span>
                            <strong>
                                <?= esc($warranty['customer_whatsapp']) ?>
                            </strong>
                        </div>

                    </div>
                </div>

                <div class="public-warranty-divider"></div>

                <div class="public-warranty-qc">
                    <span class="public-warranty-section-label">
                        Hasil QC
                    </span>

                    <strong>
                        <?= esc($warranty['qc_result']) ?>
                    </strong>
                </div>

                <div class="public-warranty-divider"></div>

                <div class="public-warranty-terms">
                    <span class="public-warranty-section-label">
                        Ketentuan
                    </span>

                    <p>
                        Garansi berlaku sesuai periode dan ketentuan yang
                        telah ditetapkan.
                    </p>
                </div>

            </div>

            <div class="public-warranty-result-note">
                Data garansi ditampilkan berdasarkan informasi yang
                tercatat pada sistem AIMPro Technology.
            </div>

            <a
                href="<?= base_url('klaim-garansi') ?>"
                class="public-warranty-back-button">
                Ajukan Klaim Garansi
            </a>

        <?php else: ?>

            <div class="public-warranty-result-card public-warranty-empty">
                <div class="public-warranty-empty-icon" aria-hidden="true">
                    !
                </div>

                <h2>Data Garansi Tidak Ditemukan</h2>

                <p>
                    Nomor garansi atau nomor seri yang diberikan
                    tidak ditemukan dalam sistem.
                </p>

                <a
                    href="<?= base_url('cek-garansi') ?>"
                    class="public-warranty-back-button">
                    Cek Garansi Lagi
                </a>
            </div>

        <?php endif; ?>

    </div>
</section>

<?= $this->endSection() ?>