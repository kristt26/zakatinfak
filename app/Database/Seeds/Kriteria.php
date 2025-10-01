<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kriteria extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 1,
                'nama_kriteria'  => 'Ekonomi',
                'bobot'   => '40'
            ],
            [
                'id'          => 2,
                'nama_kriteria'  => 'Kesehatan',
                'bobot'   => '10'
            ],
            [
                'id'          => 3,
                'nama_kriteria'  => 'Keimanan',
                'bobot'   => '5'
            ],

        ];

        $this->db->table('kriteria')->insertBatch($data);
    }
}
