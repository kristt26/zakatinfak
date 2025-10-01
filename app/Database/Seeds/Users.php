<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'akses'    => 'admin',
            ],
            [
                'username' => 'petugas',
                'password' => password_hash('petugas123', PASSWORD_DEFAULT),
                'akses'    => 'petugas',
            ],
            [
                'username' => 'pimpinan',
                'password' => password_hash('pimpinan123', PASSWORD_DEFAULT),
                'akses'    => 'pimpinan',
            ],
        ];

        // Tambahkan 5 user untuk muzaki
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'username' => 'muzaki' . $i,
                'password' => password_hash('muzaki' . $i . '123', PASSWORD_DEFAULT),
                'akses'    => 'muzaki',
            ];
        }

        // Tambahkan 5 user untuk mustahik
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'username' => 'mustahik' . $i,
                'password' => password_hash('mustahik' . $i . '123', PASSWORD_DEFAULT),
                'akses'    => 'mustahik',
            ];
        }


        $this->db->table('users')->insertBatch($data);
    }
}
