<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        \Myth\Auth\Authentication\Passwords\ValidationRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $pengguna = [
        'username' => [
            'label' => 'Username',
            'rules' => 'required|is_unique[users.username,id,{id}]|alpha_numeric[5]',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'min_length' => 'Minimum karakter untuk {field} adalah 5 karakter',
                'is_unique' => '{field} sudah terdaftar',
                'alpha_numeric' => '{field} harus angka atau huruf'
            ]
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|is_unique[users.email,id,{id}]|valid_email',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'is_unique' => '{field} sudah terdaftar',
                'valid_email' => '{field} tidak valid'
            ]
        ],
        'namaDepan' => [
            'label' => 'Nama depan',
            'rules' => 'required|min_length[3]|alpha',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'min_length' => 'Minimum karakter untuk {field} adalah 3 karakter',
                'alpha' => '{field} harus huruf'
            ]
        ],
        'namaBelakang' => [
            'label' => 'Nama belakang',
            'rules' => 'required|min_length[3]|alpha',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'min_length' => 'Minimum karakter untuk {field} adalah 3 karakter',
                'alpha' => '{field} harus huruf'
            ]
        ],
        'role' => [
            'label' => 'Role',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],
    ];
}
