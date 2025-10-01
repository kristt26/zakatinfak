<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // ======================
        // 1. Insert Petugas Lengkap (Admin, Petugas, Pimpinan)
        // ======================
        $roles = [
            'Admin'    => 'admin',
            'Petugas'  => 'petugas',
            'Pimpinan' => 'pimpinan'
        ];

        foreach ($roles as $jabatan => $role) {
            $passwordPlain = $role . '123'; // password default sesuai role

            $this->db->table('users')->insert([
                'username' => $role,
                'password' => password_hash($passwordPlain, PASSWORD_DEFAULT),
                'akses'    => $role
            ]);
            $idUser = $this->db->insertID();

            $this->db->table('petugas')->insert([
                'nama'     => $faker->name,
                'jabatan'  => $jabatan,
                'id_users' => $idUser
            ]);
        }

        // ======================
        // 2. Insert 10 User Muzaki (users id = 4 - 13)
        // ======================
        for ($i = 1; $i <= 10; $i++) {
            $username = 'muzaki' . $i;

            $this->db->table('users')->insert([
                'username' => $username,
                'password' => password_hash('muzaki123', PASSWORD_DEFAULT),
                'akses'    => 'muzaki'
            ]);
            $idUser = $this->db->insertID();

            $this->db->table('muzaki')->insert([
                'nik'     => $faker->nik(),
                'nama'    => $faker->name,
                'alamat'  => $faker->address,
                'telepon' => $faker->phoneNumber,
                'email'   => $faker->safeEmail,
                'penghasilan' => $faker->randomElement(['5000000', '6000000', '7000000', '8000000', '9000000']),
                'id_users' => $idUser
            ]);
        }

        // ======================
        // 3. Insert 10 User Mustahik (users id = 14 - 23)
        // ======================
        for ($i = 1; $i <= 10; $i++) {
            $username = 'mustahik' . $i;

            $this->db->table('users')->insert([
                'username' => $username,
                'password' => password_hash('mustahik123', PASSWORD_DEFAULT),
                'akses'    => 'mustahik'
            ]);
            $idUser = $this->db->insertID();

            $this->db->table('mustahik')->insert([
                'nik'         => $faker->nik(),
                'nama'        => $faker->name,
                'alamat'      => $faker->address,
                'telepon'     => $faker->phoneNumber,
                'pekerjaan'   => $faker->jobTitle,
                'penghasilan' => $faker->randomElement(['5000000', '6000000', '7000000', '8000000', '9000000']),
                'email'       => $faker->safeEmail,
                'id_users'    => $idUser
            ]);
        }
        $this->call("JenisInfak");
        $this->call("Persyaratan");
        $this->call("KategoriZis");
        $this->call("Kriteria");
        $this->call("SubKriteria");
        $this->call("pertanyaan");
    }
}
