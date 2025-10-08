<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row" ng-controller="pengajuanController">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2 text-right">
                    <a href="/mustahik/pengajuan/tambah_pengajuan" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Pengajuan</a>
                </div>
                <div class="table-responsive">
                    <table datatable="ng" class="table table-xs table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pendaftaran</th>
                                <th>Jenis Bantuan</th>
                                <th>Tanggal Daftar</th>
                                <th>Status Pengajuan</th>
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas" ng-class="{'bg-warning text-white': item.pesan, 'bg-info text-white' : !item.pesan && item.status_pengajuan != 'ditolak' && item.status_pengajuan != 'disetujui', 'bg-success text-white' : item.status_pengajuan == 'disetujui', 'bg-danger text-white' : item.status_pengajuan == 'ditolak'}">
                                <td>{{$index+1}}</td>
                                <td>{{item.no_daftar}}</td>
                                <td>{{item.nama_bantuan}}</td>
                                <td>{{item.tanggal_daftar}}</td>
                                <td bs-tooltip title="{{item.pesan ? item.pesan : 'Tombol edit akan tampil saat pengajuan di kembalikan'}}">{{item.pesan ? 'Dikembalikan' : item.status_pengajuan}}</td>
                                <td>
                                    <a href="/mustahik/pengajuan/ubah_pengajuan/{{item.id}}" ng-show="item.pesan" class="btn btn-sm btn-secondary btn-circle"><i class="fas fa-edit"></i></a>
                                    <!-- <button class="btn btn-sm btn-danger btn-circle" ng-click="delete(item)"><i class="fas fa-trash"></i></button> -->
                                    <a href="/mustahik/survey/{{item.id}}" class="btn btn-sm btn-primary btn-circle" bs-tooltip title="Isi Survey Faktual"><i class="fas fa-poll"></i></a>
                                    <!-- <button ng-show="item.rekomendasi.length !=0" class="btn btn-info btn-sm" bs-tooltip title="Rekomendasi" ng-click="showRekom(item.rekomendasi)"><i class="fas fa-eye"></i></button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hasil Rekomendasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Syarat Minimum</th>
                            <th>Nilai Rekapitulasi</th>
                            <th>Status</th>
                        </tr>
                        <tr ng-repeat="item in rekom" ng-class="{'bg-danger text-white' : item.rekap < item.bobot }">
                            <th>{{$index+1}}</th>
                            <th>{{item.nama_kriteria}}</th>
                            <th>{{item.bobot}}</th>
                            <th>{{item.rekap}}</th>
                            <th>{{item.rekap >= item.bobot ? 'Layak': 'Tidak Layak'}}</th>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>