<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="biodataController">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <div class="form-group row mb-2 align-items-center">
                        <label for="nik" class="col-sm-2 col-form-label-sm text-end">NIK</label>
                        <div class="col-sm-4">
                            <input type="text" id="nik" class="form-control form-control-sm"
                                ng-model="model.nik" placeholder="Nomor Induk Kependudukan">
                        </div>
                        <label for="telepon" class="col-sm-2 col-form-label-sm text-end">Telepon</label>
                        <div class="col-sm-4">
                            <input type="text" id="telepon" class="form-control form-control-sm"
                                ng-model="model.telepon" placeholder="Nomor Induk Kependudukan">
                        </div>
                    </div>

                    <!-- Baris 2: Nama Mustahik | NIK -->
                    <div class="form-group row mb-2 align-items-center">
                        <label for="nama_mustahik" class="col-sm-2 col-form-label-sm">Nama Mustahik</label>
                        <div class="col-sm-4">
                            <input type="text" id="nama_mustahik" class="form-control form-control-sm"
                                ng-model="model.nama" placeholder="Nama Mustahik" required>
                        </div>

                        <label for="email" class="col-sm-2 col-form-label-sm">Email</label>
                        <div class="col-sm-4">
                            <input type="email" id="email" class="form-control form-control-sm"
                                ng-model="model.email" placeholder="Nama Mustahik" required>
                        </div>
                    </div>
                    <!-- Baris 3: Nama Mustahik | NIK -->

                    <div class="form-group row mb-2 align-items-center">
                        <label for="pekerjaan" class="col-sm-2 col-form-label-sm">Pekerjaan</label>
                        <div class="col-sm-4">
                            <input type="text" id="pekerjaan" class="form-control form-control-sm"
                                ng-model="model.pekerjaan" placeholder="Pekerjaan" required>
                        </div>

                        <label for="penghasilan" class="col-sm-2 col-form-label-sm">Penghasilan</label>
                        <div class="col-sm-4">
                            <input type="text" id="penghasilan" class="form-control form-control-sm"
                                ng-model="model.penghasilan" placeholder="Penghasilan" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' '}" required>
                        </div>
                    </div>
                    <!-- Alasan (textarea full width) -->
                    <div class="form-group mb-3">
                        <label for="alamat" class="col-form-label-sm">Alamat</label>
                        <textarea id="alamat" class="form-control form-control-sm" ng-model="model.alamat" rows="4" required></textarea>
                    </div>

                    <hr>

                    <div class="form-group row mt-4">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Helper kecil untuk AngularJS agar nama file tampil (sesuaikan jika controller Anda sudah punya) -->
<script>
    // Pastikan ini berjalan di dalam scope Angular Anda (pengajuanController)
    // Jika pengajuanController sudah dibuat di file JS Anda, Anda bisa pindahkan fungsi ini ke dalam controller tersebut.
    (function() {
        var el = document.querySelector('[ng-controller="pengajuanController"]');
        if (!el) return;
        var $scope = angular.element(el).scope();

        // inisialisasi
        $scope.fileNames = $scope.fileNames || {};

        $scope.fileChanged = function(files, key) {
            var file = files && files.length ? files[0] : null;
            $scope.$apply(function() {
                $scope.fileNames[key] = file ? file.name : '';
                // Simpan file referensi di model jika Anda ingin submit via FormData
                $scope.model = $scope.model || {};
                $scope.model[key] = file || null;
            });
        };

        // contoh fungsi cancel jika belum ada di controller
        $scope.cancel = $scope.cancel || function() {
            $scope.model = {};
            $scope.fileNames = {};
            $scope.$applyAsync();
        };
    })();
</script>

<?= $this->endSection() ?>