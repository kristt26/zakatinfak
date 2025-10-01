<?= $this->extend('layout/admin/indeks') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h4 class="mb-4">Dashboard Mustahik</h4>

    <!-- Profil Mustahik -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Profil Saya</div>
        <div class="card-body">
            <p><strong>Nama:</strong> <?= esc($mustahik['nama']) ?></p>
            <p><strong>NIK:</strong> <?= esc($mustahik['nik']) ?></p>
            <p><strong>Pekerjaan:</strong> <?= esc($mustahik['pekerjaan']) ?></p>
            <p><strong>Penghasilan:</strong> Rp <?= number_format($mustahik['penghasilan'],0,',','.') ?></p>
        </div>
    </div>

    <!-- Status Pengajuan Terakhir -->
    <?php if ($pengajuan_terakhir): ?>
    <div class="alert 
        <?= $pengajuan_terakhir['status_pengajuan'] == 'diverifikasi' ? 'alert-success' : 
            ($pengajuan_terakhir['status_pengajuan'] == 'ditolak' ? 'alert-danger' : 'alert-warning') ?>">
        Status pengajuan terakhir: <strong><?= ucfirst($pengajuan_terakhir['status_pengajuan']) ?></strong>
        (<?= date('d-m-Y', strtotime($pengajuan_terakhir['tanggal_daftar'])) ?>)
    </div>
    <?php endif; ?>

    <!-- Grafik Penerimaan Bantuan -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">Grafik Penerimaan Bantuan per Tahun</div>
        <div class="card-body">
            <canvas id="chartMustahik"></canvas>
        </div>
    </div>

    <!-- Riwayat Pengajuan -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Riwayat Pengajuan Terakhir</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Bantuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($riwayat as $row): ?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($row['tanggal_daftar'])) ?></td>
                        <td><?= esc($row['nama_bantuan']) ?></td>
                        <td>
                            <span class="badge 
                                <?= $row['status_pengajuan'] == 'diverifikasi' ? 'badge-success' : 
                                    ($row['status_pengajuan'] == 'ditolak' ? 'badge-danger' : 'badge-warning') ?>">
                                <?= ucfirst($row['status_pengajuan']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chartMustahik').getContext('2d');
    var chartMustahik = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: [{
                label: 'Jumlah Bantuan Diterima',
                data: <?= $chart_data ?>,
                backgroundColor: '#28a745'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>

<?= $this->endSection() ?>
