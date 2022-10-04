<?php

namespace App\Controllers;

use Myth\Auth\Entities\User;
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
                'pengguna' => $this->penggunaModel->showPengguna(),
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
            $data = $this->request->getPost();
            $data['password_hash'] = Password::hash($this->defaultPassword);
            if (!$this->validateData($data, $this->penggunaModel->getValidationRules(['except' => ['image_profile']]), $this->penggunaModel->getValidationMessages())) {
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

    public function edit($username)
    {
        if ($this->request->isAJAX()) {
            $id = $this->penggunaModel->where('username', $username)->first()->id;
            $data = $this->request->getPost();
            $data['id'] = $id;
            $data['image_profile'] = $this->request->getFile('image_profile');
            if (!$this->validateData($data, $this->penggunaModel->getValidationRules(['except' => ['email','username','password_hash']]), $this->penggunaModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal mengupdate pengguna',
                ];
            } else {
                // image profile
                $newImage = $data['image_profile'];
                $oldImage = $this->penggunaModel->where('id', $id)->first()->image_profile;
                if ($newImage->getError() != 4) {
                    $newImage->move('assets/images/users', $newImage->getRandomName());
                    if ($oldImage != null && file_exists('assets/images/users/' . $oldImage)) {
                        unlink('assets/images/users/' . $oldImage); //Hapus image lama
                    }

                    // set nama image
                    $data['image_profile'] = $newImage->getName();
                } elseif ($data['avatar_remove'] == 1) {
                    if ($oldImage != null && file_exists('assets/images/users/' . $oldImage)) {
                        unlink('assets/images/users/' . $oldImage); //Hapus image lama
                    }
                    $data['image_profile'] = null;
                } else {
                    $data['image_profile'] = $oldImage;
                }

                // remove role
                $this->groupModel->removeUserFromAllGroups($id);

                // add role
                $this->groupModel->addUserToGroup($id, $this->groupModel->where('name', $data['role'])->first()->id);

                // save
                $this->penggunaModel->save($data);
                $msg = [
                    'data' => $data,
                    'sukses' => 'Berhasil mengupdate pengguna'
                ];
            }
            echo json_encode($msg);
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
        $pengguna = $this->penggunaModel->showPengguna($username);
        if ($pengguna == null) {
            return redirect()->to('/pengguna');
        }
        $data = [
            'title' => 'Pengguna | '. ucwords(strtolower($pengguna->username)),
            'breadcrumb' => 'Detail Pengguna',
            'navDetail' => true,
            'navPengaturan' => false,
            'pengguna' => $pengguna,
        ];

        return view('Pengguna/Detail/index', $data);
    }

    public function pengaturan($username)
    {
        $pengguna = $this->penggunaModel->showPengguna($username);
        if ($pengguna == null) {
            return redirect()->to('/pengguna');
        }
        $data = [
            'title' => 'Pengguna | '. ucwords(strtolower($pengguna->username)),
            'breadcrumb' => 'Pengaturan Pengguna',
            'navDetail' => false,
            'navPengaturan' => true,
            'pengguna' => $pengguna,
            'role' => $this->groupModel->orderBy('name', 'ASC')->findAll(),
        ];

        return view('Pengguna/Pengaturan/index', $data);
    }
}
