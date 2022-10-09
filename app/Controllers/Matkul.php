<?php

namespace App\Controllers;

use App\Models\MatkulModel;
use App\Models\MatModel;

class Matkul extends BaseController
{
    protected $matkulModel;
    public function __construct()
    {
        $this->matkulModel = new MatModel();
    }
    public function index()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah'];
        return view('Matkul/Dosen/index', $data);
    }

    public function tableMatkulDosen()
    {
        if ($this->request->isAJAX()) {
            $matkul = new MatkulModel();
            $data= [
                'tampildata' => $matkul->orderBy('nama', 'ASC')->findAll()
            ];

            $msg = [
                'data' => view('Matkul/Dosen/Table/tableMatkul', $data)
            ];

            echo json_encode($msg);
        }
    }
        //begin::CRUD
        public function add()
        {
            if ($this->request->isAJAX()) {
                $data = $this->request->getPost();
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
}
