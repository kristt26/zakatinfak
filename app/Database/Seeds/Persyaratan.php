<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Persyaratan extends Seeder
{
    public function run()
    {
        $persyaratan = [
            // 1. Bantuan Biaya Pendidikan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 1],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 1],
            ['nama_persyaratan' => 'Surat rekomendasi kampus / surat aktif kuliah', 'id_jenis_bantuan' => 1],
            ['nama_persyaratan' => 'Surat rekomendasi masjid', 'id_jenis_bantuan' => 1],
            ['nama_persyaratan' => 'Foto copy kartu keluarga', 'id_jenis_bantuan' => 1],
            ['nama_persyaratan' => 'Foto copy ktp dan ktp orang tua pemohon', 'id_jenis_bantuan' => 1],

            // 2. Bantuan Biaya Beasiswa
            ['nama_persyaratan' => 'Surat rekomendasi sekolah', 'id_jenis_bantuan' => 2],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 2],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 2],
            ['nama_persyaratan' => 'Foto copy ktp orang tua pemohon', 'id_jenis_bantuan' => 2],
            ['nama_persyaratan' => 'Foto copy raport dan transkip nilai', 'id_jenis_bantuan' => 2],

            // 3. Bantuan biaya pendidikan insidentil
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 3],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 3],
            ['nama_persyaratan' => 'Surat aktif kuliah', 'id_jenis_bantuan' => 3],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 3],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 3],
            ['nama_persyaratan' => 'Surat rincian tunggakan kampus/sekolah', 'id_jenis_bantuan' => 3],

            // 4. Bantuan biaya ekonomi
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 4],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 4],
            ['nama_persyaratan' => 'Surat rekomendasi masjid', 'id_jenis_bantuan' => 4],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 4],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 4],
            ['nama_persyaratan' => 'Rincian anggaran biaya kebutuhan usaha', 'id_jenis_bantuan' => 4],

            // 5. Bantuan biaya kesehatan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 5],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 5],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 5],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu', 'id_jenis_bantuan' => 5],
            ['nama_persyaratan' => 'Resume medis dari dokter/rumah sakit', 'id_jenis_bantuan' => 5],

            // 6. Bantuan biaya hutang piutang
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 6],
            ['nama_persyaratan' => 'Foto copy ktp pemohon', 'id_jenis_bantuan' => 6],
            ['nama_persyaratan' => 'Foto copy kartu keluarga pemohon', 'id_jenis_bantuan' => 6],
            ['nama_persyaratan' => 'Surat keterangan tidak mampu dari kantor lurah', 'id_jenis_bantuan' => 6],
            ['nama_persyaratan' => 'Surat pernyataan hutang piutang bermaterai', 'id_jenis_bantuan' => 6],
            ['nama_persyaratan' => 'Bukti kwitansi lainnya', 'id_jenis_bantuan' => 6],

            // 7. Bantuan Biaya Dakwah Keagamaan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 7],
            ['nama_persyaratan' => 'Foto copy identitas pemohon', 'id_jenis_bantuan' => 7],

            // 8. Bantuan Biaya Kemanusiaan
            ['nama_persyaratan' => 'Surat permohonan bantuan', 'id_jenis_bantuan' => 8],
            ['nama_persyaratan' => 'Terms of Reference / perencanaan kegiatan', 'id_jenis_bantuan' => 8],
        ];

        $this->db->table('persyaratan')->insertBatch($persyaratan);
    }
}
