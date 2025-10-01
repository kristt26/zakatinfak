<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="muzakiMustahikController">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Muzaki/Mustahik</th>
                                <th>Telepon</th>
                                <th>username</th>
                                <!-- <th><i class="fas fa-cogs"></i></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nik}}</td>
                                <td>{{item.nama}}</td>
                                <td>{{item.telepon}}</td>
                                <td>{{item.username}}</td>
                                <!-- <td>
                                    <button class="btn btn-sm btn-warning btn-circle" ng-click="edit(item)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-circle" ng-click="delete(item)"><i class="fas fa-trash"></i></button>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>