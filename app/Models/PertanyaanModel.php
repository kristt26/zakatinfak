<?php namespace App\Models;

use CodeIgniter\Model;

class PertanyaanModel extends Model
{
    protected $table            = 'pertanyaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pertanyaan','pilihan','id_sub_kriteria'];

    protected bool $allowEmptyInserts = false;
}
