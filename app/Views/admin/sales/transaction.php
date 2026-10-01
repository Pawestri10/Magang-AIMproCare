<div
    class="modal"
    id="sales-transaction-modal-<?= esc($unit['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>

    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="sales-transaction-title-<?= esc($unit['id']) ?>">

        <form
            action="<?= site_url('admin/sales') ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <input
                type="hidden"
                name="product_unit_id"
                value="<?= esc($unit['id']) ?>">

            <input
                type="hidden"
                name="customer_id"
                id="sales-transaction-customer-<?= esc($unit['id']) ?>">

            <div class="modal-header">

                <div class="modal-heading">

                    <h2 id="sales-transaction-title-<?= esc($unit['id']) ?>">
                        Data Transaksi
                    </h2>

                    <p>
                        Lengkapi data transaksi penjualan unit.
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
                            Informasi Transaksi
                        </h3>

                        <p>
                            Data berikut digunakan untuk mencatat transaksi penjualan unit.
                        </p>

                    </div>


                    <div class="form-fields">

                        <div class="form-group">

                            <label
                                for="sales-purchase-date-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Tanggal Pembelian
                                <span class="required-mark">*</span>

                            </label>

                            <input
                                type="date"
                                id="sales-purchase-date-<?= esc($unit['id']) ?>"
                                name="purchase_date"
                                class="form-input"
                                required>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-invoice-number-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Invoice / Nota
                                <span class="required-mark">*</span>

                            </label>

                            <input
                                type="text"
                                id="sales-invoice-number-<?= esc($unit['id']) ?>"
                                name="invoice_number"
                                class="form-input"
                                maxlength="100"
                                placeholder="Masukkan nomor invoice atau nota"
                                required>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-purchase-location-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Marketplace / Lokasi Pembelian
                                <span class="required-mark">*</span>

                            </label>

                            <input
                                type="text"
                                id="sales-purchase-location-<?= esc($unit['id']) ?>"
                                name="purchase_location"
                                class="form-input"
                                maxlength="150"
                                placeholder="Contoh: Shopee atau Toko AIMpro"
                                required>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-marketplace-order-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Nomor Order Marketplace

                            </label>

                            <input
                                type="text"
                                id="sales-marketplace-order-<?= esc($unit['id']) ?>"
                                name="marketplace_order_number"
                                class="form-input"
                                maxlength="100"
                                placeholder="Opsional">

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label
                                    for="sales-warranty-duration-<?= esc($unit['id']) ?>"
                                    class="form-label">

                                    Durasi Garansi
                                    <span class="required-mark">*</span>

                                </label>

                                <div class="form-row">

                                    <input
                                        type="number"
                                        id="sales-warranty-duration-<?= esc($unit['id']) ?>"
                                        name="warranty_duration"
                                        class="form-input"
                                        min="1"
                                        step="1"
                                        placeholder="Durasi"
                                        required>

                                    <select
                                        id="sales-warranty-duration-unit-<?= esc($unit['id']) ?>"
                                        name="warranty_duration_unit"
                                        class="form-input"
                                        required>

                                        <option value="">
                                            Satuan
                                        </option>

                                        <option value="Bulan">
                                            Bulan
                                        </option>

                                        <option value="Tahun">
                                            Tahun
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="form-group">

                                <label
                                    for="sales-warranty-start-date-<?= esc($unit['id']) ?>"
                                    class="form-label">

                                    Tanggal Mulai Garansi
                                    <span class="required-mark">*</span>

                                </label>

                                <input
                                    type="date"
                                    id="sales-warranty-start-date-<?= esc($unit['id']) ?>"
                                    name="warranty_start_date"
                                    class="form-input"
                                    required>

                            </div>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-purchase-receipt-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Nota Pembelian

                            </label>

                            <input
                                type="file"
                                id="sales-purchase-receipt-<?= esc($unit['id']) ?>"
                                name="purchase_receipt"
                                class="form-input"
                                accept=".jpg,.jpeg,.png,.pdf">

                            <p class="form-help">
                                Opsional. Format JPG, PNG, atau PDF.
                            </p>

                        </div>


                        <div class="form-group">

                            <label
                                for="sales-notes-<?= esc($unit['id']) ?>"
                                class="form-label">

                                Catatan

                            </label>

                            <textarea
                                id="sales-notes-<?= esc($unit['id']) ?>"
                                name="notes"
                                class="form-input"
                                rows="3"
                                placeholder="Opsional"></textarea>

                        </div>

                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <div class="modal-footer-actions">

                    <button
                        type="button"
                        class="button button-secondary"
                        data-sales-transaction-back
                        data-transaction-unit="<?= esc($unit['id']) ?>"
                        data-sales-back="sales-customer-modal-<?= esc($unit['id']) ?>">

                        Kembali

                    </button>

                    <button
                        type="submit"
                        class="button button-primary">

                        Simpan Transaksi

                    </button>

                </div>

            </div>
        </form>
    </div>

</div>