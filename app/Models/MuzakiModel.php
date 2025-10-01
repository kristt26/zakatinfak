<?php namespace App\Models;

use CodeIgniter\Model;

class MuzakiModel extends Model
{
    protected $table            = 'muzaki';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nik','nama','alamat','telepon','email','id_users', 'penghasilan'];

    protected bool $allowEmptyInserts = false;
}
