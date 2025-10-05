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
        $survey   = new \App\Models\SurveyModel(); // tambahkan model untuk data survey
        $db = \Config\Database::connect();

        if (session()->get('akses') == 'admin') {
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
                'pendaftaran' => $daftar->select('pendaftaran.*, mustahik.nama, jenis_bantuan.nama_bantuan')
                    ->join('mustahik', 'mustahik.id=pendaftaran.id_mustahik', 'left')
                    ->join('jenis_bantuan', 'jenis_bantuan.id=pendaftaran.id_jenis_bantuan', 'left')
                    ->orderBy('tanggal_daftar', 'DESC')
                    ->asArray()
                    ->findAll(5),
                'zakat' => $zakat->select('zakat.*, kategori_zis.nama_kategori, muzaki.nama as nama_muzaki, mustahik.nama as nama_mustahik')
                    ->join('muzaki', 'muzaki.id = zakat.id_muzaki', 'left')
                    ->join('mustahik', 'mustahik.id = zakat.id_mustahik', 'left')
                    ->join('kategori_zis', 'kategori_zis.id = zakat.id_kategori', 'left')
                    ->orderBy('tanggal_bayar', 'DESC')
                    ->asArray()
                    ->findAll(5),
                'chart_labels_bantuan' => json_encode($labelsBantuan),
                'chart_data_bantuan'   => json_encode($dataBantuan),
                'chart_labels_zakat'   => json_encode($labelsZakat),
                'chart_data_zakat'     => json_encode($dataZakat),
            ];

            return view('admin/home', $data);
        } else {
            // ===== Bagian PETUGAS =====

            // Hitung statistik validasi
            $totalSurvey   = $daftar->whereIn('status_pengajuan', ['disetujui', 'ditolak', 'diverifikasi'])->countAllResults();
            $tervalidasi   = $daftar->where('status_pengajuan', 'disetujui')->countAllResults();
            $ditolak   = $daftar->where('status_pengajuan', 'ditolak')->countAllResults();
            $belumValidasi = $daftar->where('status_pengajuan', 'diverifikasi')->countAllResults();

            // Data untuk chart validasi (pie)
            $chartValidasi = [
                'tervalidasi'    => $tervalidasi,
                'belum_validasi' => $belumValidasi,
                'ditolak'        => $ditolak
            ];

            // Chart validasi per jenis bantuan
            $builder3 = $db->table('pendaftaran s');
            $builder3->select('jb.nama_bantuan, COUNT(s.id) as jumlah');
            $builder3->join('jenis_bantuan jb', 's.id_jenis_bantuan = jb.id', 'left');
            $builder3->whereIn('s.status_pengajuan', ['disetujui', 'ditolak']);
            $builder3->groupBy('jb.nama_bantuan');
            $query3 = $builder3->get()->getResultArray();

            $labelsBantuan = [];
            $dataTervalidasi = [];
            foreach ($query3 as $row) {
                $labelsBantuan[]   = $row['nama_bantuan'];
                $dataTervalidasi[] = (int) $row['jumlah'];
            }

            // Ambil daftar pendaftaran yang belum divalidasi
            $pendaftaranBelum = $daftar->asArray()->select('pendaftaran.*, mustahik.nama as nama_mustahik, mustahik.alamat, jenis_bantuan.nama_bantuan')
                ->join('mustahik', 'mustahik.id = pendaftaran.id_mustahik', 'left')
                ->join('jenis_bantuan', 'jenis_bantuan.id = pendaftaran.id_jenis_bantuan', 'left')
                ->whereIn('pendaftaran.status_pengajuan', ['diverifikasi'])
                ->orderBy('tanggal_daftar', 'DESC')
                ->findAll(10);

            $data = [
                'statistik' => [
                    'total_survey'     => $totalSurvey,
                    'tervalidasi'      => $tervalidasi,
                    'ditolak'          => $ditolak,
                    'belum_validasi'   => $belumValidasi,
                ],
                'survey' => $pendaftaranBelum,
                'chart_validasi'         => $chartValidasi,
                'chart_labels_bantuan'   => json_encode($labelsBantuan),
                'chart_data_tervalidasi' => json_encode($dataTervalidasi),
            ];

            return view('petugas/home', $data);
        }
    }
}
