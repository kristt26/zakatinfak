<?= $this->extend('layout/admin/indeks') ?>
<?= $this->section('content') ?>
<div class="row" ng-controller="pertanyaanController">
    <!-- FORM INPUT -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <form ng-submit="save()">
                    <div class="form-group row">
                        <label for="pertanyaan" class="col-sm-4 col-form-label-sm">Pertanyaan</label>
                        <div class="col-sm-8">
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   id="pertanyaan" 
                                   ng-model="model.pertanyaan" 
                                   placeholder="Isi pertanyaan" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label-sm">Tipe</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" 
                                    id="type" 
                                    ng-model="model.type" required>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="group">Group</option>
                            </select>
                        </div>
                    </div>
                    <!-- OPSI JAWABAN -->
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label-sm">Opsi Jawaban</label>
                        <div class="col-sm-8">
                            <div ng-repeat="opsi in model.opsi track by $index" class="input-group mb-1">
                                <input type="text" class="form-control form-control-sm" 
                                       ng-model="opsi.label" placeholder="Label opsi">
                                <input type="number" class="form-control form-control-sm" 
                                       ng-model="opsi.skor" placeholder="Skor">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger" type="button" ng-click="removeOpsi($index)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success mt-1" ng-click="addOpsi()">
                                <i class="fas fa-plus"></i> Tambah Opsi
                            </button>
                        </div>
                    </div>

                    <!-- BUTTON SAVE -->
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
    
    <!-- TABEL DATA -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="mb-2 text-right">
                    <button class="btn btn-sm btn-secondary" onclick="history.back()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div>
                <div class="table-responsive">
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Tipe</th>
                                <th>Opsi</th>
                                <th width="20%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.pertanyaan}}</td>
                                <td>{{item.type}}</td>
                                <td>
                                    <ul class="mb-0 pl-3">
                                        <li ng-repeat="opsi in item.opsi">
                                            {{opsi.label}} ({{opsi.skor}})
                                        </li>
                                    </ul>
                                </td>
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
