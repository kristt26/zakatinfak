<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pertanyaan extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // mapping subkategori ke id_sub_kriteria
        $subKategoriMap = [
            'indeks rumah'             => 1,
            'kepemilikan harta'        => 2,
            'penghasilan'              => 3,
            'pola hidup'               => 4,
            'keadaan rumah'            => 5,
            'ibadan dan kemasyarakatan' => 6,
        ];

        $filePath = FCPATH . 'pertanyaan.json';
        $json     = file_get_contents($filePath);
        $data     = json_decode($json, true);

        foreach ($data as $kategoriItem) {
            if (!isset($kategoriItem['subkategori'])) {
                continue;
            }

            foreach ($kategoriItem['subkategori'] as $subItem) {
                $namaSub = strtolower(trim($subItem['nama']));
                $idSubKriteria = $subKategoriMap[$namaSub] ?? null;

                if (!$idSubKriteria) {
                    echo "SKIP SUB: {$subItem['nama']} (tidak ditemukan di mapping)\n";
                    continue;
                }

                if (!isset($subItem['pertanyaan'])) {
                    continue;
                }

                foreach ($subItem['pertanyaan'] as $pertanyaan) {
                    $insertData = [
                        'pertanyaan'         => $pertanyaan['pertanyaan'] ?? null,
                        'type'               => $pertanyaan['type'] ?? null,
                        'opsi'            => isset($pertanyaan['opsi']) ? serialize($pertanyaan['opsi']) : null,
                        'id_sub_kriteria'    => $idSubKriteria,
                    ];

                    $db->table('pertanyaan')->insert($insertData);
                    echo "INSERT: {$pertanyaan['pertanyaan']} → Sub: {$subItem['nama']} (id=$idSubKriteria)\n";
                }
            }
        }
    }
}
