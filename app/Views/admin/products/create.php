<div class="modal" id="product-create-modal">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="product-create-title">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="product-create-title">
                    Tambah Produk
                </h2>

                <p>
                    Masukkan informasi produk yang akan digunakan
                    dalam sistem AIMpro Care.
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
            action="<?= site_url('admin/products') ?>"
            class="product-form">

            <?= csrf_field() ?>


            <div class="modal-body">

                <div class="form-section">

                    <div class="form-section-heading">

                        <h3>
                            Informasi Produk
                        </h3>

                        <p>
                            Lengkapi identitas dasar produk.
                        </p>

                    </div>


                    <div class="form-fields">

                        <div class="form-group">

                            <label
                                for="product-name"
                                class="form-label">

                                Nama Produk

                                <span class="form-required">
                                    *
                                </span>

                            </label>

                            <input
                                type="text"
                                id="product-name"
                                name="name"
                                class="form-input"
                                value="<?= old('name') ?>"
                                maxlength="150"
                                placeholder="Contoh: Laptop ASUS Vivobook 14"
                                autocomplete="off"
                                required>

                            <span class="form-helper">
                                Gunakan nama produk yang mudah dikenali.
                            </span>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label
                                    for="product-brand"
                                    class="form-label">

                                    Brand

                                    <span class="form-required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="product-brand"
                                    name="brand"
                                    class="form-input"
                                    value="<?= old('brand') ?>"
                                    maxlength="100"
                                    placeholder="Contoh: ASUS"
                                    autocomplete="organization"
                                    required>

                            </div>


                            <div class="form-group">

                                <label
                                    for="product-model"
                                    class="form-label">

                                    Model

                                    <span class="form-required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="product-model"
                                    name="model"
                                    class="form-input"
                                    value="<?= old('model') ?>"
                                    maxlength="100"
                                    placeholder="Contoh: X1404ZA"
                                    autocomplete="off"
                                    required>

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
                        type="submit"
                        class="button button-primary">

                        Simpan Produk

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>