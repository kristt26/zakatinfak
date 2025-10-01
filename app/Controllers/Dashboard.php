<?php

namespace App\Controllers;

use App\Models\MustahikModel;
use App\Models\MuzakiModel;
use App\Models\PendaftaranModel;
use App\Models\ZakatModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $mustahik = new \App\Models\MustahikModel();
        $muzaki   = new \App\Models\MuzakiModel();
        $zakat    = new \App\Models\ZakatModel();
        $daftar   = new \App\Models\PendaftaranModel();

        $db = \Config\Database::connect();

        // ===== Chart Bantuan (bar chart) =====
        $builder = $db->table('pendaftaran p');
        $builder->select('jb.nama_bantuan, COUNT(p.id) as jumlah');
        $builder->join('jenis_bantuan jb', 'p.id_jenis_bantuan = jb.id');
        $builder->groupBy('jb.nama_bantuan');
        $query = $builder->get()->getResultArray();

        $labelsBantuan = [];
        $dataBantuan   = [];
        foreach ($query as $row) {
            $labelsBantuan[] = $row['nama_bantuan'];
            $dataBantuan[]   = (int) $row['jumlah'];
        }

        // ===== Chart Zakat (pie chart) =====
        $builder2 = $db->table('zakat z');
        $builder2->select('jz.nama_kategori, SUM(z.jumlah_bayar) as total');
        $builder2->join('kategori_zis jz', 'z.id_kategori = jz.id');
        $builder2->groupBy('jz.nama_kategori');
        $query2 = $builder2->get()->getResultArray();

        $labelsZakat = [];
        $dataZakat   = [];
        foreach ($query2 as $row) {
            $labelsZakat[] = $row['nama_kategori'];
            $dataZakat[]   = (int) $row['total'];
        }

        $data = [
            'statistik' => [
                'mustahik'     => $mustahik->countAll(),
                'muzaki'       => $muzaki->countAll(),
                'zakat'        => $zakat->selectSum('jumlah_bayar')->get()->getRow()->jumlah_bayar ?? 0,
                'pendaftaran'  => $daftar->countAll(),
            ],
            'pendaftaran' => $daftar->select('pendaftaran.*, mustahik.nama, jenis_bantuan.nama_bantuan')->join('mustahik', 'mustahik.id=pendaftaran.id_mustahik', 'left')->join('jenis_bantuan', 'jenis_bantuan.id=pendaftaran.id_jenis_bantuan', 'left')->orderBy('tanggal_daftar', 'DESC')->asArray()->findAll(5),
            'zakat'       => $zakat->select('zakat.*, kategori_zis.nama_kategori, muzaki.nama as nama_muzaki, muzaki.telepon as telepon_muzaki, mustahik.nama as nama_mustahik, mustahik.telepon as telepon_mustahik')->join('muzaki', 'muzaki.id = zakat.id_muzaki', 'left')->join('mustahik', 'mustahik.id = zakat.id_mustahik', 'left')->join('kategori_zis', 'kategori_zis.id = zakat.id_kategori', 'left')->orderBy('tanggal_bayar', 'DESC')->asArray()->findAll(5),

            // Chart Bantuan
            'chart_labels_bantuan' => json_encode($labelsBantuan),
            'chart_data_bantuan'   => json_encode($dataBantuan),

            // Chart Zakat
            'chart_labels_zakat' => json_encode($labelsZakat),
            'chart_data_zakat'   => json_encode($dataZakat),
        ];

        return view('admin/home', $data);
    }
}
