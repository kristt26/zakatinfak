<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="petugasController">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label-sm">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="nama" ng-model="model.nama" placeholder="Nama Petugas" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="jabatan" ng-model="model.jabatan" placeholder="Jabatan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="username" ng-model="model.username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control form-control-sm" id="password" ng-model="model.password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akses" class="col-sm-4 col-form-label">Akses</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" ng-model="model.akses" id="akses" required>
                                <option value="">---Pilih Akses---</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <!-- <option value="pimpinan">Pimpinan</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>Jabatan</th>
                                <th>Username</th>
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama}}</td>
                                <td>{{item.jabatan}}</td>
                                <td>{{item.username}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-circle" ng-click="edit(item)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-circle" ng-click="delete(item)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>