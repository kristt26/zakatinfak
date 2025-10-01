<?= $this->extend('layout/admin/indeks') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h4 class="mb-4">Dashboard Muzaki</h4>

    <!-- Profil Muzaki -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Profil</div>
        <div class="card-body">
            <p><strong>Nama:</strong> <?= esc($muzaki['nama']) ?></p>
            <p><strong>Email:</strong> <?= esc($muzaki['email']) ?></p>
            <p><strong>Telepon:</strong> <?= esc($muzaki['telepon']) ?></p>
        </div>
    </div>

    <!-- Statistik Zakat -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Zakat Dibayarkan</h5>
                    <p class="card-text h4">Rp <?= number_format($total_zakat, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Zakat per Bulan -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">Grafik Pembayaran Zakat</div>
        <div class="card-body">
            <canvas id="chartMuzaki"></canvas>
        </div>
    </div>

    <!-- Riwayat Pembayaran -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Riwayat Pembayaran Terakhir</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Zakat</th>
                        <th>Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat as $row): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($row['tanggal_bayar'])) ?></td>
                            <td><?= esc($row['nama_kategori']) ?></td>
                            <td>Rp <?= number_format($row['jumlah_bayar'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chartMuzaki').getContext('2d');
    var chartMuzaki = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: [{
                label: 'Pembayaran Zakat',
                data: <?= $chart_data ?>,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<?= $this->endSection() ?>