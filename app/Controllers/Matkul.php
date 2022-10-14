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

    // =====================================================================================
    // For Dosen
    public function index()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah'];
        return view('Matkul/index', $data);
    }

    public function tableMatkulDosen()
    {
        if ($this->request->isAJAX()) {
            $data= [
                'tampildata' => $this->matkulModel->where('id_user', user()->id)->orderBy('nama', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('Matkul/Table/tableMatkulDosen', $data)
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

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $id = $this->matkulModel->where('id', $id)->first()->id;
            if ($id == null) {
                $msg['errormsg'] = 'Gagal mengupdate matkul';
                return json_encode($msg);
            }
            $data = $this->request->getPost();
            $data['id'] = $id;
            $data['image'] = $this->request->getFile('image_matkul');

            if (!$this->validateData($data, $this->matkulModel->getValidationRules(), $this->matkulModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal mengupdate matkul',
                ];
            } else {
                // image profile
                $newImage = $data['image'];
                $oldImage = $this->matkulModel->where('id', $id)->first()->image;
                if ($newImage->getError() != 4) {
                    $newImage->move('assets/images/matkul', $newImage->getRandomName());
                    if ($oldImage != null && file_exists('assets/images/matkul/' . $oldImage)) {
                        unlink('assets/images/matkul/' . $oldImage); //Hapus image lama
                    }

                    // set nama image
                    $data['image'] = $newImage->getName();
                } elseif ($data['avatar_remove'] == 1) {
                    if ($oldImage != null && file_exists('assets/images/matkul/' . $oldImage)) {
                        unlink('assets/images/matkul/' . $oldImage); //Hapus image lama
                    }
                    $data['image'] = null;
                } else {
                    $data['image'] = $oldImage;
                }

                // save
                $this->matkulModel->save($data);
                $msg = [
                    'sukses' => 'Berhasil mengupdate matkul'
                ];
            }
            echo json_encode($msg);
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

    public function pengaturan($id)
    {
        $matkul = $this->matkulModel->showMatkul($id);
        if ($matkul == null) {
            return redirect()->to('/matkul');
        }

        $data = [
            'title' => 'Matkul | '. ucwords(strtolower($matkul->nama)),
            'breadcrumb' => 'Pengaturan Mata Kuliah',
            'matkul' => $matkul,
            'navMahasiswa' => false,
            'navPengaturan' => true,
        ];
        return view('Matkul/Pengaturan/index', $data);
    }

    // Mahasiswa
    public function mahasiswa($id)
    {
        $matkul = $this->matkulModel->showMatkul($id);
        if ($matkul == null) {
            return redirect()->to('/matkul');
        }
        $data = [
            'title' => 'Mahasiswa | '.ucwords(strtolower($matkul->nama)),
            'breadcrumb' => 'Mahasiswa Mata Kuliah',
            'matkul' => $matkul,
            'navMahasiswa' => true,
            'navPengaturan' => false,
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

    public function deleteMhs()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_user');
            $mahasiswaMatkulModel = $this->mahasiswaMatkulModel->find($id);
            if ($mahasiswaMatkulModel != null) {
                $this->mahasiswaMatkulModel->deleteMhs($id);
                $msg['sukses'] = 'Berhasil menghapus mahasiswa';
            } else {
                $msg['error'] = 'Gagal menghapus mahasiswa';
            }
            return json_encode($msg);
        }
    }

    

    // =====================================================================================
    // For Mahasiswa
    public function indexMahasiswa()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah'];
        return view('Matkul/indexMahasiswa', $data);
    }

    public function tableMatkulMahasiswa()
    {
        if ($this->request->isAJAX()) {
            $data= [
                'tampildata' => $this->matkulModel->showMatkul(),
            ];
            $msg = [
                'data' => view('Matkul/Table/tableMatkulMahasiswa', $data)
            ];

            echo json_encode($msg);
        }
    }
}
