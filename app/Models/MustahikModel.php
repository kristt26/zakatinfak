<?php namespace App\Models;

use CodeIgniter\Model;

class MustahikModel extends Model
{
    protected $table            = 'mustahik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','nik','alamat','telepon','pekerjaan','penghasilan','email','id_users'];

    protected bool $allowEmptyInserts = false;
}
