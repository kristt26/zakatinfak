<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="pembayaranMustahikController">
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
                                ng-model="model.no_bayar" readonly>
                        </div>

                        <label for="jenis_bantuan" class="col-sm-2 col-form-label-sm text-end">Kategori ZIS</label>
                        <div class="col-sm-4">
                            <select id="jenis_bantuan" class="form-control form-control-sm" ng-options="item as item.nama_kategori for item in datas.kategori" ng-model="kategori" ng-change="model.id_kategori=kategori.id; model.id_mustahik = datas.biodata.id; model.id_muzaki=null" required>
                                <option value="">---Pilih Kategori---</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 2: Nama Mustahik | NIK -->
                    <div class="form-group row mb-2 align-items-center">
                        <label for="nik" class="col-sm-2 col-form-label-sm text-end">NIK</label>
                        <div class="col-sm-4">
                            <input type="text" id="nik" class="form-control form-control-sm"
                                ng-model="datas.biodata.nik" readonly>
                        </div>
                        <label for="nama_mustahik" class="col-sm-2 col-form-label-sm">Nama Mustahik</label>
                        <div class="col-sm-4">
                            <input type="text" id="nama_mustahik" class="form-control form-control-sm"
                                ng-model="datas.biodata.nama" required readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-2 align-items-center">
                        <label for="telepon" class="col-sm-2 col-form-label-sm text-end">Telepon</label>
                        <div class="col-sm-4">
                            <input type="text" id="telepon" class="form-control form-control-sm"
                                ng-model="datas.biodata.telepon" placeholder="Nomor Telepon" readonly>
                        </div>

                        <label for="penghasilan" class="col-sm-2 col-form-label-sm">Penghasilan</label>
                        <div class="col-sm-4">
                            <input type="text" id="penghasilan" class="form-control form-control-sm"
                                ng-model="datas.biodata.penghasilan" mask-currency="'Rp. '"
                                config="{group:'.',decimalSize:'0',indentation:' '}" readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-2 align-items-center">
                        <label for="jumlah_bayar" class="col-sm-2 col-form-label-sm">Nominal Bayar</label>
                        <div class="col-sm-4">
                            <input type="text" id="jumlah_bayar" class="form-control form-control-sm"
                                ng-model="model.jumlah_bayar" mask-currency="'Rp. '"
                                config="{group:'.',decimalSize:'0',indentation:' '}">
                        </div>

                        <label for="bukti_bayar" class="col-sm-2 col-form-label-sm">Bukti Bayar</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="file" class="form-control form-control-sm" id="bukti_bayar"
                                    ng-model="model.berkas" base-sixty-four-input required>
                                <label class="input-group-text">
                                    <i class="fas fa-upload"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol aksi (kanan) -->
                    <div class="form-group row mt-4">
                        <div class="col-sm-8 offset-sm-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-paper-plane me-1"></i> Kirim Bukti Pembayaran
                            </button>
                        </div>
                    </div>

                </form>

                <!-- Informasi Nomor Rekening (Terpisah dari Form) -->
                <div class="mt-4">
                    <div class="alert alert-info" role="alert">
                        <h6 class="fw-bold">Informasi Nomor Rekening</h6>
                        <p ng-if="kategori">
                            Nomor Rekening: <strong>{{ kategori.no_rekening }}</strong><br>
                            Bank: <strong>{{ kategori.nama_bank }}</strong>
                        </p>
                        <p ng-if="!kategori" class="text-muted">
                            Pilih kategori bantuan di atas untuk melihat nomor rekening tujuan transfer.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>