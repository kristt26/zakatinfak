<?php namespace App\Models;

use CodeIgniter\Model;

class Kategori_zisModel extends Model
{
    protected $table            = 'kategori_zis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kategori','keterangan', 'no_rekening', 'nama_bank'];

    protected bool $allowEmptyInserts = false;
}
