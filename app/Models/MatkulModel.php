<?php

namespace App\Models;

use CodeIgniter\Model;

class MatkulModel extends Model
{
    protected $table      = 'matkul';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nama', 'kode', 'kelas', 'id_user']; //yang diedit apa aja

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'nama'      => 'required|min_length[5]',
        'kode'      => 'required|min_length[5]',
        'kelas'     => 'required|min_length[3]',
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama matkul tidak boleh kosong',
            'min_length' => 'Nama matkul minimal berjumlah 5 karakter',
        ],
        'kode' => [
            'required' => 'Kode matkul tidak boleh kosong',
            'min_length' => 'Kode matkul minimal berjumlah 5 karakter',
        ],
        'kelas' => [
            'required' => 'Kelas tidak boleh kosong',
            'min_length' => 'Kelas minimal berjumlah 3 karakter',
        ],
    ];
    protected $skipValidation     = false;
}
