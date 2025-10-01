<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="kategoriZisController">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-sm-4 col-form-label-sm">Nama Kategori</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="nama_kategori" ng-model="model.nama_kategori" placeholder="Nama Kategori" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_rekening" class="col-sm-4 col-form-label-sm">No Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="no_rekening" ng-model="model.no_rekening" placeholder="Rekening Penampung" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_bank" class="col-sm-4 col-form-label-sm">Nama Bank</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="nama_bank" ng-model="model.nama_bank" placeholder="Nama Rekening Penampung" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-4 col-form-label-sm">Keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   id="keterangan" 
                                   ng-model="model.keterangan" 
                                   placeholder="Keterangan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-save"></i> Save
                            </button>
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
                    <table class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Rekening</th>
                                <th>Nama Bank</th>
                                <th width="20%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama_kategori}}</td>
                                <td>{{item.keterangan}}</td>
                                <td>{{item.no_rekening}}</td>
                                <td>{{item.nama_bank}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-circle" ng-click="edit(item)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-circle" ng-click="delete(item)">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
