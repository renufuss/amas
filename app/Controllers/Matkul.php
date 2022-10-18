<?php

namespace App\Controllers;

use App\Models\MahasiswaMatkulModel;
use App\Models\MatkulModel;
use App\Models\AgendaModel;

// QR Code
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Config\UrlEncryption;

class Matkul extends BaseController
{
    protected $matkulModel;
    protected $mahasiswaMatkulModel;
    protected $agendaModel;
    protected $urlEncryption;
    public function __construct()
    {
        $this->matkulModel = new MatkulModel();
        $this->mahasiswaMatkulModel = new MahasiswaMatkulModel();
        $this->agendaModel = new AgendaModel();
        $this->urlEncryption = new UrlEncryption();
    }

    // =====================================================================================
    // For Dosen
    public function index()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah',
        ];
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
            if (!$this->validateData($data, $this->matkulModel->getValidationRules(['except' => ['image_matkul']]), $this->matkulModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal menambahkan matkul',
                ];
            } else {
                $this->matkulModel->save($data);
                $msg = [
                    'data' => $data,
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
            'title' => 'Pengaturan | '. ucwords(strtolower($matkul->nama)),
            'breadcrumb' => 'Pengaturan Mata Kuliah',
            'matkul' => $matkul,
            'navMahasiswa' => false,
            'navAgenda' => false,
            'navPengaturan' => true,
        ];
        return view('Matkul/Pengaturan/index', $data);
    }
    // end CRUD
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
            'navAgenda' => false,
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

    // Agenda
    public function agenda($id)
    {
        $matkul = $this->matkulModel->showMatkul($id);
        if ($matkul == null) {
            return redirect()->to('/matkul');
        }
        $data = [
            'title' => 'Agenda | '.ucwords(strtolower($matkul->nama)),
            'breadcrumb' => 'Agenda Mata Kuliah',
            'matkul' => $matkul,
            'navMahasiswa' => false,
            'navAgenda' => true,
            'navPengaturan' => false,
        ];
        return view('Matkul/Agenda/index', $data);
    }

    public function tableAgenda()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $msg = [
                'data' => view('Matkul/Agenda/Table/tableAgenda')
            ];
            echo json_encode($msg);
        }
    }

    public function simpanAgenda()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            if (!$this->validateData($data, $this->agendaModel->getValidationRules(), $this->agendaModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal menambahkan agenda',
                ];
            } else {
                if ($data['jam_masuk']>$data['jam_telat']) {
                    $msg = [
                        'error' => 'Jam masuk tidak boleh melebihi jam telat',
                        'errormsg'=> 'Gagal menambahkan agenda',
                    ];
                    return json_encode($msg);
                }
                if ($data['jam_masuk']>$data['jam_selesai']) {
                    $msg = [
                        'error' => 'Jam masuk tidak boleh melebihi jam selesai',
                        'errormsg'=> 'Gagal menambahkan agenda',
                    ];
                    return json_encode($msg);
                }
                if ($data['jam_telat']>$data['jam_selesai']) {
                    $msg = [
                        'error' => 'Jam telat tidak boleh melebihi jam selesai',
                        'errormsg'=> 'Gagal menambahkan agenda',
                    ];
                    return json_encode($msg);
                }
                $this->agendaModel->save($data);

                //generate QR
                $writer = new PngWriter();

                // Create QR code
                $url = 'present/agenda';
                $qrCode = QrCode::create(base_url($this->urlEncryption->encryptUrl($url).'/'.$this->urlEncryption->encryptUrl($this->agendaModel->getInsertID())))
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize(300)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));

                // Create generic logo
                $logo = Logo::create(FCPATH .'/assets/amas/ALogo.png')
                    ->setResizeToWidth(50);

                // Create generic label
                $label = Label::create('Amas QrCode')
                    ->setTextColor(new Color(2, 40, 123));

                $result = $writer->write($qrCode, $logo, $label);

                //Name File QR
                $length = 5;
                $randomString = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
                $nameQR = date('d').date('m').date('y').$randomString.user()->id.$data['id_matkul'].$this->agendaModel->getInsertID().'.png';

                // Save PNG QR
                $result->saveToFile(FCPATH .'/assets/qr/'.$nameQR);

                // Save QR To Database
                $qr = [
                    'id' => $this->agendaModel->getInsertID(),
                    'qr' => $nameQR,
                ];
                $this->agendaModel->save($qr);

                $msg['sukses'] = 'Berhasil menambahkan agenda';
            }
            return json_encode($msg);
        }
    }




    // =====================================================================================
    // For Mahasiswa
    public function indexListMatkul()
    {
        $data= [
            'title' => 'Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah'
        ];
        return view('Matkul/indexListMatkul', $data);
    }

    public function tableMatkulMahasiswa()
    {
        if ($this->request->isAJAX()) {
            $data= [
                'tampildata' => $this->matkulModel->showMatkul(),
                'joinedMatkul' => $this->mahasiswaMatkulModel->where('id_user', user()->id)->findAll(),
            ];
            $msg = [
                'data' => view('Matkul/Table/tableListMatkul', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function joinMatkul()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $matkul = $this->matkulModel->find($id);

            if ($matkul == null) {
                $msg['error'] = 'Gagal join matkul';
                return json_encode($msg);
            }
            $data = [
                'id_user' => user()->id,
                'id_matkul' => $id,
            ];
            $this->mahasiswaMatkulModel->save($data);
            $msg['sukses'] = 'Berhasil bergabung dengan mata kuliah';
            return json_encode($msg);
        }
    }

    public function indexMatkulSaya()
    {
        $data= [
            'title' => 'Mata Kuliah Saya',
            'breadcrumb' => 'Mata Kuliah Saya'
        ];
        return view('Matkul/indexMatkulSaya', $data);
    }

    public function tableMatkulSaya()
    {
        if ($this->request->isAJAX()) {
            $data= [
                'tampildata' => $this->mahasiswaMatkulModel->showMatkul(user()->id),
            ];
            $msg = [
                'data' => view('Matkul/Table/tableMatkulSaya', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function keluarMatkul()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $matkul = $this->matkulModel->find($id);

            if ($matkul == null) {
                $msg['error'] = 'Gagal keluar matkul';
                return json_encode($msg);
            }
            $joined = $this->mahasiswaMatkulModel->where('id_user', user()->id)->where('id_matkul', $matkul->id)->first();

            if ($joined != null) {
                $this->mahasiswaMatkulModel->delete($joined->id);
                $msg['sukses'] = 'Berhasil keluar dari mata kuliah';
            } else {
                $msg['error'] = 'Gagal keluar matkul';
            }
            return json_encode($msg);
        }
    }
}
