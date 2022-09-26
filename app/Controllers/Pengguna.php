<?php

namespace App\Controllers;

use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Entities\User;
use Myth\Auth\Password;

class Pengguna extends BaseController
{
    protected $penggunaModel;
    protected $groupModel;
    protected $defaultPassword;
    public function __construct()
    {
        $this->penggunaModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->defaultPassword = 'AmasJaya123';
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
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'role' => $this->request->getPost('role'),
            'password_hash' => Password::hash($this->defaultPassword),
        ];

        if (!$this->validateData($data, $this->penggunaModel->getValidationRules(), $this->penggunaModel->getValidationMessages())) {
            $msg = [
                'pesan' => $this->validator->listErrors(),
            ];
        } else {
            $this->penggunaModel->withGroup($data['role'])->save($data);
            $msg = [
                'pesan' => 'sukses'
            ];
        }
        return json_encode($msg);
    }
}
