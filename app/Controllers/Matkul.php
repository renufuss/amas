<?php

namespace App\Controllers;

use App\Models\MahasiswaMatkulModel;
use App\Models\MatkulModel;
use App\Models\AgendaModel;
use App\Models\MahasiswaAgenda;
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
    protected $mahasiswaAgendaModel;
    public function __construct()
    {
        $this->matkulModel = new MatkulModel();
        $this->mahasiswaMatkulModel = new MahasiswaMatkulModel();
        $this->agendaModel = new AgendaModel();
        $this->urlEncryption = new UrlEncryption();
        $this->mahasiswaAgendaModel = new MahasiswaAgenda();
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

    public function tableAgendaDosen()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'agenda' => $this->agendaModel->where('id_matkul', $id)->findAll(),
            ];
            $msg = [
                'data' => view('Matkul/Agenda/Table/tableAgendaDosen', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanAgenda()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            if ($id != null || $id != '') {
                $data['id'] = $id;
            }
            $data = $this->request->getPost();
            if (!$this->validateData($data, $this->agendaModel->getValidationRules(), $this->agendaModel->getValidationMessages())) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'errormsg'=> 'Gagal menambahkan agenda',
                ];
            } else {
                if ($data['jam_masuk']>=$data['jam_telat']) {
                    $msg = [
                        'error' => [
                            'jam_masuk' => 'Jam masuk tidak boleh melebihi jam telat',
                        ],
                        'errormsg'=> 'Gagal menambahkan agenda',
                    ];
                    return json_encode($msg);
                }
                if ($data['jam_masuk']>=$data['jam_selesai']) {
                    $msg = [
                        'error' => [
                            'jam_masuk' => 'Jam masuk tidak boleh melebihi jam selesai',
                        ],
                        'errormsg'=> 'Gagal menambahkan agenda',
                    ];
                    return json_encode($msg);
                }
                if ($data['jam_telat']>=$data['jam_selesai']) {
                    $msg = [
                        'error' => [
                            'jam_telat' => 'Jam telat tidak boleh melebihi jam selesai',
                        ],
                        'errormsg'=> 'Gagal menambahkan agenda',
                    ];
                    return json_encode($msg);
                }
                $this->agendaModel->save($data);
                $msg['sukses'] = 'Berhasil menyimpan agenda';

                if ($id != null) { //kalau edit, tidak generate qr
                    return json_encode($msg);
                }

                //generate QR
                $writer = new PngWriter();

                // Create QR code
                $qrCode = QrCode::create($this->urlEncryption->encryptUrl($this->agendaModel->getInsertID()))
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize(800)
                    ->setMargin(50)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setForegroundColor(new Color(22, 169, 248))
                    ->setBackgroundColor(new Color(241, 250, 255));

                // Create generic logo
                $logo = Logo::create(FCPATH .'/assets/amas/default_logo_qr.png')
                    ->setResizeToWidth(200);

                // Create generic label
                $label = Label::create('Amas QrCode')
                    ->setTextColor(new Color(22, 169, 248));

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
            }
            return json_encode($msg);
        }
    }

    public function deleteAgenda()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $matkul = $this->agendaModel->find($id);
            if ($matkul != null) {
                $this->agendaModel->delete($id);
                $msg['sukses'] = 'Berhasil menghapus agenda';
            } else {
                $msg['error'] = 'Gagal menghapus agenda';
            }
            return json_encode($msg);
        }
    }

    public function indexQR($id)
    {
        $agenda = $this->agendaModel->find($id);
        if ($agenda == null) {
            return redirect()->to('/agenda');
        }
        $data = [
            'title' => 'Agenda | '.ucwords(strtolower($agenda->name)),
            'breadcrumb' => 'QR Mata Kuliah',
            'agenda' => $agenda,
        ];
        return view('Matkul/Agenda/QR/index', $data);
    }

    public function statusPresent()
    {
        if ($this->request->isAJAX()) {
            $agenda = $this->agendaModel->find($this->request->getPost('id'));
            $idMatkul = $agenda->id_matkul;
            $mahasiswa = $this->mahasiswaMatkulModel->showMahasiswa($idMatkul);
            $cekStatus = $this->mahasiswaAgendaModel->where('id_agenda', $agenda->id)->findAll();
            $izin = [];
            $terlambat = [];
            $hadir = [];
            $belum_absen = [];
            if ($mahasiswa != null) {
                foreach ($mahasiswa as $mhsRow) {
                    if ($cekStatus != null) {
                        foreach ($cekStatus as $cekRow) {
                            if ($mhsRow->idMahasiswaMatkul == $cekRow->id_mahasiswa_matkul && $cekRow->status == 1) {
                                array_push($izin, $mhsRow);
                            } elseif ($mhsRow->idMahasiswaMatkul == $cekRow->id_mahasiswa_matkul && $cekRow->status == 2) {
                                array_push($terlambat, $mhsRow);
                            } elseif ($mhsRow->idMahasiswaMatkul == $cekRow->id_mahasiswa_matkul && $cekRow->status == 4) {
                                array_push($hadir, $mhsRow);
                            } else {
                                array_push($belum_absen, $mhsRow);
                            }
                        }
                    } else {
                        array_push($belum_absen, $mhsRow);
                    }
                }
            }

            $data = [
                'izin' => $izin,
                'terlambat' => $terlambat,
                'hadir' => $hadir,
                'belum_absen' => $belum_absen,
            ];
            $msg = [
                'izin' => view('Matkul/Agenda/QR/listMahasiswaStatus/listMahasiswaIzin', $data),
                'terlambat' => view('Matkul/Agenda/QR/listMahasiswaStatus/listMahasiswaTerlambat', $data),
                'hadir' => view('Matkul/Agenda/QR/listMahasiswaStatus/listMahasiswaHadir', $data),
                'belum_absen' => view('Matkul/Agenda/QR/listMahasiswaStatus/listMahasiswaBelumAbsen', $data),
            ];
            return json_encode($msg);
        }
    }

    public function changeStatus()
    {
        if ($this->request->isAJAX()) {
            $idAgenda = $this->request->getPost('id');
            $id = $this->urlEncryption->decryptUrl($idAgenda);
            $agenda = $this->agendaModel->find($id);
            if ($agenda != null) {
                $cekJoinMatkul = $this->mahasiswaMatkulModel->where('id_matkul', $agenda->id_matkul)->where('id_user', user()->id)->first();
                if ($cekJoinMatkul != null) {
                    $cekStatusPresensi = $this->mahasiswaAgendaModel->where('id_mahasiswa_matkul', $cekJoinMatkul->id)->where('id_agenda', $agenda->id)->first();
                    if ($cekStatusPresensi != null && $cekStatusPresensi->status != 4) {
                        $data['id'] = $cekStatusPresensi->id;
                    } elseif ($cekStatusPresensi != null && $cekStatusPresensi->status == 4) {
                        $msg['error'] = 'Anda sudah melakukan presensi, anda tidak perlu mengulangi presensi...';
                        return json_encode($msg);
                    }
                    if (date('Y-m-d H:i:s') < $agenda->jam_masuk) {
                        $msg['error'] = 'Anda belum bisa melakukan presensi...';
                        return json_encode($msg);
                    } elseif (date('Y-m-d H:i:s') > $agenda->jam_telat && date('Y-m-d H:i:s') <= $agenda->jam_selesai) {
                        $data['status'] = 2;
                    } elseif (date('Y-m-d H:i:s') > $agenda->jam_selesai) {
                        $msg['error'] = 'Anda tidak bisa melakukan presensi, karena waktu sudah berakhir...';
                        return json_encode($msg);
                    } elseif (date('Y-m-d H:i:s') >= $agenda->jam_masuk && date('Y-m-d H:i:s') < $agenda->jam_telat) {
                        $data['status'] = 4;
                    }
                    $data['id_mahasiswa_matkul'] = $cekJoinMatkul->id;
                    $data['id_agenda'] = $agenda->id;
                    $msg['sukses'] = 'Berhasil melakukan presensi';
                    $this->mahasiswaAgendaModel->save($data);

                    $idMahasiswaAgenda = $this->urlEncryption->encryptUrl($this->mahasiswaAgendaModel->where('id_mahasiswa_matkul', $cekJoinMatkul->id)->where('id_agenda', $agenda->id)->first()->id);
                    $msg = [
                        'sukses' => 'Sukses melakukan presensi',
                        'idAgenda' => $idAgenda,
                        'idMahasiswaAgenda' => $idMahasiswaAgenda,
                    ];
                    return json_encode($msg);
                } else {
                    $msg['error'] = 'Gagal melakukan presensi, Agenda belum tergabung mata kuliah...';
                    return json_encode($msg);
                }
            } else {
                $msg['error'] = 'Gagal melakukan presensi, Agenda tidak ditemukan...';
                return json_encode($msg);
            }
        }
    }

    public function thankyouIndex($idAgenda, $idMahasiswaAgenda)
    {
        $idAgenda = $this->urlEncryption->decryptUrl($idAgenda);
        $idMahasiswaAgenda = $this->urlEncryption->decryptUrl($idMahasiswaAgenda);
        $agenda = $this->agendaModel->find($idAgenda);
        $mahasiswaAgenda = $this->mahasiswaAgendaModel->find($idMahasiswaAgenda);
        if ($idAgenda == false || $idMahasiswaAgenda == false) {
            return redirect()->to(base_url());
        } else {
            $cekJoinMatkul = $this->mahasiswaMatkulModel->where('id_matkul', $agenda->id_matkul)->where('id_user', user()->id)->first();
            if ($cekJoinMatkul->id != $mahasiswaAgenda->id_mahasiswa_matkul) {
                return redirect()->to(base_url());
            }
        }
        $data = [
            'agenda' => $agenda,
            'mahasiswaAgenda' => $mahasiswaAgenda,
        ];
        if ($mahasiswaAgenda->status == 4) {
            return view('Scanner/Thankyou/success', $data);
        } elseif ($mahasiswaAgenda->status == 2) {
            return view('Scanner/Thankyou/warning', $data);
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
            $cekJoin = $this->mahasiswaMatkulModel->where('id_user', user()->id)->where('id_matkul', $id)->withDeleted()->first();
            if ($cekJoin != null) {
                $idJoin = $cekJoin->id;
            } else {
                $idJoin = null;
            }
            $data = [
                'id' => $idJoin,
                'id_user' => user()->id,
                'id_matkul' => $id,
                'deleted_at' => null,
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
            $idMatkul = $this->request->getPost('idMatkul');
            $idMahasiswa = $this->request->getPost('idMahasiswa');
            $dosen = true;
            if ($idMahasiswa == null) {
                $idMahasiswa = user()->id;
                $dosen = false;
            }
            $matkul = $this->matkulModel->find($idMatkul);

            if ($matkul == null) {
                $msg['error'] = 'Gagal keluar matkul';
                return json_encode($msg);
            }
            $joined = $this->mahasiswaMatkulModel->where('id_user', $idMahasiswa)->where('id_matkul', $matkul->id)->first();

            if ($joined != null) {
                $this->mahasiswaMatkulModel->delete($joined->id);
                if ($dosen != true) {
                    $msg['sukses'] = 'Berhasil keluar dari mata kuliah';
                } else {
                    $msg['sukses'] = 'Berhasil menghapus mahasiswa';
                }
            } else {
                $msg['error'] = 'Gagal keluar matkul';
            }
            return json_encode($msg);
        }
    }

    public function indexAgendaMahasiswa()
    {
        $data= [
            'title' => 'Agenda',
            'breadcrumb' => 'Agenda'
        ];
        return view('Matkul/Agenda/indexAgendaMahasiswa', $data);
    }

    public function tableAgendaMahasiswa()
    {
        if ($this->request->isAJAX()) {
            $idUser = user()->id;
            $findMatkul = $this->mahasiswaMatkulModel->where('id_user', $idUser)->findColumn('id_matkul');
            $idMatkul = [];
            if ($findMatkul != null) {
                foreach ($findMatkul as $row) {
                    array_push($idMatkul, $row);
                }
            } else {
                $msg = [
                    'data' => '<br><br><span>Anda belum bergabung ke mata kuliah manapun, Silahkan bergabung ke mata kuliah untuk menampilkan agenda</span><br><br>
                    <span class = "text-danger">Sebentar lagi anda akan dialihkan ke halaman list mata kuliah...</span>',
                    'redirect'=>true,
                ];
                return json_encode($msg);
            }
            $agenda = $this->agendaModel->showAgenda($idMatkul);

            $data = [
                'agenda' => $agenda,
            ];
            $msg = [
                'data' => view('Matkul/Agenda/table/tableAgendaMahasiswa', $data)
            ];
            return json_encode($msg);
        }
    }
}
