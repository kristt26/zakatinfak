<?php namespace App\Models;

use CodeIgniter\Model;

class RekomendasiModel extends Model
{
    protected $table            = 'rekomendasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pendaftaran','id_kriteria','rekap'];

    protected bool $allowEmptyInserts = false;
}
