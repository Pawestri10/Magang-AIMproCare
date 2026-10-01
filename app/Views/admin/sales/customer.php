<div
    class="modal"
    id="sales-customer-modal-<?= esc($unit['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>

    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="sales-customer-title-<?= esc($unit['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="sales-customer-title-<?= esc($unit['id']) ?>">
                    Data Pembeli
                </h2>

                <p>
                    Pilih pembeli yang terkait dengan transaksi unit ini.
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
                        Pilih Pembeli
                    </h3>

                    <p>
                        Data pembeli diambil dari Master Data Pembeli.
                    </p>

                </div>

                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="sales-customer-<?= esc($unit['id']) ?>"
                            class="form-label">

                            Pembeli

                        </label>

                        <select
                            id="sales-customer-<?= esc($unit['id']) ?>"
                            class="form-input sales-customer-select"
                            data-customer-select="<?= esc($unit['id']) ?>">

                            <option value="">
                                Pilih pembeli
                            </option>

                            <?php foreach ($customers as $customer): ?>

                                <option
                                    value="<?= esc($customer['id']) ?>"
                                    data-name="<?= esc($customer['name']) ?>"
                                    data-whatsapp="<?= esc($customer['whatsapp']) ?>"
                                    data-email="<?= esc($customer['email'] ?? '') ?>"
                                    data-address="<?= esc($customer['address']) ?>">

                                    <?= esc($customer['name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

            </div>


            <div
                class="form-section sales-customer-summary"
                id="sales-customer-summary-<?= esc($unit['id']) ?>"
                hidden>

                <div class="form-section-heading">

                    <h3>
                        Informasi Pembeli
                    </h3>

                    <p>
                        Data berikut diambil otomatis dari data pembeli.
                    </p>

                </div>

                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="sales-customer-name-<?= esc($unit['id']) ?>"
                            class="form-label">

                            Nama Pembeli

                        </label>

                        <input
                            type="text"
                            id="sales-customer-name-<?= esc($unit['id']) ?>"
                            class="form-input"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-customer-whatsapp-<?= esc($unit['id']) ?>"
                                class="form-label">

                                WhatsApp

                            </label>

                            <input
                                type="text"
                                id="sales-customer-whatsapp-<?= esc($unit['id']) ?>"
                                class="form-input"
                                readonly>

                        </div>

                        <div class="form-group">

                            <label
                                for="sales-customer-email-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Email

                            </label>

                            <input
                                type="text"
                                id="sales-customer-email-<?= esc($unit['id']) ?>"
                                class="form-input"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-customer-address-<?= esc($unit['id']) ?>"
                            class="form-label">

                            Alamat

                        </label>

                        <textarea
                            id="sales-customer-address-<?= esc($unit['id']) ?>"
                            class="form-input"
                            rows="3"
                            readonly></textarea>

                    </div>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <div class="modal-footer-actions">

                <button
                    type="button"
                    class="button button-secondary"
                    data-sales-customer-back
                    data-customer-back="sales-select-modal-<?= esc($unit['id']) ?>">

                    Kembali

                </button>

                <button
                    type="button"
                    class="button button-primary"
                    data-sales-customer-next
                    data-customer-unit="<?= esc($unit['id']) ?>"
                    data-sales-next="sales-transaction-modal-<?= esc($unit['id']) ?>"
                    disabled>

                    Berikutnya

                </button>

            </div>

        </div>

    </div>

</div>