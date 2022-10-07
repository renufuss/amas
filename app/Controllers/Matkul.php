<?php

namespace App\Controllers;

use App\Models\MahasiswaMatkulModel;
use App\Models\MatkulModel;

class Matkul extends BaseController
{
    protected $matkulModel;
    protected $mahasiswaMatkulModel;
    public function __construct()
    {
        $this->matkulModel = new MatkulModel();
        $this->mahasiswaMatkulModel = new MahasiswaMatkulModel();
    }
    public function index()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah'];
        return view('Matkul/index', $data);
    }

    public function table()
    {
        if ($this->request->isAJAX()) {
            $data= [
                'tampildata' => $this->matkulModel->orderBy('nama', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('Matkul/Table/tableMatkul', $data)
            ];

            echo json_encode($msg);
        }
    }
    //begin::CRUD
    public function add()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            $data['id_user'] = user()->id;
            if (!$this->validateData($data, $this->matkulModel->getValidationRules(), $this->matkulModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal menambahkan matkul',
                ];
            } else {
                $this->matkulModel->save($data);
                $msg = [
                    'sukses' => 'Berhasil menambahkan matkul'
                ];
            }
            return json_encode($msg);
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $matkul = $this->matkulModel->find($id);
            if ($matkul != null) {
                $this->matkulModel->delete($id);
                $msg['sukses'] = 'Berhasil menghapus matkul';
            } else {
                $msg['error'] = 'Gagal menghapus matkul';
            }
            return json_encode($msg);
        }
    }

    public function mahasiswa($id)
    {
        $matkul = $this->matkulModel->showMatkul($id);
        if ($matkul == null) {
            return redirect()->to('/matkul');
        }
        $data = [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Detail Mata Kuliah',
            'matkul' => $matkul,
        ];
        return view('Matkul/Mahasiswa/index', $data);
    }

    public function tableMahasiswa()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data= [
                'mahasiswa' => $this->mahasiswaMatkulModel->showMahasiswa($id),
            ];

            $msg = [
                'data' => view('Matkul/Mahasiswa/Table/tableMahasiswa', $data)
            ];
            echo json_encode($msg);
        }
    }
}
