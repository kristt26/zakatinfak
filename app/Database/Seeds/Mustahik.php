<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Mustahik extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $mustahik = [];

        // user mustahik dimulai dari id 9 sampai 13
        for ($i = 9; $i <= 13; $i++) {
            $mustahik[] = [
                'nama'       => $faker->name,
                'nik'        => $faker->nik(),
                'alamat'     => $faker->address,
                'telepon'    => $faker->phoneNumber,
                'pekerjaan'  => $faker->jobTitle,
                'penghasilan' => $faker->randomElement(['< 1 juta', '1-3 juta', '3-5 juta', '> 5 juta']),
                'email'      => $faker->safeEmail,
                'id_users'   => $i,
            ];
        }

        $this->db->table('mustahik')->insertBatch($mustahik);
    }
}
