<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Blank';
        $data['breadcrumb'] = 'Blank';
        return view('Layout/index', $data);
    }
}
