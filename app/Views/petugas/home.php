<?= $this->extend('layout/admin/indeks') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-4">Dashboard Petugas</h3>

    <!-- Statistik Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h5>Total Survey</h5>
                    <h2><?= esc($statistik['total_survey']) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h5>Tervalidasi</h5>
                    <h2><?= esc($statistik['tervalidasi']) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body text-center">
                    <h5>Belum Validasi</h5>
                    <h2><?= esc($statistik['belum_validasi']) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body text-center">
                    <h5>Ditolak</h5>
                    <h2><?= esc($statistik['ditolak']) ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong>Distribusi Status Validasi</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartValidasi"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong>Validasi per Jenis Bantuan</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartJenisBantuan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Belum Validasi -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-light">
            <strong>Daftar Pendaftaran Belum Divalidasi</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mustahik</th>
                        <th>Alamat</th>
                        <th>Jenis Bantuan</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($survey)): ?>
                        <?php $no = 1; foreach ($survey as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($row['nama_mustahik']) ?></td>
                                <td><?= esc($row['alamat']) ?></td>
                                <td><?= esc($row['nama_bantuan']) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_daftar'])) ?></td>
                                <td><span class="badge badge-warning"><?= esc($row['status_pengajuan']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart Validasi
    const ctx1 = document.getElementById('chartValidasi').getContext('2d');
    new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['Tervalidasi', 'Belum Validasi', 'Ditolak'],
            datasets: [{
                data: [
                    <?= $chart_validasi['tervalidasi'] ?>,
                    <?= $chart_validasi['belum_validasi'] ?>,
                    <?= $chart_validasi['ditolak'] ?>
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true
        }
    });

    // Bar Chart per Jenis Bantuan
    const ctx2 = document.getElementById('chartJenisBantuan').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: <?= $chart_labels_bantuan ?>,
            datasets: [{
                label: 'Jumlah Tervalidasi',
                data: <?= $chart_data_tervalidasi ?>,
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

<?= $this->endSection() ?>
