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
                <?= count($logs) ?>
            </div>

            <div class="activity-log-summary-description">
                Aktivitas yang tercatat dalam sistem.
            </div>
        </div>
    </div>
</div>

<div class="glass-card activity-log-card">
    <div class="activity-log-card-header">
        <div>
            <h2>Riwayat Aktivitas</h2>
            <p>Daftar aktivitas pengguna berdasarkan waktu terbaru.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table app-table activity-log-table">
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
                        ?>

                        <tr>
                            <td class="activity-log-column-number">
                                <?= $index + 1 ?>
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
</div>

<?= $this->endSection() ?>