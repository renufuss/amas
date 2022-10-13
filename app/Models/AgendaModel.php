<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table      = 'agenda';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'jam_masuk', 'jam_telat', 'jam_selesai', 'id_matkul', 'qr'];

    protected $useTimestamps = false;
    protected $createdField  = false;
    protected $updatedField  = false;
    protected $deletedField  = false;

    protected $validationRules    = [
        'name'      => 'required',
        'jam_masuk'      => 'required',
        'jam_telat'     => 'required',
        'jam_selesai' => 'required',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Nama agenda tidak boleh kosong',
        ],
        'jam_masuk' => [
            'required' => 'Jam masuk agenda tidak boleh kosong',
        ],
        'jam_telat' => [
            'required' => 'Jam telat agenda tidak boleh kosong',
        ],
        'jam_selesai' => [
            'required' => 'Jam selesai agenda tidak boleh kosong',
        ],
    ];
    protected $skipValidation     = false;
}
