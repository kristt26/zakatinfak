<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="pembayaranMustahikController">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2 text-right">
                    <a href="/mustahik/pembayaran/tambah_pembayaran" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Pengajuan</a>
                </div>
                <div class="table-responsive">
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pembayaran</th>
                                <th>Tanggal Bayar</th>
                                <th>Kategori ZIS</th>
                                <th>Nominal Bayar</th>
                                <th>Bukti Bayar</th>
                                <th>Status Bayar</th>
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas" ng-class="{'bg-warning text-white': item.pesan, 'bg-info text-white' : !item.pesan && item.status_transaksi != 'ditolak' && item.status_transaksi != 'valid', 'bg-success text-white' : item.status_transaksi == 'valid', 'bg-danger text-white' : item.status_transaksi == 'ditolak'}">
                                <td>{{$index+1}}</td>
                                <td>{{item.no_bayar}}</td>
                                <td>{{item.tanggal_bayar}}</td>
                                <td>{{item.nama_kategori}}</td>
                                <td>{{item.jumlah_bayar | currency: 'Rp. '}}</td>
                                <td>
                                    <a ng-attr-href="/assets/berkas/{{item.bukti_bayar}}"
                                        data-lightbox="bukti-bayar"
                                        data-title="Bukti Bayar {{item.no_bayar}}">
                                        Lihat Bukti
                                    </a>
                                </td>
                                <td bs-tooltip title="{{item.pesan ? item.pesan : 'Tombol edit akan tampil saat pengajuan di kembalikan'}}">{{item.pesan ? 'Dikembalikan' : item.status_transaksi}}</td>
                                <td>
                                    <button  ng-show="item.status_transaksi=='ditolak'" class="btn btn-secondary btn-sm" ng-click="model.id = item.id; model.bukti_bayar = item.bukti_bayar" data-toggle="modal" data-target="#modelId"><i class="fas fa-upload"></i></button>
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
                    <h5 class="modal-title">Upload ulang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <label class="form-label d-block mb-2">Upload ulang bukti bayar</label>
                        <label class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                            <i class="fas fa-upload me-3"></i>&nbsp;
                            <input type="file" class="form-control" id="customFile" ng-model="model.berkas" base-sixty-four-input required>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-primary" ng-click="update()">Upload</button>
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