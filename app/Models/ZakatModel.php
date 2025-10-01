<?php

namespace App\Models;

use CodeIgniter\Model;

class ZakatModel extends Model
{
    protected $table            = 'zakat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_bayar', 'jumlah_bayar', 'tanggal_bayar', 'bukti_bayar', 'status_transaksi', 'id_muzaki', 'id_mustahik', 'id_kategori', 'pesan'];

    protected bool $allowEmptyInserts = false;

    public function getLaporan($dari, $sampai, $status = '')
    {
        $builder = $this->db->table('zakat o');

        // Select kolom-kolom yang diperlukan
        $builder->select('o.id, o.no_bayar AS invoice, o.tanggal_bayar AS tanggal, 
                      c.nama AS nama_muzaki, m.nama AS nama_mustahik, 
                      o.status_transaksi, o.jumlah_bayar, k.nama_kategori');
        $builder->join('muzaki c', 'c.id = o.id_muzaki', 'left');
        $builder->join('mustahik m', 'm.id = o.id_mustahik', 'left');
        $builder->join('kategori_zis k', 'k.id = o.id_kategori', 'left');

        // Filter tanggal
        if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
            $builder->where("DATE(o.tanggal_bayar) >=", $dari);
            $builder->where("DATE(o.tanggal_bayar) <=", $sampai);
        }

        $builder->where('o.status_transaksi', 'valid');

        $builder->orderBy('o.tanggal_bayar', 'ASC');

        return $builder->get()->getResultArray();
    }
}
