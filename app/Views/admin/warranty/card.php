<?php
$sale = $sale ?? [];
?>

<div
    class="modal warranty-card-modal"
    id="warranty-card-modal-<?= esc($sale['id'] ?? '') ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog warranty-card-modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="warranty-card-title-<?= esc($sale['id'] ?? '') ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="warranty-card-title-<?= esc($sale['id'] ?? '') ?>">
                    Kartu Garansi Digital
                </h2>

                <p>
                    Preview kartu garansi untuk pembeli.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                aria-label="Tutup"
                data-modal-close>

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true">

                    <path d="M6 6l12 12"></path>
                    <path d="M18 6L6 18"></path>

                </svg>

            </button>

        </div>


        <div class="modal-body warranty-card-modal-body">

            <div class="warranty-card">

                <div class="warranty-card-header">

                    <div class="warranty-card-company">
                        AIMPro Technology
                    </div>

                    <div class="warranty-card-title">
                        KARTU GARANSI DIGITAL
                    </div>

                </div>


                <div class="warranty-card-body">

                    <!-- PEMBELI -->

                    <section class="warranty-card-section">

                        <div class="warranty-card-section-title">
                            Pembeli
                        </div>

                        <div class="warranty-card-value">
                            <?= esc($sale['customer_name'] ?? '-') ?>
                        </div>

                    </section>


                    <!-- PRODUK -->

                    <section class="warranty-card-section">

                        <div class="warranty-card-section-title">
                            Produk
                        </div>

                        <div class="warranty-card-value">
                            <?= esc($sale['product_name'] ?? '-') ?>
                        </div>

                        <div class="warranty-card-meta">
                            <?= esc($sale['brand'] ?? '-') ?>
                            <span>•</span>
                            <?= esc($sale['model'] ?? '-') ?>
                        </div>

                    </section>


                    <!-- INFORMASI UNIT -->

                    <section class="warranty-card-section">

                        <div class="warranty-card-section-title">
                            Informasi Unit
                        </div>

                        <div class="warranty-card-grid">

                            <div>

                                <div class="warranty-card-label">
                                    Nomor Seri
                                </div>

                                <div class="warranty-card-value">
                                    <?= esc($sale['serial_number'] ?? '-') ?>
                                </div>

                            </div>


                            <div>

                                <div class="warranty-card-label">
                                    Nomor Garansi
                                </div>

                                <div class="warranty-card-value">
                                    <?= esc($sale['warranty_number'] ?? '-') ?>
                                </div>

                            </div>

                        </div>

                    </section>


                    <!-- PERIODE GARANSI -->

                    <section class="warranty-card-section">

                        <div class="warranty-card-section-title">
                            Periode Garansi
                        </div>

                        <div class="warranty-card-grid warranty-card-grid-three">

                            <div>

                                <div class="warranty-card-label">
                                    Tanggal Pembelian
                                </div>

                                <div class="warranty-card-value">
                                    <?= !empty($sale['purchase_date'])
                                        ? esc(date('d/m/Y', strtotime($sale['purchase_date'])))
                                        : '-' ?>
                                </div>

                            </div>


                            <div>

                                <div class="warranty-card-label">
                                    Mulai
                                </div>

                                <div class="warranty-card-value">
                                    <?= !empty($sale['warranty_start_date'])
                                        ? esc(date('d/m/Y', strtotime($sale['warranty_start_date'])))
                                        : '-' ?>
                                </div>

                            </div>


                            <div>

                                <div class="warranty-card-label">
                                    Berakhir
                                </div>

                                <div class="warranty-card-value">
                                    <?= !empty($sale['warranty_end_date'])
                                        ? esc(date('d/m/Y', strtotime($sale['warranty_end_date'])))
                                        : '-' ?>
                                </div>

                            </div>

                        </div>

                    </section>


                    <!-- STATUS GARANSI -->

                    <section class="warranty-card-status-section">

                        <div class="warranty-card-section-title">
                            Status Garansi
                        </div>

                        <div class="warranty-card-status">
                            <?= esc($sale['warranty_status'] ?? '-') ?>
                        </div>

                    </section>


                    <!-- QR CODE -->

                    <?php if (!empty($sale['qr_code_svg'])): ?>

                        <section class="warranty-card-qr-section">

                            <div class="warranty-card-qr">
                                <?= $sale['qr_code_svg'] ?>
                            </div>

                            <div class="warranty-card-qr-text">
                                Pindai QR Code untuk memeriksa garansi.
                            </div>

                        </section>

                    <?php endif; ?>


                    <!-- KETENTUAN -->

                    <section class="warranty-card-terms">

                        <div class="warranty-card-section-title">
                            Ketentuan
                        </div>

                        <p>
                            Garansi berlaku sesuai periode dan ketentuan
                            yang telah ditetapkan.
                        </p>

                    </section>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <div class="modal-footer-actions">

                <button
                    type="button"
                    class="button button-secondary"
                    data-modal-close>

                    Tutup

                </button>


                <button
                    type="button"
                    class="button button-primary warranty-card-print-button"
                    data-warranty-print>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">

                        <path d="M6 9V4h12v5"></path>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <path d="M6 14h12v7H6z"></path>

                    </svg>

                    <span>
                        Cetak Kartu
                    </span>

                </button>

            </div>

        </div>

    </div>

</div>