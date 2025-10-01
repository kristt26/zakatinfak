<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Muzaki extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $muzaki = [];

        // user muzaki dimulai dari id 4 sampai 8
        for ($i = 4; $i <= 8; $i++) {
            $muzaki[] = [
                'nik'      => $faker->nik(),
                'nama'     => $faker->name,
                'alamat'   => $faker->address,
                'telepon'  => $faker->phoneNumber,
                'email'    => $faker->safeEmail,
                'id_users' => $i,
            ];
        }

        $this->db->table('muzaki')->insertBatch($muzaki);
    }
}
