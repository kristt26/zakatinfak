<?php namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table            = 'kriteria';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kriteria','bobot'];

    protected bool $allowEmptyInserts = false;
}
