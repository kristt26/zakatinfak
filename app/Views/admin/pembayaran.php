<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="daftarPembayaranController">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pembayaran</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Kategori ZIS</th>
                                <th>Jumlah Bayar</th>
                                <th>Bukti Bayar</th>
                                <th>Status Pengajuan</th>
                                <th width="10%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas" ng-class="{
    'bg-warning text-white': item.pesan,
    'bg-success text-white' : item.status_transaksi == 'valid',
    'bg-danger text-white' : item.status_transaksi == 'ditolak'
}">
                                <td>{{$index+1}}</td>
                                <td>{{item.no_bayar}}</td>
                                <td>{{ item.nama_muzaki || item.nama_mustahik }}</td>
                                <td>{{ item.telepon_muzaki || item.telepon_mustahik }}</td>
                                <td>{{item.nama_kategori}}</td>
                                <td>{{item.jumlah_bayar | currency: 'Rp. '}}</td>
                                <td>
                                    <a ng-attr-href="/assets/berkas/{{item.bukti_bayar}}"
                                        data-lightbox="bukti-bayar"
                                        data-title="Bukti Bayar {{item.no_bayar}}">
                                        Lihat Bukti
                                    </a>
                                </td>
                                <td bs-tooltip title="{{item.pesan ? item.pesan : ''}}">{{item.pesan ? 'Dikembalikan' : item.status_transaksi}}</td>
                                <td>
                                    <button ng-show="item.status_transaksi == 'pending'" class="btn btn-sm btn-info" ng-click="update('valid', item.id)"><i class="fas fa-check-circle"></i></button>
                                    <button ng-show="item.status_transaksi == 'pending'" class="btn btn-sm btn-danger" ng-click="model.id = item.id" data-toggle="modal" data-target="#modelId"><i class="fas fa-times-circle"></i></button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tinggalkan Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea id="alasan" class="form-control form-control-sm" ng-model="model.pesan" rows="4"
                        placeholder="Tinggalkan pesan perbaikan disini"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="update('ditolak')">Tolak</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
</div>
<?= $this->endSection() ?>