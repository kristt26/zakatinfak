<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="daftarPengajuanController">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pendaftaran</th>
                                <th>Nama Mustahik</th>
                                <th>Telepon</th>
                                <th>Jenis Bantuan</th>
                                <!-- <th>Tanggal Daftar</th> -->
                                <th>Status Pengajuan</th>
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas" ng-class="{'bg-warning text-white': item.pesan, 'bg-info text-white' : !item.pesan && item.status_pengajuan != 'ditolak' && item.status_pengajuan != 'disetujui', 'bg-success text-white' : item.status_pengajuan == 'disetujui', 'bg-danger text-white' : item.status_pengajuan == 'ditolak'}">
                                <td>{{$index+1}}</td>
                                <td>{{item.no_daftar}}</td>
                                <td>{{item.nama}}</td>
                                <td>{{item.telepon}}</td>
                                <td>{{item.nama_bantuan}}</td>
                                <!-- <td>{{item.tanggal_daftar}}</td> -->
                                <td>{{item.pesan ? 'Dikembalikan' : item.status_pengajuan}}</td>
                                <td>
                                    <?php if(session()->get('akses')=='admin'):?>
                                    <a ng-show="!item.pesan" href="/pendaftaran/detail/{{item.id}}" class="btn btn-sm btn-secondary btn-circle"><i class="fas fa-info-circle"></i></a>
                                    <?php endif;?>
                                    <!-- <button class="btn btn-sm btn-danger btn-circle" ng-click="delete(item)"><i class="fas fa-trash"></i></button> -->
                                     <?php if(session()->get('akses')=='petugas'):?>
                                    <a href="/mustahik/survey/{{item.id}}" ng-show="item.status_pengajuan == 'diverifikasi'" class="btn btn-sm btn-primary btn-circle"><i class="fas fa-poll"></i></a>
                                    <?php endif;?>
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