<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="daftarPengajuanController">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                    <!-- Judul Seksi -->
                    <h4 class="fw-bold mb-3 bg-primary p-2 text-white">Pendaftaran</h4>
                    <!-- Baris 1: No Pendaftaran | Jenis Infak -->
                    <div class="form-group row mb-2 align-items-center">
                        <label for="no_pendaftaran" class="col-sm-2 col-form-label-sm">No Pendaftaran</label>
                        <div class="col-sm-4">
                            <input type="text" id="no_pendaftaran" class="form-control form-control-sm"
                                ng-model="datas.pengajuan.no_daftar" readonly>
                        </div>

                        <label for="jenis_bantuan" class="col-sm-2 col-form-label-sm text-end">Jenis Bantuan</label>
                        <div class="col-sm-4">
                            <input type="text" id="jenis_bantuan" class="form-control form-control-sm"
                                ng-model="datas.bantuan.nama_bantuan" readonly>
                        </div>
                    </div>

                    <!-- Baris 2: Nama Mustahik | NIK -->
                    <div class="form-group row mb-2 align-items-center">
                        <label for="nama_mustahik" class="col-sm-2 col-form-label-sm">Nama Mustahik</label>
                        <div class="col-sm-4">
                            <input type="text" id="nama_mustahik" class="form-control form-control-sm"
                                ng-model="datas.biodata.nama" required readonly>
                        </div>

                        <label for="nik" class="col-sm-2 col-form-label-sm text-end">NIK</label>
                        <div class="col-sm-4">
                            <input type="text" id="nik" class="form-control form-control-sm"
                                ng-model="datas.biodata.nik" readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-2 align-items-center">
                        <label for="pekerjaan" class="col-sm-2 col-form-label-sm">Pekerjaan</label>
                        <div class="col-sm-4">
                            <input type="text" id="pekerjaan" class="form-control form-control-sm"
                                ng-model="datas.biodata.pekerjaan" readonly>
                        </div>

                        <label for="penghasilan" class="col-sm-2 col-form-label-sm">Penghasilan</label>
                        <div class="col-sm-4">
                            <input type="text" id="penghasilan" class="form-control form-control-sm"
                                ng-model="datas.biodata.penghasilan" readonly>
                        </div>
                    </div>

                    <!-- Alasan (textarea full width) -->
                    <div class="form-group mb-3">
                        <label for="alasan" class="col-form-label-sm">Alasan</label>
                        <textarea id="alasan" class="form-control form-control-sm" ng-model="datas.pengajuan.alasan" rows="4"
                            placeholder="Tuliskan alasan pengajuan bantuan..." readonly></textarea>
                    </div>

                    <hr>

                    <!-- Kelengkapan Berkas -->
                    <h6 class="fw-bold mb-3 bg-primary p-2 text-white">Kelengkapan Berkas</h6>

                    <div class="row mb-3">
                        <!-- Berkas 1 -->
                        <div class="col-md-4 text-center" ng-repeat="item in datas.bantuan.persyaratan">
                            <label class="form-label d-block mb-2">{{item.nama_persyaratan}}</label>
                            <label class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-upload me-3"></i>&nbsp;
                                <a href="<?= base_url()?>/assets/berkas/{{item.file}}" target="_blank">Berkas</a>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol aksi (kanan) -->
                    <div class="form-group row mt-4">
                        <div class="col-sm-12 offset-sm-5 text-end">
                            <button type="button" class="btn btn-sm btn-success" ng-click="update('diverifikasi')">
                                <i class="fas fa-paper-plane me-1"></i> Valid
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modelId">
                                <i class="fas fa-times me-1"></i> Tidak Valid
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
                    <textarea id="alasan" class="form-control form-control-sm" ng-model="datas.pengajuan.pesan" rows="4"
                            placeholder="Tinggalkan pesan perbaikan disini"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="update('diajukan')">Tolak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>