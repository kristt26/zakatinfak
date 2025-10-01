<?php namespace App\Models;

use CodeIgniter\Model;

class Sub_kriteriaModel extends Model
{
    protected $table            = 'sub_kriteria';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_sub','id_kriteria'];

    protected bool $allowEmptyInserts = false;
}
