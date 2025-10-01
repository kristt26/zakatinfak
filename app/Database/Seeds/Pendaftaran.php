<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Pendaftaran extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // ambil id_mustahik dari tabel mustahik
        $mustahik = $this->db->table('mustahik')->get()->getResult();
        // ambil id_jenis_infak dari tabel jenis_infak
        $jenisInfak = $this->db->table('jenis_infak')->get()->getResult();
        // ambil id_persyaratan dari tabel persyaratan
        $persyaratan = $this->db->table('persyaratan')->get()->getResult();

        foreach ($mustahik as $m) {
            // tiap mustahik bisa punya 1–3 pendaftaran
            $jumlahPendaftaran = rand(1, 3);

            for ($i = 1; $i <= $jumlahPendaftaran; $i++) {
                $dataPendaftaran = [
                    'no_daftar'        => strtoupper($faker->bothify('DAF###??')),
                    'id_mustahik'      => $m->id,
                    'id_jenis_infak'   => $faker->randomElement($jenisInfak)->id,
                    'tanggal_daftar'   => $faker->date(),
                    'alasan'           => $faker->sentence(8),
                    'status_pengajuan' => $faker->randomElement(['diajukan', 'diverifikasi', 'disurvey', 'disetujui', 'ditolak']),
                ];
                $this->db->table('pendaftaran')->insert($dataPendaftaran);

                $idPendaftaran = $this->db->insertID();

                // kelengkapan: tiap pendaftaran bisa punya 2–4 dokumen persyaratan
                $jumlahKelengkapan = rand(2, 4);
                $persyaratanDipilih = $faker->randomElements($persyaratan, $jumlahKelengkapan);

                foreach ($persyaratanDipilih as $p) {
                    // pastikan folder ada
                    $folder = WRITEPATH . 'uploads/dokumen';
                    if (!is_dir($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    // buat nama file unik
                    $filename = 'syarat_' . uniqid() . '.jpg';
                    $filepath = $folder . '/' . $filename;

                    // download dari picsum.photos (masih aktif)
                    $imgData = file_get_contents("https://picsum.photos/640/480");
                    file_put_contents($filepath, $imgData);

                    // simpan ke database
                    $this->db->table('kelengkapan')->insert([
                        'id_persyaratan'  => $p->id,
                        'gambar'          => $filename, // hanya nama file
                        'id_pendaftaran'  => $idPendaftaran,
                    ]);
                }

                // hasil survey: 1 pendaftaran 1 survey
                $this->db->table('hasil_survey')->insert([
                    'id_pendaftaran' => $idPendaftaran,
                    'ekonomi'        => $faker->numberBetween(1, 5),
                    'kesehatan'      => $faker->numberBetween(1, 5),
                    'keimanan'       => $faker->numberBetween(1, 5),
                    'rekomendasi'    => $faker->randomElement(['layak', 'tidak', 'dipertimbangkan']),
                ]);
            }
        }
    }
}
