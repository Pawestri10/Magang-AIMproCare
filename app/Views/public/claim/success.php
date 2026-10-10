<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="public-claim">
    <div class="public-claim-container">

        <div class="public-claim-card">

            <div class="public-claim-header">
                <span class="public-claim-label">
                    AIMPro Technology
                </span>

                <h1>Klaim Berhasil Diajukan</h1>

                <p>
                    Pengajuan klaim garansi Anda telah berhasil diterima.
                </p>
            </div>

            <div class="public-form-group">
                <label>Nomor Klaim</label>

                <input
                    type="text"
                    value="<?= esc($claim['claim_number']) ?>"
                    readonly>
            </div>

            <div class="public-form-group">
                <label>Status</label>

                <input
                    type="text"
                    value="<?= esc($claim['status']) ?>"
                    readonly>
            </div>

            <div class="public-form-group">
                <label>Tanggal Pengajuan</label>

                <input
                    type="text"
                    value="<?= esc($claim['created_at']) ?>"
                    readonly>
            </div>

            <div class="public-claim-actions">

                <a
                    href="<?= base_url('klaim-garansi/lacak/' . $trackingToken) ?>"
                    class="public-claim-action primary">
                    Lacak Status Klaim
                </a>

                <a
                    href="<?= base_url('cek-garansi') ?>"
                    class="public-claim-action secondary">
                    Cek Garansi
                </a>

            </div>

        </div>

    </div>
</section>

<?= $this->endSection() ?>