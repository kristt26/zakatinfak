<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Zakat extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $zakat = [];

        // id_muzaki dari 1 sampai 5 (karena ada 5 data muzaki)
        for ($muzakiId = 1; $muzakiId <= 5; $muzakiId++) {
            // setiap muzaki punya transaksi 2–5 kali
            $jumlahTransaksi = rand(2, 5);

            for ($i = 0; $i < $jumlahTransaksi; $i++) {
                $zakat[] = [
                    'jenis_zakat'      => $faker->randomElement(['fitrah', 'maal', 'infak', 'sedekah']),
                    'jumlah_bayar'     => $faker->numberBetween(50000, 5000000),
                    'tanggal_bayar'    => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'bukti_bayar'      => $faker->imageUrl(640, 480, 'business', true, 'Bukti'),
                    'status_transaksi' => $faker->randomElement(['pending', 'valid', 'ditolak']),
                    'id_muzaki'        => $muzakiId,
                ];
            }
        }

        $this->db->table('zakat')->insertBatch($zakat);
    }
}
