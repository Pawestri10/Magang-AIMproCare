<div class="modal" id="product-edit-modal-<?= esc($product['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="product-edit-title-<?= esc($product['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="product-edit-title-<?= esc($product['id']) ?>">
                    Edit Produk
                </h2>

                <p>
                    Perbarui informasi produk AIMpro Care.
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
            action="<?= site_url('admin/products/' . $product['id']) ?>"
            class="product-form">

            <?= csrf_field() ?>


            <div class="modal-body">

                <div class="form-section">

                    <div class="form-section-heading">

                        <h3>
                            Informasi Produk
                        </h3>

                        <p>
                            Periksa dan perbarui identitas produk.
                        </p>

                    </div>


                    <div class="form-fields">

                        <div class="form-group">

                            <label
                                for="product-edit-name-<?= esc($product['id']) ?>"
                                class="form-label">

                                Nama Produk

                                <span class="form-required">
                                    *
                                </span>

                            </label>

                            <input
                                type="text"
                                id="product-edit-name-<?= esc($product['id']) ?>"
                                name="name"
                                class="form-input"
                                value="<?= old('name', $product['name']) ?>"
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
                                    for="product-edit-brand-<?= esc($product['id']) ?>"
                                    class="form-label">

                                    Brand

                                    <span class="form-required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="product-edit-brand-<?= esc($product['id']) ?>"
                                    name="brand"
                                    class="form-input"
                                    value="<?= old('brand', $product['brand']) ?>"
                                    maxlength="100"
                                    placeholder="Contoh: ASUS"
                                    autocomplete="organization"
                                    required>

                            </div>


                            <div class="form-group">

                                <label
                                    for="product-edit-model-<?= esc($product['id']) ?>"
                                    class="form-label">

                                    Model

                                    <span class="form-required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="product-edit-model-<?= esc($product['id']) ?>"
                                    name="model"
                                    class="form-input"
                                    value="<?= old('model', $product['model']) ?>"
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

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>