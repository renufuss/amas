<?php
namespace App\Models;
use CodeIgniter\Model;
class MatModel extends Model
{
    protected $table          = 'matkul';
    protected $primaryKey     = 'id';
    protected $returnType     = Matkul::class;
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'nama', 'kode', 'kelas'
    ];
    protected $useTimestamps   = true;
    protected $validationRules = [
        'nama'      => 'required|min_length[5]',
        'kode'      => 'required|min_length[5]',
        'kelas'     => 'required|min_length[3]',
        'mulai'     => 'required',
        'selesai'   => 'required',
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
        'mulai' => [
            'required' => 'Masukkan jam mulai mata kuliah',
        ],
        'selesai' => [
            'required' => 'Masukkan jam selesai mata kuliah',
        ]
    ];
    protected $skipValidation     = true;
}
