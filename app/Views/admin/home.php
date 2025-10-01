<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">

                <!-- Judul -->
                <h4 class="fw-bold mb-3 bg-primary p-2 text-white">Dashboard Admin</h4>

                <!-- Statistik Card -->
                <div class="row text-white">
                    <div class="col-md-3 mb-3">
                        <div class="card bg-primary">
                            <div class="card-body text-center">
                                <h6>Total Mustahik</h6>
                                <h3><?= $statistik['mustahik'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-success">
                            <div class="card-body text-center">
                                <h6>Total Muzaki</h6>
                                <h3><?= $statistik['muzaki'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-warning">
                            <div class="card-body text-center">
                                <h6>Zakat Masuk</h6>
                                <h3>Rp <?= number_format($statistik['zakat'], 0, ',', '.') ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-danger">
                            <div class="card-body text-center">
                                <h6>Pendaftaran</h6>
                                <h3><?= $statistik['pendaftaran'] ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Grafik -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                Distribusi ZIS
                            </div>
                            <div class="card-body">
                                <canvas id="chartZakat"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                Distribusi Penerima Bantuan
                            </div>
                            <div class="card-body">
                                <canvas id="chartBantuan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Tabel Ringkas -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">Pendaftaran Terbaru</div>
                            <div class="card-body">
                                <table class="table table-xs table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mustahik</th>
                                            <th>Jenis Bantuan</th>
                                            <th>Tanggal Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($pendaftaran as $p): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= esc($p['nama']) ?></td>
                                                <td><?= esc($p['nama_bantuan']) ?></td>
                                                <td><?= esc($p['tanggal_daftar']) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header bg-warning text-white">Transaksi ZIS Terakhir</div>
                            <div class="card-body">
                                <table class="table table-xs table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Bayar</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($zakat as $z): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= esc($z['no_bayar']) ?></td>
                                                <td><?= is_null($z['id_muzaki']) ? esc($z['nama_mustahik']) : esc($z['nama_muzaki']) ?></td>
                                                <td>Rp <?= number_format($z['jumlah_bayar'], 0, ',', '.') ?></td>
                                                <td><?= esc($z['nama_kategori']) ?></td>
                                                <td><?= esc($z['tanggal_bayar']) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx2 = document.getElementById('chartBantuan').getContext('2d');
    var chartBantuan = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: <?= $chart_labels_bantuan ?>, // dari controller
            datasets: [{
                label: 'Jumlah Penerima',
                data: <?= $chart_data_bantuan ?>, // dari controller
                backgroundColor: '#17a2b8'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { // Chart.js v3+
                    beginAtZero: true
                }
            }
        }
    });

    var ctx1 = document.getElementById('chartZakat').getContext('2d');
    var chartZakat = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: <?= $chart_labels_zakat ?>,
            datasets: [{
                data: <?= $chart_data_zakat ?>,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<?= $this->endSection() ?>