<div
    class="modal"
    id="claim-detail-modal-<?= esc($claim['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="claim-detail-title-<?= esc($claim['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2
                    id="claim-detail-title-<?= esc($claim['id']) ?>">

                    Detail Klaim Garansi

                </h2>

                <p>
                    Informasi pengajuan, pelanggan, produk, dan riwayat klaim garansi.
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

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Informasi Klaim
                    </h3>

                    <p>
                        Informasi utama pengajuan klaim garansi pelanggan.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="claim-detail-number-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Nomor Klaim

                        </label>

                        <input
                            type="text"
                            id="claim-detail-number-<?= esc($claim['id']) ?>"
                            class="form-input"
                            value="<?= esc($claim['claim_number']) ?>"
                            readonly>

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Status Klaim
                        </label>

                        <div>

                            <?php if (($claim['status'] ?? '') === 'Klaim Ditolak'): ?>

                                <span class="badge badge-danger">
                                    <?= esc($claim['status']) ?>
                                </span>

                            <?php elseif (($claim['status'] ?? '') === 'Selesai'): ?>

                                <span class="badge badge-success">
                                    <?= esc($claim['status']) ?>
                                </span>

                            <?php else: ?>

                                <span class="badge">
                                    <?= esc($claim['status'] ?? '-') ?>
                                </span>

                            <?php endif; ?>

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="claim-detail-created-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Tanggal Pengajuan

                            </label>

                            <input
                                type="text"
                                id="claim-detail-created-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['created_at']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="claim-detail-damage-date-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Tanggal Kerusakan

                            </label>

                            <input
                                type="date"
                                id="claim-detail-damage-date-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['damage_started_at']) ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="claim-detail-complaint-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Keluhan / Kerusakan

                        </label>

                        <textarea
                            id="claim-detail-complaint-<?= esc($claim['id']) ?>"
                            class="form-input"
                            rows="4"
                            readonly><?= esc($claim['complaint']) ?></textarea>

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Informasi Unit
                    </h3>

                    <p>
                        Data produk yang terkait dengan klaim garansi.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="claim-detail-product-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Produk

                        </label>

                        <input
                            type="text"
                            id="claim-detail-product-<?= esc($claim['id']) ?>"
                            class="form-input"
                            value="<?= esc($claim['product_name']) ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="claim-detail-brand-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Brand

                            </label>

                            <input
                                type="text"
                                id="claim-detail-brand-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['brand']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="claim-detail-model-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Model

                            </label>

                            <input
                                type="text"
                                id="claim-detail-model-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['model']) ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="claim-detail-serial-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Nomor Serial

                        </label>

                        <input
                            type="text"
                            id="claim-detail-serial-<?= esc($claim['id']) ?>"
                            class="form-input"
                            value="<?= esc($claim['serial_number']) ?>"
                            readonly>

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Informasi Garansi
                    </h3>

                    <p>
                        Informasi garansi yang menjadi dasar pengajuan klaim.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="claim-detail-warranty-number-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Nomor Garansi

                        </label>

                        <input
                            type="text"
                            id="claim-detail-warranty-number-<?= esc($claim['id']) ?>"
                            class="form-input"
                            value="<?= esc($claim['warranty_number'] ?? '-') ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="claim-detail-warranty-start-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Mulai Garansi

                            </label>

                            <input
                                type="date"
                                id="claim-detail-warranty-start-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['warranty_start_date'] ?? '') ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="claim-detail-warranty-end-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Berakhir Garansi

                            </label>

                            <input
                                type="date"
                                id="claim-detail-warranty-end-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['warranty_end_date'] ?? '') ?>"
                                readonly>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Data Pembeli
                    </h3>

                    <p>
                        Informasi pembeli yang tercatat pada transaksi garansi.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="claim-detail-customer-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Nama Pembeli

                        </label>

                        <input
                            type="text"
                            id="claim-detail-customer-<?= esc($claim['id']) ?>"
                            class="form-input"
                            value="<?= esc($claim['customer_name']) ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="claim-detail-customer-whatsapp-<?= esc($claim['id']) ?>"
                                class="form-label">

                                WhatsApp

                            </label>

                            <input
                                type="text"
                                id="claim-detail-customer-whatsapp-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['customer_whatsapp'] ?? '-') ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="claim-detail-customer-email-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Email

                            </label>

                            <input
                                type="text"
                                id="claim-detail-customer-email-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['customer_email'] ?? '-') ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="claim-detail-customer-address-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Alamat

                        </label>

                        <textarea
                            id="claim-detail-customer-address-<?= esc($claim['id']) ?>"
                            class="form-input"
                            rows="3"
                            readonly><?= esc($claim['customer_address'] ?? '-') ?></textarea>

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Pengiriman Klaim
                    </h3>

                    <p>
                        Informasi kontak dan metode pengiriman barang terkait klaim.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="claim-detail-whatsapp-<?= esc($claim['id']) ?>"
                                class="form-label">

                                WhatsApp Klaim

                            </label>

                            <input
                                type="text"
                                id="claim-detail-whatsapp-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['whatsapp']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="claim-detail-delivery-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Metode Pengiriman

                            </label>

                            <input
                                type="text"
                                id="claim-detail-delivery-<?= esc($claim['id']) ?>"
                                class="form-input"
                                value="<?= esc($claim['delivery_method']) ?>"
                                readonly>

                        </div>

                    </div>


                    <?php if (! empty($claim['shipping_address'])): ?>

                        <div class="form-group">

                            <label
                                for="claim-detail-shipping-address-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Alamat Pengiriman

                            </label>

                            <textarea
                                id="claim-detail-shipping-address-<?= esc($claim['id']) ?>"
                                class="form-input"
                                rows="3"
                                readonly><?= esc($claim['shipping_address']) ?></textarea>

                        </div>

                    <?php endif; ?>


                    <div class="form-group">

                        <label
                            for="claim-detail-agreement-<?= esc($claim['id']) ?>"
                            class="form-label">

                            Persetujuan

                        </label>

                        <input
                            type="text"
                            id="claim-detail-agreement-<?= esc($claim['id']) ?>"
                            class="form-input"
                            value="<?= esc($claim['agreement']) ?>"
                            readonly>

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Bukti Kerusakan
                    </h3>

                    <p>
                        Dokumentasi yang dilampirkan pelanggan saat mengajukan klaim.
                    </p>

                </div>


                <div class="form-fields">


                    <div class="form-group">

                        <label class="form-label">
                            Foto Kerusakan
                        </label>

                        <?php if (! empty($claim['damage_photo_path'])): ?>

                            <div>
                                <a
                                    href="<?= esc(site_url(
                                                'admin/claims/' . $claim['id'] . '/evidence/photo'
                                            )) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer">

                                    <img
                                        src="<?= esc(site_url(
                                                    'admin/claims/' . $claim['id'] . '/evidence/photo'
                                                )) ?>"
                                        alt="Foto kerusakan klaim <?= esc($claim['claim_number']) ?>"
                                        loading="lazy"
                                        style="display:block; max-width:100%; max-height:320px; object-fit:contain; border-radius:12px;">

                                </a>
                            </div>

                            <span class="form-helper">
                                Klik foto untuk membukanya di tab baru.
                            </span>

                        <?php else: ?>

                            <div>
                                Tidak ada foto kerusakan.
                            </div>

                        <?php endif; ?>

                    </div>



                    <div class="form-group">

                        <label class="form-label">
                            Video Kerusakan
                        </label>

                        <?php if (! empty($claim['damage_video_path'])): ?>

                            <video
                                controls
                                preload="metadata"
                                style="display:block; width:100%; max-height:320px; border-radius:12px;">

                                <source
                                    src="<?= esc(site_url(
                                                'admin/claims/' . $claim['id'] . '/evidence/video'
                                            )) ?>">

                                Browser kamu tidak mendukung pemutaran video.

                            </video>

                        <?php else: ?>

                            <div>
                                Tidak ada video kerusakan.
                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <div class="form-section">

                <div class="form-section-heading">

                    <h3>
                        Timeline Klaim
                    </h3>

                    <p>
                        Riwayat perubahan status klaim yang tercatat di sistem.
                    </p>

                </div>


                <?php
                $history = $claimHistories ?? [];
                ?>


                <?php if (empty($history)): ?>

                    <div class="empty-state">

                        <p>
                            Belum ada riwayat perubahan klaim.
                        </p>

                    </div>

                <?php else: ?>

                    <div class="timeline">

                        <?php foreach ($history as $historyItem): ?>

                            <div class="timeline-item">

                                <div class="timeline-marker"></div>

                                <div class="timeline-content">

                                    <div class="timeline-header">

                                        <strong>
                                            <?= esc($historyItem['status']) ?>
                                        </strong>

                                        <span>
                                            <?= esc($historyItem['changed_at']) ?>
                                        </span>

                                    </div>


                                    <div class="timeline-user">

                                        <?php if (! empty($historyItem['user_name'])): ?>

                                            <?= esc($historyItem['user_name']) ?>

                                        <?php else: ?>

                                            Pembeli

                                        <?php endif; ?>

                                    </div>


                                    <?php if (! empty($historyItem['note'])): ?>

                                        <p>
                                            <?= esc($historyItem['note']) ?>
                                        </p>

                                    <?php endif; ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

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