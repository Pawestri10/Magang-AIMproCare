<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Activity Log</h1>
        <p>Riwayat aktivitas pengguna dalam sistem.</p>
    </div>
</div>

<div class="activity-log-summary">
    <div class="glass-card activity-log-summary-card">
        <div class="activity-log-summary-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                aria-hidden="true">
                <path d="M12 8v4l2.5 2.5"></path>
                <circle cx="12" cy="12" r="8.5"></circle>
            </svg>
        </div>

        <div>
            <div class="activity-log-summary-label">
                Total Aktivitas
            </div>

            <div class="activity-log-summary-value">
                <?= $totalLogs ?>
            </div>

            <div class="activity-log-summary-description">
                Aktivitas yang tercatat dalam sistem.
            </div>
        </div>
    </div>
</div>



<form action="<?= site_url('admin/activity-log') ?>" method="get" class="search-filter-panel report-search-panel activity-log-search-panel">

    <div class="search-filter-fields report-filter-grid">

        <div class="form-group">
            <label for="search">Cari Aktivitas</label>

            <div class="search-input-wrapper">
                <svg
                    class="search-input-icon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="19"
                    height="19"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-4-4" />
                </svg>

                <input
                    type="search"
                    id="search"
                    name="search"
                    value="<?= esc($search ?? '') ?>"
                    class="form-control search-input"
                    placeholder="Cari nama pengguna, aktivitas, atau deskripsi">
            </div>
        </div>

        <div class="form-group">
            <label for="action">Jenis Aktivitas</label>
            <select id="action" name="action" class="form-control">
                <option value="">Semua Aktivitas</option>
                <?php foreach ($allowedActions as $item): ?>
                    <option
                        value="<?= esc($item['action']) ?>"
                        <?= ($action ?? '') === $item['action'] ? 'selected' : '' ?>>
                        <?= esc($item['action']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input
                type="date"
                id="start_date"
                name="start_date"
                class="form-control"
                value="<?= esc($startDate ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Akhir</label>
            <input
                type="date"
                id="end_date"
                name="end_date"
                class="form-control"
                value="<?= esc($endDate ?? '') ?>">
        </div>

    </div>


    <div class="search-filter-actions report-filter-actions">
        <button type="submit" class="button button-primary search-submit-button">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="17"
                height="17"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true">
                <circle cx="11" cy="11" r="7" />
                <path d="m20 20-4-4" />
            </svg>
            <span>Cari</span>
        </button>

        <a href="<?= site_url('admin/activity-log') ?>" class="btn search-reset-button">
            Reset
        </a>
    </div>
</form>

<div class="card">
    <div class="section-header activity-log-card-header">
        <div>
            <h2>Riwayat Aktivitas</h2>
            <p>Daftar aktivitas pengguna berdasarkan waktu terbaru.</p>
        </div>
    </div>

    <div class="activity-log-card">

        <div class="activity-log-table-wrapper">
            <table class="data-table activity-log-table">
                <thead>
                    <tr>
                        <th class="activity-log-column-number">No</th>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($logs)): ?>

                        <?php foreach ($logs as $index => $log): ?>

                            <?php
                            $timestamp = strtotime($log['created_at']);
                            $number = ($pager->getCurrentPage() - 1) * 10 + $index + 1;
                            ?>

                            <tr>
                                <td class="activity-log-column-number">
                                    <?= $number ?>
                                </td>

                                <td>
                                    <div class="activity-log-time">
                                        <span class="activity-log-date">
                                            <?= esc(date('d M Y', $timestamp)) ?>
                                        </span>

                                        <span class="activity-log-clock">
                                            <?= esc(date('H:i:s', $timestamp)) ?>
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="activity-log-user">
                                        <div class="activity-log-user-icon">
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true">
                                                <circle cx="12" cy="8" r="3"></circle>
                                                <path d="M5.5 19c.8-3.1 3-4.7 6.5-4.7s5.7 1.6 6.5 4.7"></path>
                                            </svg>
                                        </div>

                                        <span>
                                            <?= esc($log['user_name']) ?>
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <span class="activity-log-action activity-log-action-<?= strtolower(esc($log['action'])) ?>">
                                        <?= esc($log['action']) ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="activity-log-description">
                                        <?= esc($log['description']) ?>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-title">
                                        Belum ada aktivitas.
                                    </div>

                                    <div class="empty-state-description">
                                        Belum terdapat aktivitas pengguna yang tercatat dalam sistem.
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?= view('components/pagination', [
            'pager' => $pager,
            'total' => $totalLogs,
            'perPage' => 10,
        ]) ?>

    </div>

</div>

<?= $this->endSection() ?>