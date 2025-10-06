<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Persyaratan extends Seeder
{
    public function run()
    {
        $persyaratan = [
            // 1. Bantuan Biaya Pendidikan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 1, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 1, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat rekomendasi kampus / surat aktif kuliah', 'id_jenis_bantuan' => 1, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat rekomendasi masjid', 'id_jenis_bantuan' => 1, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy kartu keluarga', 'id_jenis_bantuan' => 1, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy ktp dan ktp orang tua pemohon', 'id_jenis_bantuan' => 1, 'jenis'=> 'gambar'],

            // 2. Bantuan Biaya Beasiswa
            ['nama_persyaratan' => 'Surat rekomendasi sekolah', 'id_jenis_bantuan' => 2, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 2, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 2, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy ktp orang tua pemohon', 'id_jenis_bantuan' => 2, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy raport dan transkip nilai', 'id_jenis_bantuan' => 2, 'jenis'=> 'gambar'],

            // 3. Bantuan biaya pendidikan insidentil
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 3, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 3, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat aktif kuliah', 'id_jenis_bantuan' => 3, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 3, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 3, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Surat rincian tunggakan kampus/sekolah', 'id_jenis_bantuan' => 3, 'jenis'=> 'surat'],

            // 4. Bantuan biaya ekonomi
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 4, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 4, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat rekomendasi masjid', 'id_jenis_bantuan' => 4, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 4, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 4, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Rincian anggaran biaya kebutuhan usaha', 'id_jenis_bantuan' => 4, 'jenis'=> 'all'],

            // 5. Bantuan biaya kesehatan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 5, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 5, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 5, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu', 'id_jenis_bantuan' => 5, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Resume medis dari dokter/rumah sakit', 'id_jenis_bantuan' => 5, 'jenis'=> 'gambar'],

            // 6. Bantuan biaya hutang piutang
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 6, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 6, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 6, 'jenis'=> 'gambar'],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 6, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Surat pernyataan hutang piutang bermaterai', 'id_jenis_bantuan' => 6, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Bukti kwitansi lainnya', 'id_jenis_bantuan' => 6, 'jenis'=> 'gambar'],

            // 7. Bantuan Biaya Dakwah Keagamaan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 7, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Foto copy identitas pemohon', 'id_jenis_bantuan' => 7, 'jenis'=> 'gambar'],

            // 8. Bantuan Biaya Kemanusiaan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 8, 'jenis'=> 'surat'],
            ['nama_persyaratan' => 'Terms of Reference / perencanaan kegiatan', 'id_jenis_bantuan' => 8, 'jenis'=> 'surat'],
        ];

        $this->db->table('persyaratan')->insertBatch($persyaratan);
    }
}
