<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaAgenda extends Model
{
    protected $table      = 'mahasiswa_agenda';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_mahasiswa_matkul','id_agenda','status'];

    protected $useTimestamps = false;
    protected $createdField  = false;
    protected $updatedField  = false;
    protected $deletedField  = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}
