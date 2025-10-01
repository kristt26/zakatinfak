<?php namespace App\Models;

use CodeIgniter\Model;

class MigrationsModel extends Model
{
    protected $table            = 'migrations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['version','class','group','namespace','time','batch'];

    protected bool $allowEmptyInserts = false;
}
