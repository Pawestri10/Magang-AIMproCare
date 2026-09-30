<div
    class="modal"
    id="sales-select-modal-<?= esc($unit['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="sales-select-title-<?= esc($unit['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="sales-select-title-<?= esc($unit['id']) ?>">
                    Pilih Unit
                </h2>

                <p>
                    Periksa unit yang akan diproses untuk penjualan.
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
                        Informasi Unit
                    </h3>

                    <p>
                        Data produk dan nomor serial diambil otomatis dari unit hasil QC.
                    </p>

                </div>


                <div class="form-fields">

                    <div class="form-group">

                        <label
                            for="sales-product-<?= esc($unit['id']) ?>"
                            class="form-label">

                            Produk

                        </label>

                        <input
                            type="text"
                            id="sales-product-<?= esc($unit['id']) ?>"
                            class="form-input"
                            value="<?= esc($unit['product_name']) ?>"
                            readonly>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="sales-brand-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Brand

                            </label>

                            <input
                                type="text"
                                id="sales-brand-<?= esc($unit['id']) ?>"
                                class="form-input"
                                value="<?= esc($unit['brand']) ?>"
                                readonly>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-model-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Model

                            </label>

                            <input
                                type="text"
                                id="sales-model-<?= esc($unit['id']) ?>"
                                class="form-input"
                                value="<?= esc($unit['model']) ?>"
                                readonly>

                        </div>

                    </div>


                    <div class="form-group">

                        <label
                            for="sales-serial-<?= esc($unit['id']) ?>"
                            class="form-label">

                            Nomor Serial

                        </label>

                        <input
                            type="text"
                            id="sales-serial-<?= esc($unit['id']) ?>"
                            class="form-input"
                            value="<?= esc($unit['serial_number']) ?>"
                            readonly>

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Status
                        </label>

                        <div>

                            <span class="badge badge-success">
                                <?= esc($unit['status']) ?>
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <div class="modal-footer-actions">

                <button
                    type="button"
                    class="button button-secondary"
                    data-modal-close>

                    Batal

                </button>


                <button
                    type="button"
                    class="button button-primary"
                    data-modal-close>

                    Pilih Unit

                </button>

            </div>

        </div>

    </div>

</div>