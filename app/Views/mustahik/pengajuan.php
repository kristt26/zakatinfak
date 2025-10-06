<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="pengajuanController">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <!-- Judul Seksi -->
                    <h4 class="fw-bold mb-3 bg-primary p-2 text-white">Pendaftaran</h4>
                    <!-- Baris 1: No Pendaftaran | Jenis Infak -->
                    <div class="form-group row mb-2 align-items-center">
                        <label for="no_pendaftaran" class="col-sm-2 col-form-label-sm">No Pendaftaran</label>
                        <div class="col-sm-4">
                            <input type="text" id="no_pendaftaran" class="form-control form-control-sm"
                                ng-model="model.no_daftar" readonly>
                        </div>

                        <label for="jenis_bantuan" class="col-sm-2 col-form-label-sm text-end">Jenis Bantuan</label>
                        <div class="col-sm-4">
                            <select id="jenis_bantuan" class="form-control form-control-sm" ng-options="item as item.nama_bantuan for item in datas.bantuan" ng-model="bantuan" ng-change="model.id_jenis_bantuan=bantuan.id; model.id_mustahik = datas.biodata.id" required>
                                <option value="">---Pilih Jenis Bantuan---</option>
                            </select>
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
                        <textarea id="alasan" class="form-control form-control-sm" ng-model="model.alasan" rows="4"
                            placeholder="Tuliskan alasan pengajuan bantuan..." required></textarea>
                    </div>

                    <hr>

                    <!-- Kelengkapan Berkas -->
                    <h6 class="fw-bold mb-3 bg-primary p-2 text-white">Kelengkapan Berkas</h6>

                    <div class="row mb-3">
                        <!-- Berkas 1 -->
                        <div class="col-md-4 text-center" ng-repeat="item in bantuan.persyaratan">
                            <label class="form-label d-block mb-2">{{item.nama_persyaratan}}</label>
                            <label class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-upload me-3"></i>&nbsp;
                                <input ng-if="item.jenis == 'surat'" accept="application/pdf" type="file" class="form-control" id="customFile" ng-model="item.berkas" base-sixty-four-input required>
                                <input ng-if="item.jenis == 'gambar'" accept="image/jpeg,image/gif,image/png, image/jpg" type="file" class="form-control" id="customFile" ng-model="item.berkas" base-sixty-four-input required>
                                <input ng-if="item.jenis == 'all'" accept="image/jpeg,image/gif,image/png, image/jpg, application/pdf" type="file" class="form-control" id="customFile" ng-model="item.berkas" base-sixty-four-input required>
                            </label>
                        </div>

                    </div>

                    <!-- Tombol aksi (kanan) -->
                    <div class="form-group row mt-4">
                        <div class="col-sm-8 offset-sm-4 text-end">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-paper-plane me-1"></i> Ajukan
                            </button>
                            <!-- <button type="button" class="btn btn-sm btn-secondary" onclick="history.back();">
                                <i class="fas fa-times me-1"></i> Batal
                            </button> -->
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>