<div
    class="modal"
    id="customer-delete-modal-<?= esc($customer['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>

    <div
        class="modal-dialog modal-dialog-small"
        role="dialog"
        aria-modal="true"
        aria-labelledby="customer-delete-title-<?= esc($customer['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <span class="modal-eyebrow">
                    Konfirmasi
                </span>

                <h2 id="customer-delete-title-<?= esc($customer['id']) ?>">
                    Hapus Pembeli?
                </h2>

                <p>
                    Apakah kamu yakin ingin menghapus data pembeli
                    <strong><?= esc($customer['name']) ?></strong>?
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

            <p class="delete-confirmation-text">

                Data pembeli akan dihapus dari daftar pembeli.

            </p>

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
                    class="button button-danger"
                    data-delete-confirm="customer-delete-form-<?= esc($customer['id']) ?>">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">

                        <path d="M3 6h18"></path>

                        <path d="M8 6V4h8v2"></path>

                        <path d="M19 6l-1 14H6L5 6"></path>

                        <path d="M10 11v5"></path>

                        <path d="M14 11v5"></path>

                    </svg>

                    Hapus Pembeli

                </button>

            </div>

        </div>

    </div>

</div>