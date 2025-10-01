<?php namespace App\Models;

use CodeIgniter\Model;

class SurveyModel extends Model
{
    protected $table            = 'survey';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pendaftaran','id_pertanyaan','jawaban'];

    protected bool $allowEmptyInserts = false;
}
