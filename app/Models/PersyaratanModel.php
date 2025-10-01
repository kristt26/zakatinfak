<?php namespace App\Models;

use CodeIgniter\Model;

class PersyaratanModel extends Model
{
    protected $table            = 'persyaratan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_persyaratan','id_jenis_bantuan'];

    protected bool $allowEmptyInserts = false;
}
