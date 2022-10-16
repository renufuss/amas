<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table      = 'agenda';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'jam_masuk', 'jam_telat', 'jam_selesai', 'id_matkul', 'qr'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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

    public function showAgenda($idMatkul)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('agenda.*,matkul.*')->join('matkul', 'agenda.id_matkul=matkul.id')->whereIn('agenda.id_matkul', $idMatkul)->where('agenda.deleted_at', null)->where('matkul.deleted_at', null);
        $data = $query->get()->getResultObject();

        return $data;
    }
}
