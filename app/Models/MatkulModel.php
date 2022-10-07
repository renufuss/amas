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

    protected $allowedFields = ['nama', 'kode', 'kelas', 'id_user', 'image'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'nama'      => 'required|min_length[5]',
        'kode'      => 'required|min_length[5]',
        'kelas'     => 'required|min_length[3]',
        'image' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
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
        'image' => [
            'max_size' => 'Ukuran gambar tidak boleh melebihi 1 MB',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar',
        ],
    ];
    protected $skipValidation     = false;


    public function showMatkul($id = null)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('matkul.*, users.*, matkul.id as id')->join('users', 'users.id=matkul.id_user', 'left')->orderBy('matkul.nama', 'asc')->where('matkul.deleted_at', null);
        if ($id != null) {
            $data = $query->where('matkul.id', $id)->get()->getFirstRow();
        } else {
            $data = $query->get()->getResultObject();
        }
        return $data;
    }
}
