<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="persyaratanController">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <div class="form-group row">
                        <label for="nama_persyaratan" class="col-sm-4 col-form-label-sm">Nama Persyaratan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" 
                                   id="nama_persyaratan" 
                                   ng-model="model.nama_persyaratan" 
                                   placeholder="Nama Persyaratan" required>
                            <input type="text" class="form-control form-control-sm" 
                                   id="jenis" 
                                   ng-model="model.jenis" 
                                   placeholder="Jenis Berkas" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_persyaratan" class="col-sm-4 col-form-label-sm">Nama Persyaratan</label>
                        <div class="col-sm-8">
                            <select id="jenis" class="form-control form-control-sm" ng-model="model.jenis" required>
                                <option value="">---Pilih Jenis Berkas---</option>
                                <option value="surat">PDF</option>
                                <option value="gambar">Gambar</option>
                                <option value="all">PDF dan Gambar</option>
                            </select>
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
                <div class="mb-2 text-right">
                    <button class="btn btn-sm btn-secondary" onclick="history.back()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Persyaratan</th>
                                <th>Jenis Bekas</th>
                                <!-- <th>Jenis Bantuan</th> -->
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas track by item.id">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama_persyaratan}}</td>
                                <td>{{item.jenis=='surat' ? 'PDF': item.jenis =='gambar':'Gambar' : 'PDF dan Gambar'}}</td>
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
