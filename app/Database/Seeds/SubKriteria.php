<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubKriteria extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 1,
                'nama_sub'  => 'Indeks Rumah',
                'id_kriteria'   => '1'
            ],
            [
                'id'          => 2,
                'nama_sub'  => 'Kepemilikan Harta',
                'id_kriteria'   => '1'
            ],
            [
                'id'          => 3,
                'nama_sub'  => 'Penghasilan',
                'id_kriteria'   => '1'
            ],
            [
                'id'          => 4,
                'nama_sub'  => 'Pola Hidup',
                'id_kriteria'   => '2'
            ],
            [
                'id'          => 5,
                'nama_sub'  => 'Keadaan Rumah',
                'id_kriteria'   => '2'
            ],
            [
                'id'          => 6,
                'nama_sub'  => 'Ibadan dan Kemasyarakatan',
                'id_kriteria'   => '3'
            ],

        ];
        $this->db->table('sub_kriteria')->insertBatch($data);
    }
}
