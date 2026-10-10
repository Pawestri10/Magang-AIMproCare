<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Laporan</h1>
        <p>Rekap data operasional AIMpro Care berdasarkan database.</p>
    </div>
</div>

<div class="card">
    <div class="section-header">
        <h2>Filter Laporan</h2>
    </div>

    <form action="<?= site_url('admin/reports') ?>" method="get">
        <div class="report-filter-grid">
            <div class="form-group">
                <label for="type">Jenis Laporan</label>
                <select name="type" id="type" class="form-control">
                    <option value="qc"
                        <?= $filters['type'] === 'qc' ? 'selected' : '' ?>>
                        Rekap Pemeriksaan QC
                    </option>

                    <option value="units"
                        <?= $filters['type'] === 'units' ? 'selected' : '' ?>>
                        Unit Siap Dijual dan Terjual
                    </option>

                    <option value="warranties"
                        <?= $filters['type'] === 'warranties' ? 'selected' : '' ?>>
                        Garansi
                    </option>

                    <option value="claims"
                        <?= $filters['type'] === 'claims' ? 'selected' : '' ?>>
                        Klaim Garansi
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input
                    type="date"
                    name="start_date"
                    id="start_date"
                    class="form-control"
                    value="<?= esc($filters['start_date']) ?>">
            </div>

            <div class="form-group">
                <label for="end_date">Tanggal Akhir</label>
                <input
                    type="date"
                    name="end_date"
                    id="end_date"
                    class="form-control"
                    value="<?= esc($filters['end_date']) ?>">
            </div>

            <div class="form-group" id="officer-filter">
                <label for="officer_id">Petugas QC</label>
                <select
                    name="officer_id"
                    id="officer_id"
                    class="form-control">
                    <option value="">Semua Petugas</option>

                    <?php foreach ($officers as $officer): ?>
                        <option
                            value="<?= esc($officer['id']) ?>"
                            <?= (string) $filters['officer_id'] === (string) $officer['id'] ? 'selected' : '' ?>>
                            <?= esc($officer['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" id="result-filter">
                <label for="result">Hasil QC</label>
                <select name="result" id="result" class="form-control">
                    <option value="">Semua Hasil</option>
                    <?php foreach (
                        [
                            'Lolos QC',
                            'Tidak Lolos QC',
                            'Perlu Pemeriksaan Ulang',
                        ] as $result
                    ): ?>
                        <option
                            value="<?= esc($result) ?>"
                            <?= $filters['result'] === $result ? 'selected' : '' ?>>
                            <?= esc($result) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" id="unit-status-filter">
                <label for="unit_status">Status Unit</label>
                <select
                    name="unit_status"
                    id="unit_status"
                    class="form-control">
                    <option value="">Semua Status</option>
                    <?php foreach (['Siap Dijual', 'Terjual'] as $status): ?>
                        <option
                            value="<?= esc($status) ?>"
                            <?= $filters['unit_status'] === $status ? 'selected' : '' ?>>
                            <?= esc($status) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" id="warranty-status-filter">
                <label for="warranty_status">Status Garansi</label>
                <select
                    name="warranty_status"
                    id="warranty_status"
                    class="form-control">
                    <option value="">Semua Garansi</option>
                    <option value="aktif"
                        <?= $filters['warranty_status'] === 'aktif' ? 'selected' : '' ?>>
                        Aktif
                    </option>
                    <option value="berakhir"
                        <?= $filters['warranty_status'] === 'berakhir' ? 'selected' : '' ?>>
                        Berakhir
                    </option>
                </select>
            </div>

            <div class="form-group" id="claim-status-filter">
                <label for="claim_status">Status Klaim</label>
                <select name="claim_status" id="claim_status" class="form-control">
                    <option value="">Semua Status</option>
                    <?php foreach (
                        [
                            'Pengajuan Baru',
                            'Sedang Diverifikasi',
                            'Klaim Diterima',
                            'Klaim Ditolak',
                            'Barang Diterima',
                            'Sedang Diperiksa',
                            'Sedang Diproses',
                            'Selesai',
                        ] as $status
                    ): ?>
                        <option
                            value="<?= esc($status) ?>"
                            <?= $filters['claim_status'] === $status ? 'selected' : '' ?>>
                            <?= esc($status) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="report-actions">
            <button type="submit" class="btn btn-primary">
                Terapkan Filter
            </button>

            <a href="<?= site_url('admin/reports') ?>" class="btn">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="card">
    <div class="section-header report-result-header">
        <div>
            <h2><?= esc($reportTitle) ?></h2>
            <p><?= count($rows) ?> data ditemukan</p>
        </div>

        <div class="report-actions">
            <a
                href="<?= site_url('admin/reports/export/excel?' . http_build_query($filters)) ?>"
                class="btn">
                Export Excel
            </a>

            <a
                href="<?= site_url('admin/reports/export/pdf?' . http_build_query($filters)) ?>"
                class="btn"
                target="_blank"
                rel="noopener">
                Cetak PDF
            </a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th><?= esc($column['label']) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($rows)): ?>
                    <tr>
                        <td
                            colspan="<?= count($columns) ?>"
                            class="empty-state">
                            Tidak ada data untuk filter yang dipilih.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <td>
                                    <?= esc($row[$column['key']] ?? '-') ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');

        const filterGroups = {
            qc: ['officer-filter', 'result-filter'],
            units: ['unit-status-filter'],
            warranties: ['warranty-status-filter'],
            claims: ['claim-status-filter']
        };

        const allFilterIds = Object.values(filterGroups).flat();

        function updateFilters() {
            const selectedType = typeSelect.value;

            allFilterIds.forEach(function(id) {
                const element = document.getElementById(id);
                const visible = (filterGroups[selectedType] || []).includes(id);

                element.hidden = !visible;

                element.querySelectorAll('select, input').forEach(function(input) {
                    input.disabled = !visible;
                });
            });
        }

        typeSelect.addEventListener('change', updateFilters);
        updateFilters();
    });
</script>

<?= $this->endSection() ?>