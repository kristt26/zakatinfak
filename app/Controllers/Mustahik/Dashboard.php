<?php

namespace App\Controllers\Mustahik;

use App\Controllers\BaseController;
use App\Models\MustahikModel;
use App\Models\MuzakiModel;
use App\Models\PendaftaranModel;
use App\Models\ZakatModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $mustahikModel   = new MustahikModel();
        $pendaftaranModel = new PendaftaranModel();

        $id_user = session()->get('user_id'); // ambil dari session login

        // Profil mustahik
        $mustahik = $mustahikModel->asArray()->where('id_users', $id_user)->first();

        // Status pengajuan terakhir
        $pengajuanTerakhir = $pendaftaranModel->asArray()
            ->where('id_mustahik', $mustahik['id'])
            ->orderBy('tanggal_daftar', 'DESC')
            ->first();

        // Riwayat pengajuan
        $riwayat = $pendaftaranModel->asArray()
            ->select('pendaftaran.*, jb.nama_bantuan')
            ->join('jenis_bantuan jb', 'pendaftaran.id_jenis_bantuan = jb.id')
            ->where('pendaftaran.id_mustahik', $mustahik['id'])
            ->orderBy('pendaftaran.tanggal_daftar', 'DESC')
            ->asArray()
            ->findAll(5);

        // Grafik bantuan per tahun
        $db = \Config\Database::connect();
        $builder = $db->table('pendaftaran p');
        $builder->select("YEAR(p.tanggal_daftar) as tahun, COUNT(p.id) as total");
        $builder->where('p.id_mustahik', $mustahik['id']);
        $builder->groupBy("YEAR(p.tanggal_daftar)");
        $builder->orderBy("tahun", "ASC");
        $grafik = $builder->get()->getResultArray();

        $labels = [];
        $data   = [];
        foreach ($grafik as $row) {
            $labels[] = $row['tahun'];
            $data[]   = (int) $row['total'];
        }

        $dataView = [
            'mustahik' => $mustahik,
            'pengajuan_terakhir' => $pengajuanTerakhir,
            'riwayat' => $riwayat,
            'chart_labels' => json_encode($labels),
            'chart_data'   => json_encode($data)
        ];

        return view('mustahik/home', $dataView);
    }
}
