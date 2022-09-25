<?php

namespace App\Controllers;

use Myth\Auth\Entities\Group;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class Pengguna extends BaseController
{
    protected $penggunaModel;
    protected $groupModel;
    public function __construct()
    {
        $this->penggunaModel = new UserModel();
        $this->groupModel = new GroupModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'breadcrumb' => 'Pengguna',
            'pengguna' => $this->penggunaModel->orderBy('username', 'ASC')->findAll(),
            'role' => $this->groupModel->orderBy('name', 'ASC')->findAll(),
        ];
        return view('Pengguna/index', $data);
    }

    //begin::CRUD
    public function add()
    {
        $validation = \Config\Services::validation();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'namaDepan' => $this->request->getPost('namaDepan'),
            'namaBelakang' => $this->request->getPost('namaBelakang'),
            'role' => $this->request->getPost('role'),
        ];
        if ($validation->run($data, 'pengguna')) {
            $msg = [
                'pesan' => 'sukses'
            ];
            echo json_encode($msg);
        } else {
            $msg = [
                'pesan' => 'gagal'
            ];
            echo json_encode($msg);
        }
    }
}
