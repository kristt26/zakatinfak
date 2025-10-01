<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="jenisBantuanController">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <div class="form-group row">
                        <label for="nama_bantuan" class="col-sm-4 col-form-label-sm">Nama Bantuan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="nama_bantuan" ng-model="model.nama_bantuan" placeholder="Nama Bantuan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-4 col-form-label-sm">Deskripsi</label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" id="deskripsi" ng-model="model.deskripsi" placeholder="Deskripsi Bantuan" rows="3"></textarea>
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
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bantuan</th>
                                <th>Deskripsi</th>
                                <th width="20%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama_bantuan}}</td>
                                <td>{{item.deskripsi}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-circle" ng-click="edit(item)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-circle" ng-click="delete(item)"><i class="fas fa-trash"></i></button>
                                    <a href="/persyaratan/{{item.id}}" class="btn btn-sm btn-info btn-circle"><i class="fas fa-list"></i></a>
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
