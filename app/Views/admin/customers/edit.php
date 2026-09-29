<div class="modal" id="customer-edit-modal-<?= esc($customer['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="customer-edit-title-<?= esc($customer['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="customer-edit-title-<?= esc($customer['id']) ?>">
                    Edit Pembeli
                </h2>

                <p>
                    Perbarui informasi pembeli AIMpro Care.
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


        <form
            method="post"
            action="<?= site_url('admin/customers/' . $customer['id']) ?>"
            class="customer-form">

            <?= csrf_field() ?>


            <div class="modal-body">

                <div class="form-section">

                    <div class="form-section-heading">

                        <h3>
                            Informasi Pembeli
                        </h3>

                        <p>
                            Periksa dan perbarui informasi pembeli.
                        </p>

                    </div>


                    <div class="form-fields">

                        <div class="form-group">

                            <label
                                for="customer-edit-name-<?= esc($customer['id']) ?>"
                                class="form-label">

                                Nama Pembeli

                                <span class="form-required">
                                    *
                                </span>

                            </label>

                            <input
                                type="text"
                                id="customer-edit-name-<?= esc($customer['id']) ?>"
                                name="name"
                                class="form-input"
                                value="<?= old('name', $customer['name']) ?>"
                                maxlength="150"
                                placeholder="Contoh: Budi Santoso"
                                autocomplete="name"
                                required>

                            <span class="form-helper">
                                Gunakan nama pembeli sesuai data transaksi.
                            </span>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label
                                    for="customer-edit-whatsapp-<?= esc($customer['id']) ?>"
                                    class="form-label">

                                    WhatsApp

                                    <span class="form-required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="customer-edit-whatsapp-<?= esc($customer['id']) ?>"
                                    name="whatsapp"
                                    class="form-input"
                                    value="<?= old('whatsapp', $customer['whatsapp']) ?>"
                                    maxlength="25"
                                    placeholder="Contoh: 081234567890"
                                    autocomplete="tel"
                                    required>

                            </div>


                            <div class="form-group">

                                <label
                                    for="customer-edit-email-<?= esc($customer['id']) ?>"
                                    class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    id="customer-edit-email-<?= esc($customer['id']) ?>"
                                    name="email"
                                    class="form-input"
                                    value="<?= old('email', $customer['email']) ?>"
                                    maxlength="150"
                                    placeholder="Contoh: nama@email.com"
                                    autocomplete="email">

                                <span class="form-helper">
                                    Opsional.
                                </span>

                            </div>

                        </div>


                        <div class="form-group">

                            <label
                                for="customer-edit-address-<?= esc($customer['id']) ?>"
                                class="form-label">

                                Alamat

                                <span class="form-required">
                                    *
                                </span>

                            </label>

                            <textarea
                                id="customer-edit-address-<?= esc($customer['id']) ?>"
                                name="address"
                                class="form-input"
                                rows="4"
                                placeholder="Masukkan alamat lengkap pembeli"
                                autocomplete="street-address"
                                required><?= old('address', $customer['address']) ?></textarea>

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
                        type="submit"
                        class="button button-primary">

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>