<?= $this->extend('layout/admin/indeks') ?>
<?= $this->section('content') ?>

<div class="div" ng-controller="laporanBantuanController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <button type="button" class="btn btn-success btn-sm mr-2" ng-click="downloadExcel()">
                    <i class="bi bi-file-earmark-excel-fill"></i> Excel
                </button>
                <button type="button" class="btn btn-secondary btn-sm" ng-click="cetak()">
                    <i class="bi bi-printer-fill"></i> Cetak
                </button>
                <span class="float-right">
                    <h4><strong>Total Penerima: {{laporan.length}}</strong></h4>
                </span>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Pilih Tipe Periode</label>
                    <select ng-model="filter.tipePeriode" ng-init="filter.tipePeriode='range'" class="form-control" ng-change="resetTanggal()">
                        <option value="range">Rentang Tanggal</option>
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                    </select>
                </div>

                <div class="form-group col-md-3" ng-if="filter.tipePeriode == 'range'">
                    <label>Rentang Tanggal</label>
                    <input type="text" id="tanggalRange" class="form-control" ng-change="filterLaporan()" ng-model="filter.tanggal_range" autocomplete="off" required>
                </div>

                <div class="form-group col-md-3" ng-if="filter.tipePeriode == 'bulan'">
                    <label>Pilih Bulan</label>
                    <input type="month" class="form-control" ng-change="filterLaporan()" ng-model="filter.bulan_tahun" required>
                </div>

                <div class="form-group col-md-3" ng-if="filter.tipePeriode == 'tahun'">
                    <label>Pilih Tahun</label>
                    <input type="number" class="form-control" ng-change="filterLaporan()" ng-model="filter.tahun" min="2000" max="2100" required>
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No. Daftar</th>
                            <th>Tanggal</th>
                            <th>Nama Mustahik</th>
                            <th>Jenis Bantuan</th>
                            <th>Status</th>
                            <th>Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in laporan track by $index">
                            <td>{{$index + 1}}</td>
                            <td>{{item.invoice}}</td>
                            <td>{{item.tanggal}}</td>
                            <td>{{item.nama_mustahik}}</td>
                            <td>{{item.nama_bantuan}}</td>
                            <td>{{item.status_pengajuan}}</td>
                            <td>
                                <!-- jadikan satu kolom -->
                                <span ng-repeat="r in item.rekomendasi">
                                    {{r.nama_kriteria}}: {{r.rekap}}<span ng-if="!$last">, </span>
                                </span>
                            </td>
                        </tr>
                        <tr ng-if="laporan.length === 0">
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Datepicker dan Daterangepicker -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<?= $this->endSection() ?>
