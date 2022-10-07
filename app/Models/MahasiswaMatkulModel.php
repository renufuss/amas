<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaMatkulModel extends Model
{
    protected $table      = 'mahasiswa_matkul';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_user', 'id_matkul'];

    protected $useTimestamps = false;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function showMahasiswa($id_matkul)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('users.*')->join('users', 'users.id=mahasiswa_matkul.id_user', 'left')->where('id_matkul', $id_matkul)->orderBy('users.npm', 'asc')->orderBy('users.first_name', 'asc')->orderBy('users.last_name', 'asc');
        $data = $query->get()->getResultObject();

        return $data;
    }
}
