<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_daftar', 'id_mustahik', 'id_jenis_bantuan', 'tanggal_daftar', 'alasan', 'status_pengajuan', 'pesan'];

    protected bool $allowEmptyInserts = false;
    public function getLaporan($dari, $sampai)
    {
        $dari = $post['dari_tanggal'] ?? '';
        $sampai = $post['sampai_tanggal'] ?? '';
        $db = \Config\Database::connect();
        $builder = $db->table('pendaftaran o');
        $builder->select('o.id, o.no_daftar AS invoice, o.tanggal_daftar AS tanggal, m.nama AS nama_mustahik, o.status_pengajuan, k.nama_bantuan');
        $builder->join('mustahik m', 'm.id = o.id_mustahik', 'left');
        $builder->join('jenis_bantuan k', 'k.id = o.id_jenis_bantuan', 'left');
        if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
            $builder->where("DATE(o.tanggal_daftar) >=", $dari);
            $builder->where("DATE(o.tanggal_daftar) <=", $sampai);
        }
        $builder->where("o.status_pengajuan", "disetujui");
        $builder->orderBy('o.tanggal_daftar', 'DESC');
        $data = $builder->get()->getResult();
        foreach ($data as $key => $value) {
            $value->rekomendasi = $builder = $db->table('rekomendasi')->select('kriteria.nama_kriteria, rekomendasi.rekap')
                ->join('kriteria', 'kriteria.id = rekomendasi.id_kriteria')
                ->where('id_pendaftaran', $value->id)->get()->getResult();
        }
        return $data;
    }
}
