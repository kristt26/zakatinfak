<?php namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table            = 'petugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','jabatan','id_users'];

    protected bool $allowEmptyInserts = false;
}
