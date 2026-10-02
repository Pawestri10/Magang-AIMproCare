<div
    class="modal"
    id="sales-detail-modal-<?= esc($sale['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="sales-detail-title-<?= esc($sale['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="sales-detail-title-<?= esc($sale['id']) ?>">
                    Detail Penjualan
                </h2>

                <p>
                    Informasi transaksi penjualan dan aktivasi garansi.
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


        <div class="modal-body">

            <!-- INFORMASI UNIT -->

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Informasi Unit
                    </h3>

                    <p>
                        Data unit yang telah diproses melalui transaksi penjualan.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="sales-detail-product-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Produk

                        </label>

                        <input
                            type="text"
                            id="sales-detail-product-<?= esc($sale['id']) ?>"
                            class="form-input"
                            value="<?= esc($sale['product_name']) ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-detail-brand-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Brand

                            </label>

                            <input
                                type="text"
                                id="sales-detail-brand-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['brand']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-detail-model-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Model

                            </label>

                            <input
                                type="text"
                                id="sales-detail-model-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['model']) ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-detail-serial-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Nomor Serial

                        </label>

                        <input
                            type="text"
                            id="sales-detail-serial-<?= esc($sale['id']) ?>"
                            class="form-input"
                            value="<?= esc($sale['serial_number']) ?>"
                            readonly>

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Status Unit
                        </label>

                        <div>

                            <?php if (($sale['unit_status'] ?? '') === 'Terjual'): ?>

                                <span class="badge badge-success">
                                    <?= esc($sale['unit_status']) ?>
                                </span>

                            <?php else: ?>

                                <span class="badge">
                                    <?= esc($sale['unit_status'] ?? '-') ?>
                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>


            <!-- DATA PEMBELI -->

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Data Pembeli
                    </h3>

                    <p>
                        Informasi pembeli yang tercatat pada transaksi.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="sales-detail-customer-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Nama Pembeli

                        </label>

                        <input
                            type="text"
                            id="sales-detail-customer-<?= esc($sale['id']) ?>"
                            class="form-input"
                            value="<?= esc($sale['customer_name']) ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-detail-whatsapp-<?= esc($sale['id']) ?>"
                                class="form-label">

                                WhatsApp

                            </label>

                            <input
                                type="text"
                                id="sales-detail-whatsapp-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['customer_whatsapp'] ?? '-') ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-detail-email-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Email

                            </label>

                            <input
                                type="text"
                                id="sales-detail-email-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['customer_email'] ?? '-') ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-detail-address-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Alamat

                        </label>

                        <textarea
                            id="sales-detail-address-<?= esc($sale['id']) ?>"
                            class="form-input"
                            rows="3"
                            readonly><?= esc($sale['customer_address'] ?? '-') ?></textarea>

                    </div>

                </div>

            </div>


            <!-- DATA TRANSAKSI -->

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Data Transaksi
                    </h3>

                    <p>
                        Informasi transaksi penjualan yang tersimpan di sistem.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-detail-purchase-date-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Tanggal Pembelian

                            </label>

                            <input
                                type="date"
                                id="sales-detail-purchase-date-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['purchase_date']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-detail-invoice-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Invoice / Nota

                            </label>

                            <input
                                type="text"
                                id="sales-detail-invoice-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['invoice_number']) ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-detail-location-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Marketplace / Lokasi Pembelian

                        </label>

                        <input
                            type="text"
                            id="sales-detail-location-<?= esc($sale['id']) ?>"
                            class="form-input"
                            value="<?= esc($sale['purchase_location']) ?>"
                            readonly>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-detail-order-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Nomor Order Marketplace

                        </label>

                        <input
                            type="text"
                            id="sales-detail-order-<?= esc($sale['id']) ?>"
                            class="form-input"
                            value="<?= esc($sale['marketplace_order_number'] ?: '-') ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-detail-duration-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Durasi Garansi

                            </label>

                            <input
                                type="text"
                                id="sales-detail-duration-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['warranty_duration']) ?> <?= esc($sale['warranty_duration_unit']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-detail-sale-start-date-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Tanggal Mulai Garansi

                            </label>

                            <input
                                type="date"
                                id="sales-detail-sale-start-date-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['sale_warranty_start_date']) ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label">

                            Nota Pembelian

                        </label>

                        <?php if (!empty($sale['purchase_receipt_path'])): ?>

                            <div>
                                Nota pembelian tersedia.
                            </div>

                        <?php else: ?>

                            <div>
                                Tidak ada nota pembelian.
                            </div>

                        <?php endif; ?>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-detail-notes-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Catatan

                        </label>

                        <textarea
                            id="sales-detail-notes-<?= esc($sale['id']) ?>"
                            class="form-input"
                            rows="3"
                            readonly><?= esc($sale['notes'] ?: '-') ?></textarea>

                    </div>

                </div>

            </div>


            <!-- INFORMASI GARANSI -->

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Informasi Garansi
                    </h3>

                    <p>
                        Informasi garansi yang dibuat saat transaksi berhasil diaktifkan.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="sales-detail-warranty-number-<?= esc($sale['id']) ?>"
                            class="form-label">

                            Nomor Garansi

                        </label>

                        <input
                            type="text"
                            id="sales-detail-warranty-number-<?= esc($sale['id']) ?>"
                            class="form-input"
                            value="<?= esc($sale['warranty_number'] ?? '-') ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-detail-warranty-start-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Mulai Garansi

                            </label>

                            <input
                                type="date"
                                id="sales-detail-warranty-start-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['warranty_start_date'] ?? '') ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-detail-warranty-end-<?= esc($sale['id']) ?>"
                                class="form-label">

                                Berakhir Garansi

                            </label>

                            <input
                                type="date"
                                id="sales-detail-warranty-end-<?= esc($sale['id']) ?>"
                                class="form-input"
                                value="<?= esc($sale['warranty_end_date'] ?? '') ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Status Garansi
                        </label>

                        <div>

                            <?php if (($sale['warranty_status'] ?? '') === 'Garansi Aktif'): ?>

                                <span class="badge badge-success">
                                    <?= esc($sale['warranty_status']) ?>
                                </span>

                            <?php else: ?>

                                <span class="badge">
                                    <?= esc($sale['warranty_status'] ?? 'Belum tersedia') ?>
                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                    <?php if (!empty($sale['qr_code_svg'])): ?>

                        <div class="form-group">

                            <label class="form-label">
                                QR Code Garansi
                            </label>

                            <div class="warranty-qr-code">
                                <?= $sale['qr_code_svg'] ?>
                            </div>

                            <p class="form-help">
                                Pindai QR Code untuk membuka halaman pengecekan garansi.
                            </p>

                        </div>

                    <?php endif; ?>

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

            </div>

        </div>

    </div>

</div>