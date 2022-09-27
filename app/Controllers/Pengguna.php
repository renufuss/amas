<?php

namespace App\Controllers;

use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
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

    // begin::Table
    public function table()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'pengguna' => $this->penggunaModel->orderBy('username', 'ASC')->findAll(),
            ];
            $msg = [
            'table' => view('Pengguna/Table/tablePengguna', $data),
            ];
            echo json_encode($msg);
        }
    }
    // end::Table

    //begin::CRUD
    public function add()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'active' => 1,
                'role' => $this->request->getPost('role'),
                'password_hash' => Password::hash($this->defaultPassword),
            ];

            if (!$this->validateData($data, $this->penggunaModel->getValidationRules(), $this->penggunaModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal menambahkan pengguna',
                ];
            } else {
                $this->penggunaModel->withGroup($data['role'])->save($data);
                $msg = [
                    'sukses' => 'Berhasil menambahkan pengguna'
                ];
            }
            return json_encode($msg);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $pengguna = $this->penggunaModel->find($id);
            if ($pengguna != null) {
                $this->penggunaModel->delete($id);
                $msg['sukses'] = 'Berhasil menghapus pengguna';
            } else {
                $msg['error'] = 'Gagal menghapus pengguna';
            }
            return json_encode($msg);
        }
    }
    // end::CRUD

    public function detail($username)
    {
        $pengguna = $this->penggunaModel->where('username', $username)->first();
        $data = [
            'title' => 'Pengguna | '. ucwords(strtolower($pengguna->username)),
            'breadcrumb' => 'Detail Pengguna',
            'username' => ucwords(strtolower($pengguna->username)),
            'email' => ucwords(strtolower($pengguna->email)),
            'firstName' => ucwords(strtolower($pengguna->first_name)),
            'lastName' => ucwords(strtolower($pengguna->last_name)),
        ];

        return view('Pengguna/Detail/index', $data);
    }
}
