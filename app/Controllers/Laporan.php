<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;
use App\Models\ZakatModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function pembayaran(): string
    {
        return view('admin/laporan/pembayaran');
    }
    public function bantuan(): string
    {
        return view('admin/laporan/bantuan');
    }

    public function data()
    {
        $post = $this->request->getJSON(true);

        try {
            $dari = $post['dari_tanggal'] ?? '';
            $sampai = $post['sampai_tanggal'] ?? '';
            $db = \Config\Database::connect();
            $builder = $db->table('zakat o');
            $builder->select('o.id, o.no_bayar AS invoice, o.tanggal_bayar AS tanggal, c.nama AS nama_muzaki, m.nama AS nama_mustahik, o.status_transaksi, o.jumlah_bayar, k.nama_kategori');
            $builder->join('muzaki c', 'c.id = o.id_muzaki', 'left');
            $builder->join('mustahik m', 'm.id = o.id_mustahik', 'left');
            $builder->join('kategori_zis k', 'k.id = o.id_kategori', 'left');
            if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
                $builder->where("DATE(o.tanggal_bayar) >=", $dari);
                $builder->where("DATE(o.tanggal_bayar) <=", $sampai);
            }
            $builder->where("o.status_transaksi", "valid");
            $builder->orderBy('o.tanggal_bayar', 'DESC');
            $data = $builder->get()->getResult();
            return $this->response->setJSON($data);
        } catch (\Throwable $th) {
            return $this->response->setJSON(['status' => 'Gagal'])->setStatusCode(400);
        }
    }

    public function excel()
    {
        $dari   = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');

        $db = \Config\Database::connect();
        $builder = $db->table('zakat o');
        $builder->select('o.id, o.no_bayar AS invoice, o.tanggal_bayar AS tanggal, 
                      c.nama AS nama_muzaki, m.nama AS nama_mustahik, 
                      o.status_transaksi, o.jumlah_bayar, k.nama_kategori');
        $builder->join('muzaki c', 'c.id = o.id_muzaki', 'left');
        $builder->join('mustahik m', 'm.id = o.id_mustahik', 'left');
        $builder->join('kategori_zis k', 'k.id = o.id_kategori', 'left');

        if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
            $builder->where("DATE(o.tanggal_bayar) >=", $dari);
            $builder->where("DATE(o.tanggal_bayar) <=", $sampai);
        }

        $builder->where("o.status_transaksi", "valid");
        $builder->orderBy('o.tanggal_bayar', 'DESC');
        $laporan = $builder->get()->getResultArray();

        // Mulai generate Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI ZAKAT/INFAK/SEDEKAH');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:H2');
        $periode = ($dari && $sampai)
            ? "Periode: " . date('d-m-Y', strtotime($dari)) . " s.d. " . date('d-m-Y', strtotime($sampai))
            : "Periode: Semua Data";
        $sheet->setCellValue('A2', $periode);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Header
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'Invoice');
        $sheet->setCellValue('D3', 'Muzaki');
        $sheet->setCellValue('E3', 'Mustahik');
        $sheet->setCellValue('F3', 'Kategori');
        $sheet->setCellValue('G3', 'Status');
        $sheet->setCellValue('H3', 'Jumlah Bayar');

        $sheet->getStyle('A3:H3')->getFont()->setBold(true);
        $sheet->getStyle('A3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Isi data
        $row = 4;
        $grandTotal = 0;
        foreach ($laporan as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, date('d-m-Y', strtotime($item['tanggal'])));
            $sheet->setCellValue('C' . $row, $item['invoice']);
            $sheet->setCellValue('D' . $row, $item['nama_muzaki']);
            $sheet->setCellValue('E' . $row, $item['nama_mustahik']);
            $sheet->setCellValue('F' . $row, $item['nama_kategori']);
            $sheet->setCellValue('G' . $row, ucfirst($item['status_transaksi']));
            $sheet->setCellValue('H' . $row, $item['jumlah_bayar']);

            $grandTotal += $item['jumlah_bayar'];
            $row++;
        }

        // Total keseluruhan
        $sheet->mergeCells('A' . $row . ':G' . $row);
        $sheet->setCellValue('A' . $row, 'TOTAL KESELURUHAN');
        $sheet->setCellValue('H' . $row, $grandTotal);
        $sheet->getStyle('A' . $row . ':H' . $row)->getFont()->setBold(true);

        // Format rupiah
        $currencyFormat = '"Rp. " #,##0';
        $sheet->getStyle('H4:H' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyFormat);

        // Auto size
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A3:H' . $row)->applyFromArray($styleArray);

        // Download file
        $filename = 'laporan_zakat_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }



    public function print()
    {
        $orderModel = new ZakatModel();
        $dari = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');

        $data = $orderModel->getLaporan($dari, $sampai);

        echo view('admin/laporan/cetak', [
            'laporan' => $data,
            'dari' => $dari,
            'sampai' => $sampai
        ]);
    }

    public function bantuan_data()
    {
        $post = $this->request->getJSON(true);

        try {
            $dari = $post['dari_tanggal'] ?? '';
            $sampai = $post['sampai_tanggal'] ?? '';
            $db = \Config\Database::connect();
            $builder = $db->table('pendaftaran o');
            $builder->select('o.id, o.no_daftar AS invoice, o.tanggal_daftar AS tanggal, m.nama AS nama_mustahik, o.status_pengajuan, k.nama_bantuan');
            $builder->join('mustahik m', 'm.id = o.id_mustahik', 'left');
            $builder->join('jenis_bantuan k', 'k.id = o.id_jenis_bantuan', 'left');
            if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
                $builder->where("DATE(o.tanggal_daftar) >=", $dari);
                $builder->where("DATE(o.tanggal_daftar) <=", $sampai);
            }
            $builder->where("o.status_pengajuan", "disetujui");
            $builder->orderBy('o.tanggal_daftar', 'DESC');
            $data = $builder->get()->getResult();
            foreach ($data as $key => $value) {
                $value->rekomendasi = $builder = $db->table('rekomendasi')->select('kriteria.nama_kriteria, rekomendasi.rekap')
                    ->join('kriteria', 'kriteria.id = rekomendasi.id_kriteria')
                    ->where('id_pendaftaran', $value->id)->get()->getResult();
            }
            return $this->response->setJSON($data);
        } catch (\Throwable $th) {
            return $this->response->setJSON(['status' => 'Gagal'])->setStatusCode(400);
        }
    }

    public function bantuan_excel()
    {
        $request = service('request');
        $post = $request->getPost();

        $dari   = $post['dari_tanggal'] ?? '';
        $sampai = $post['sampai_tanggal'] ?? '';

        $db = \Config\Database::connect();

        // Query utama
        $builder = $db->table('pendaftaran o');
        $builder->select('o.id, o.no_daftar AS invoice, o.tanggal_daftar AS tanggal, m.nama AS nama_mustahik, o.status_pengajuan, k.nama_bantuan');
        $builder->join('mustahik m', 'm.id = o.id_mustahik', 'left');
        $builder->join('jenis_bantuan k', 'k.id = o.id_jenis_bantuan', 'left');

        if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
            $builder->where("DATE(o.tanggal_daftar) >=", $dari);
            $builder->where("DATE(o.tanggal_daftar) <=", $sampai);
        }

        $builder->where("o.status_pengajuan", "disetujui");
        $builder->orderBy('o.tanggal_daftar', 'DESC');
        $laporan = $builder->get()->getResultArray();

        // Buat Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header judul
        $sheet->setCellValue('A1', 'Laporan Penerima Bantuan');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // Header tabel
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Kode Daftar');
        $sheet->setCellValue('C3', 'Tanggal');
        $sheet->setCellValue('D3', 'Nama Mustahik');
        $sheet->setCellValue('E3', 'Jenis Bantuan');
        $sheet->setCellValue('F3', 'Status');
        $sheet->setCellValue('G3', 'Rekomendasi');

        $sheet->getStyle('A3:G3')->getFont()->setBold(true);

        // Isi data
        $rowNumber = 4;
        $no = 1;

        foreach ($laporan as &$data) {
            // Ambil rekomendasi per pendaftaran
            $rekom = $db->table('rekomendasi')
                ->select('kriteria.nama_kriteria, rekomendasi.rekap')
                ->join('kriteria', 'kriteria.id = rekomendasi.id_kriteria')
                ->where('id_pendaftaran', $data['id'])
                ->get()->getResultArray();

            // Gabungkan ke satu kolom string
            $data['rekomendasi'] = implode(', ', array_map(function ($r) {
                return $r['nama_kriteria'] . ': ' . $r['rekap'];
            }, $rekom));

            // Isi ke Excel
            $sheet->setCellValue('A' . $rowNumber, $no++);
            $sheet->setCellValue('B' . $rowNumber, $data['invoice']);
            $sheet->setCellValue('C' . $rowNumber, $data['tanggal']);
            $sheet->setCellValue('D' . $rowNumber, $data['nama_mustahik']);
            $sheet->setCellValue('E' . $rowNumber, $data['nama_bantuan']);
            $sheet->setCellValue('F' . $rowNumber, $data['status_pengajuan']);
            $sheet->setCellValue('G' . $rowNumber, $data['rekomendasi']);

            $rowNumber++;
        }

        // Auto size kolom
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output file Excel
        $filename = 'laporan_penerima_' . date('YmdHis') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Set header supaya langsung download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function bantuan_print()
    {
        $orderModel = new PendaftaranModel();
        $dari = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');

        $data = $orderModel->getLaporan($dari, $sampai);

        echo view('admin/laporan/cetak_bantuan', [
            'laporan' => $data,
            'dari' => $dari,
            'sampai' => $sampai
        ]);
    }
}
