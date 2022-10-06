<?php

namespace App\Controllers;

use App\Models\MatkulModel;

class Matkul extends BaseController
{
    protected $matkulModel;
    public function __construct()
    {
        $this->matkulModel = new MatkulModel();
    }
    public function index()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah',
        ];
        return view('Matkul/index', $data);
    }

    public function table()
    {
        if ($this->request->isAJAX()) {
            $data= [
                'tampildata' => $this->matkulModel->where('id_user', user()->id)->orderBy('nama', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('Matkul/Table/tableMatkul', $data)
            ];

            echo json_encode($msg);
        }
    }
        //begin::CRUD
        public function save()
        {
            if ($this->request->isAJAX()) {
                $data = $this->request->getPost();
                $data['id_user'] = user()->id;
                $refresh = false;

               if($data['id'] != null || $data['id'] != '') {
                $matkul = $this->matkulModel->find($data['id']);
                $refresh = true;

                if($matkul == null || $matkul->id_user != user()->id) {
                    $msg['errorupdate'] = 'Gagal mengupdate matkul';
                    return json_encode($msg);
                }
               }

                if (!$this->validateData($data, $this->matkulModel->getValidationRules(), $this->matkulModel->getValidationMessages())) {
                    $msg = [
                        'error' => $this->validator->getErrors(),
                        'errormsg'=> 'Gagal menyimpan matkul',
                    ];
                } else {
                    $this->matkulModel->save($data);
                    $msg = [
                        'refresh' => $refresh,
                        'sukses' => 'Berhasil menyimpan matkul'
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
        public function modal(){
            if ($this->request->isAJAX()) {
                $id = $this->request->getPost('id');
                if($id!=null){
                    $matkul = $this->matkulModel->find($id);
                }else{
                    $id = 'null';
                    $matkul = null;
                }
                
                $data = [
                    'matkul'=>$matkul,
                ];

                $msg = [
                    'sukses' => view('Matkul/Modal/modalMatkul', $data),
                ];
                
                return json_encode($msg);
                
            }
        }

}
