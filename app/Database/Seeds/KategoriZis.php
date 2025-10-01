<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriZis extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'nama_kategori' => 'Zakat',
                'keterangan'    => 'Kewajiban bagi muslim yang memenuhi syarat nisab dan haul, dengan aturan tertentu dan mustahik yang jelas.',
                'no_rekening'   => '1111-2222-3333-4444', // nomor rekening contoh
                'nama_bank'     => 'Bank ABC'
            ],
            [
                'id'            => 2,
                'nama_kategori' => 'Infak',
                'keterangan'    => 'Pengeluaran harta untuk kebaikan, nilainya bebas sesuai kemampuan, tidak terikat nisab maupun haul.',
                'no_rekening'   => '5555-6666-7777-8888',
                'nama_bank'     => 'Bank XYZ'
            ],
            [
                'id'            => 3,
                'nama_kategori' => 'Sedekah',
                'keterangan'    => 'Pemberian yang lebih luas, tidak hanya harta tetapi juga mencakup segala bentuk kebaikan, seperti senyum, tenaga, dan doa.',
                'no_rekening'   => '9999-0000-1111-2222',
                'nama_bank'     => 'Bank DEF'
            ],
        ];

        $this->db->table('kategori_zis')->insertBatch($data);
    }
}
