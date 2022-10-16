<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaMatkulModel extends Model
{
    protected $table      = 'mahasiswa_matkul';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_matkul','deleted_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    public function showMahasiswa($id_matkul)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('mahasiswa_matkul.id as idMahasiswaMatkul,users.*, badge')->join('users', 'users.id=mahasiswa_matkul.id_user', 'left')->join('auth_groups_users', 'auth_groups_users.user_id=users.id', 'left')->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id', 'left')->where('id_matkul', $id_matkul)->where('mahasiswa_matkul.deleted_at', null)->orderBy('users.npm', 'asc')->orderBy('users.first_name', 'asc')->orderBy('users.last_name', 'asc');
        $data = $query->get()->getResultObject();

        return $data;
    }

    public function showMatkul($idUser)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('matkul.*')->join('matkul', 'matkul.id=mahasiswa_matkul.id_matkul', 'left')->where('mahasiswa_matkul.id_user', $idUser)->where('mahasiswa_matkul.deleted_at', null)->orderBy('matkul.nama', 'asc')->orderBy('mahasiswa_matkul.id', 'asc');
        $data = $query->get()->getResultObject();

        return $data;
    }
}
