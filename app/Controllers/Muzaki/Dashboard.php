<?php

namespace App\Controllers\Muzaki;

use App\Controllers\BaseController;
use App\Models\MustahikModel;
use App\Models\MuzakiModel;
use App\Models\PendaftaranModel;
use App\Models\ZakatModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $muzakiModel = new MuzakiModel();
        $zakatModel  = new ZakatModel();

        $id_user = session()->get('user_id'); // ambil id muzaki dari session login

        $muzaki = $muzakiModel->asArray()->where('id_users', $id_user)->first();

        // Ambil total zakat
        $totalZakat = $zakatModel->where('id_muzaki', $muzaki['id'])
            ->selectSum('jumlah_bayar')
            ->get()->getRow()->jumlah_bayar ?? 0;

        // Ambil riwayat 5 terakhir
        $riwayat = $zakatModel->asArray()
            ->select("zakat.*, kategori_zis.nama_kategori")
            ->join('kategori_zis', 'kategori_zis.id=zakat.id_kategori', 'left')
            ->where('id_muzaki', $muzaki['id'])
            ->orderBy('tanggal_bayar', 'DESC')
            ->asArray()
            ->findAll(5);

        // Chart zakat per bulan (line chart)
        $db = \Config\Database::connect();
        $builder = $db->table('zakat')
            ->select("MONTH(tanggal_bayar) as bulan, SUM(jumlah_bayar) as total")
            ->where('id_muzaki', $muzaki['id'])
            ->groupBy("MONTH(tanggal_bayar)")
            ->orderBy("bulan", "ASC")
            ->get()->getResultArray();

        $labels = [];
        $data   = [];
        foreach ($builder as $row) {
            $labels[] = date("F", mktime(0, 0, 0, $row['bulan'], 10)); // Nama bulan
            $data[]   = (int) $row['total'];
        }

        $dataView = [
            'muzaki' => $muzaki,
            'total_zakat' => $totalZakat,
            'riwayat' => $riwayat,
            'chart_labels' => json_encode($labels),
            'chart_data'   => json_encode($data)
        ];

        return view('muzaki/home', $dataView);
    }
}
