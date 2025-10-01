<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisInfak extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 1,
                'nama_bantuan'  => 'Bantuan Biaya Pendidikan',
                'deskripsi'   => 'Infak yang diperuntukkan untuk membantu biaya pendidikan secara umum.'
            ],
            [
                'id'          => 2,
                'nama_bantuan'  => 'Bantuan Biaya Beasiswa Siswa-Siswi Berprestasi',
                'deskripsi'   => 'Infak yang digunakan untuk memberikan beasiswa kepada siswa-siswi berprestasi.'
            ],
            [
                'id'          => 3,
                'nama_bantuan'  => 'Bantuan biaya pendidikan insidentil (kuliah/sekolah)',
                'deskripsi'   => 'Infak insidentil untuk mendukung kebutuhan mendesak pendidikan kuliah atau sekolah.'
            ],
            [
                'id'          => 4,
                'nama_bantuan'  => 'Bantuan biaya ekonomi perorangan / komunitas',
                'deskripsi'   => 'Infak untuk membantu kebutuhan ekonomi individu maupun komunitas.'
            ],
            [
                'id'          => 5,
                'nama_bantuan'  => 'Bantuan biaya kesehatan',
                'deskripsi'   => 'Infak yang dialokasikan untuk membantu biaya pengobatan dan kesehatan.'
            ],
            [
                'id'          => 6,
                'nama_bantuan'  => 'Bantuan biaya hutang piutang',
                'deskripsi'   => 'Infak yang diberikan untuk membantu pelunasan hutang/piutang mustahik.'
            ],
            [
                'id'          => 7,
                'nama_bantuan'  => 'Bantuan Biaya Dakwah Keagamaan',
                'deskripsi'   => 'Infak yang digunakan untuk mendukung kegiatan dakwah dan keagamaan.'
            ],
            [
                'id'          => 8,
                'nama_bantuan'  => 'Bantuan Biaya Kemanusiaan',
                'deskripsi'   => 'Infak untuk membantu korban bencana, konflik, dan kebutuhan kemanusiaan lainnya.'
            ],
        ];

        $this->db->table('jenis_bantuan')->insertBatch($data);
    }
}
