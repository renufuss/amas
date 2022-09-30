<?php

namespace App\Controllers;

use App\Models\MatkulModel;

class Matkul extends BaseController
{
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
            $matkul = new MatkulModel();
            $data= [
                'tampildata' => $matkul->findAll()
            ];

            $msg = [
                'data' => view('Matkul/Table/tableMatkul', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('error');
        }
    }
}
