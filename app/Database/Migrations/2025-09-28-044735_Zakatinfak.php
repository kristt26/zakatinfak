<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Zakatinfak extends Migration
{
    public function up()
    {
        // 1. USERS
        $this->forge->addField([
            'id'        => ['type' => 'INT','auto_increment' => true],
            'username'  => ['type' => 'VARCHAR','constraint' => 50,'null' => true],
            'password'  => ['type' => 'VARCHAR','constraint' => 255,'null' => true],
            'akses'     => ['type' => 'ENUM','constraint' => ['admin','petugas','pimpinan','mustahik','muzaki'],'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // 2. petugas
        $this->forge->addField([
            'id'        => ['type' => 'INT','auto_increment' => true],
            'nama'      => ['type' => 'VARCHAR','constraint' => 100],
            'jabatan'     => ['type' => 'VARCHAR','constraint' => 50,'null' => true],
            'id_users'  => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_users', 'users', 'id');
        $this->forge->createTable('petugas');

        // 2. MUZAKI
        $this->forge->addField([
            'id'        => ['type' => 'INT','auto_increment' => true],
            'nik'       => ['type' => 'VARCHAR','constraint' => 16,'null' => true],
            'nama'      => ['type' => 'VARCHAR','constraint' => 100],
            'alamat'    => ['type' => 'TEXT','null' => true],
            'telepon'   => ['type' => 'VARCHAR','constraint' => 16,'null' => true],
            'penghasilan'=> ['type' => 'VARCHAR','constraint' => 50,'null' => true],
            'email'     => ['type' => 'VARCHAR','constraint' => 50,'null' => true],
            'id_users'  => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_users', 'users', 'id');
        $this->forge->createTable('muzaki');

        // 3. MUSTAHIK
        $this->forge->addField([
            'id'         => ['type' => 'INT','auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR','constraint' => 100],
            'nik'        => ['type' => 'VARCHAR','constraint' => 16,'null' => true],
            'alamat'     => ['type' => 'TEXT','null' => true],
            'telepon'    => ['type' => 'VARCHAR','constraint' => 16,'null' => true],
            'pekerjaan'  => ['type' => 'VARCHAR','constraint' => 45,'null' => true],
            'penghasilan'=> ['type' => 'VARCHAR','constraint' => 50,'null' => true],
            'email'      => ['type' => 'VARCHAR','constraint' => 45,'null' => true],
            'id_users'   => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_users', 'users', 'id');
        $this->forge->createTable('mustahik');

        // 4. JENIS BANTUAN
        $this->forge->addField([
            'id'           => ['type' => 'INT','auto_increment' => true], // sesuai SQL tidak auto_increment
            'nama_bantuan' => ['type' => 'VARCHAR','constraint' => 100,'null' => true],
            'deskripsi'    => ['type' => 'TEXT','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_bantuan');

        // 5. PERSYARATAN
        $this->forge->addField([
            'id'               => ['type' => 'INT','auto_increment' => true],
            'nama_persyaratan' => ['type' => 'VARCHAR','constraint' => 255,'null' => true],
            'id_jenis_bantuan'   => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_jenis_bantuan', 'jenis_bantuan', 'id');
        $this->forge->createTable('persyaratan');

        // 6. KATEGORI ZIS
        $this->forge->addField([
            'id'            => ['type' => 'INT','auto_increment' => true],
            'nama_kategori' => ['type' => 'VARCHAR','constraint' => 255,'null' => true],
            'no_rekening'   => ['type' => 'VARCHAR','constraint' => 255,'null' => true],
            'nama_bank'   => ['type' => 'VARCHAR','constraint' => 255,'null' => true],
            'keterangan'    => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori_zis');

        // 7. ZAKAT
        $this->forge->addField([
            'id'              => ['type' => 'INT','auto_increment' => true],
            'no_bayar'        => ['type' => 'VARCHAR','constraint' => 100,'null' => true],
            'jumlah_bayar'    => ['type' => 'DOUBLE','null' => true],
            'tanggal_bayar'   => ['type' => 'DATETIME','null' => true],
            'bukti_bayar'     => ['type' => 'VARCHAR','constraint' => 100,'null' => true],
            'status_transaksi'=> ['type' => 'ENUM','constraint' => ['pending','valid','ditolak'],'null' => true],
            'id_muzaki'       => ['type' => 'INT','null' => true],
            'id_mustahik'     => ['type' => 'INT','null' => true],
            'id_kategori'     => ['type' => 'INT'],
            'pesan'           => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_muzaki', 'muzaki', 'id');
        $this->forge->addForeignKey('id_mustahik', 'mustahik', 'id');
        $this->forge->addForeignKey('id_kategori', 'kategori_zis', 'id');
        $this->forge->createTable('zakat');

        // 8. PENDAFTARAN
        $this->forge->addField([
            'id'               => ['type' => 'INT','auto_increment' => true],
            'no_daftar'        => ['type' => 'VARCHAR','constraint' => 45,'null' => true],
            'id_mustahik'      => ['type' => 'INT'],
            'id_jenis_bantuan'   => ['type' => 'INT'],
            'tanggal_daftar'   => ['type' => 'DATE','null' => true],
            'alasan'           => ['type' => 'TEXT','null' => true],
            'status_pengajuan' => ['type' => 'ENUM','constraint' => ['diajukan','diverifikasi','disurvey','disetujui','ditolak'],'null' => true],
            'pesan'           => ['type' => 'TEXT','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_mustahik', 'mustahik', 'id');
        $this->forge->addForeignKey('id_jenis_bantuan', 'jenis_bantuan', 'id');
        $this->forge->createTable('pendaftaran');

        // 9. KELENGKAPAN
        $this->forge->addField([
            'id'             => ['type' => 'INT','auto_increment' => true],
            'id_persyaratan' => ['type' => 'INT'],
            'file'         => ['type' => 'VARCHAR','constraint' => 100,'null' => true],
            'id_pendaftaran' => ['type' => 'INT'],
            'status'  => ['type' => 'ENUM','constraint' => ['Valid','Tidak Valid'],'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_persyaratan', 'persyaratan', 'id');
        $this->forge->addForeignKey('id_pendaftaran', 'pendaftaran', 'id');
        $this->forge->createTable('kelengkapan');

        // 10. KRITERIA
        $this->forge->addField([
            'id'            => ['type' => 'INT','auto_increment' => true],
            'nama_kriteria' => ['type' => 'VARCHAR','constraint' => 45,'null' => true],
            'bobot'         => ['type' => 'DOUBLE','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kriteria');

        // 11. SUB KRITERIA
        $this->forge->addField([
            'id'         => ['type' => 'INT','auto_increment' => true],
            'nama_sub'   => ['type' => 'VARCHAR','constraint' => 100,'null' => true],
            'id_kriteria'=> ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id');
        $this->forge->createTable('sub_kriteria');

        // 12. PERTANYAAN
        $this->forge->addField([
            'id'              => ['type' => 'INT','auto_increment' => true],
            'pertanyaan'      => ['type' => 'VARCHAR','constraint' => 45,'null' => true],
            'opsi'         => ['type' => 'TEXT','null' => true],
            'type'         => ['type' => 'TEXT','null' => true],
            'id_sub_kriteria' => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_sub_kriteria', 'sub_kriteria', 'id');
        $this->forge->createTable('pertanyaan');

        // 13. SURVEY
        $this->forge->addField([
            'id'                     => ['type' => 'INT','auto_increment' => true],
            'id_pendaftaran'         => ['type' => 'INT'],
            'id_pertanyaan'          => ['type' => 'INT'],
            'jawaban'       => ['type' => 'VARCHAR','constraint' => 255,'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pendaftaran', 'pendaftaran', 'id');
        $this->forge->addForeignKey('id_pertanyaan', 'pertanyaan', 'id');
        $this->forge->createTable('survey');

        // 14. REKOMENDASI
        $this->forge->addField([
            'id'            => ['type' => 'INT','auto_increment' => true],
            'id_pendaftaran'=> ['type' => 'INT'],
            'id_kriteria'   => ['type' => 'INT'],
            'rekap'         => ['type' => 'INT','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pendaftaran', 'pendaftaran', 'id');
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id');
        $this->forge->createTable('rekomendasi');
    }

    public function down()
    {
        // drop dalam urutan terbalik
        $this->forge->dropTable('rekomendasi', true);
        $this->forge->dropTable('survey', true);
        $this->forge->dropTable('pertanyaan', true);
        $this->forge->dropTable('sub_kriteria', true);
        $this->forge->dropTable('kriteria', true);
        $this->forge->dropTable('kelengkapan', true);
        $this->forge->dropTable('pendaftaran', true);
        $this->forge->dropTable('zakat', true);
        $this->forge->dropTable('kategori_zis', true);
        $this->forge->dropTable('persyaratan', true);
        $this->forge->dropTable('jenis_bantuan', true);
        $this->forge->dropTable('mustahik', true);
        $this->forge->dropTable('muzaki', true);
        $this->forge->dropTable('petugas', true);
        $this->forge->dropTable('users', true);
    }
}
