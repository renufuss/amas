<?php

namespace App\Controllers;

class Scanner extends BaseController
{
    public function index()
    {
        $data= [
            'title' => 'Scanner',
            'breadcrumb' => 'Scanner',
        ];
        return view('Scanner/index', $data);
    }
}
