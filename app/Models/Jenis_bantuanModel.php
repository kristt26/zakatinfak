<?php namespace App\Models;

use CodeIgniter\Model;

class Jenis_bantuanModel extends Model
{
    protected $table            = 'jenis_bantuan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_bantuan','deskripsi'];

    protected bool $allowEmptyInserts = false;
}
