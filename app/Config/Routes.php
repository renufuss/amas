<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/pengguna', 'Pengguna::index', ['filter' => 'role:Admin']);
$routes->get('/pengguna/table', 'Pengguna::table', ['filter' => 'role:Admin']);
$routes->post('/pengguna/add', 'Pengguna::add', ['filter' => 'role:Admin']);
$routes->post('/pengguna/edit/(:segment)', 'Pengguna::edit/$1');
$routes->post('/pengguna/login/(:segment)', 'Pengguna::editLogin/$1', ['filter' => 'role:Admin']);
$routes->post('/pengguna/reset/(:segment)', 'Pengguna::resetPassword/$1', ['filter' => 'role:Admin']);
$routes->post('/pengguna/delete', 'Pengguna::delete', ['filter' => 'role:Admin']);
$routes->get('/pengguna/detail/(:segment)', 'Pengguna::detail/$1', ['filter' => 'role:Admin']);
$routes->get('/pengguna/pengaturan/(:segment)', 'Pengguna::pengaturan/$1', ['filter' => 'role:Admin']);

$routes->get('/matkul', 'Matkul::index', ['filter' => 'role:Admin, Dosen']);
$routes->get('/matkul/table', 'Matkul::tableMatkulDosen', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/add', 'Matkul::add', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/edit/(:segment)', 'Matkul::edit/$1', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/delete', 'Matkul::delete', ['filter' => 'role:Admin, Dosen']);
$routes->get('/matkul/mahasiswa/(:segment)', 'Matkul::mahasiswa/$1', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/mahasiswa/table', 'Matkul::tableMahasiswa', ['filter' => 'role:Admin, Dosen']);
$routes->get('/matkul/agenda/(:segment)', 'Matkul::agenda/$1', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/agenda/table', 'Matkul::tableAgendaDosen', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/agenda/simpan', 'Matkul::simpanAgenda', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/agenda/delete', 'Matkul::deleteAgenda', ['filter' => 'role:Admin, Dosen']);
$routes->get('/matkul/pengaturan/(:segment)', 'Matkul::pengaturan/$1', ['filter' => 'role:Admin, Dosen']);
$routes->get('/matkul/agenda/qr/(:segment)', 'Matkul::indexQR/$1', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/qr', 'Matkul::statusPresent', ['filter' => 'role:Admin, Dosen']);
$routes->get('/matkul/agenda/status/(:segment)', 'Matkul::listStatusMahasiswaIndex/$1', ['filter' => 'role:Admin, Dosen']);
$routes->post('/matkul/agenda/status/table', 'Matkul::tableStatusMahasiswa', ['filter' => 'role:Admin, Dosen']);

$routes->get('/matkul/list', 'Matkul::indexListMatkul', ['filter' => 'role:Admin, Mahasiswa']);
$routes->get('/matkul/list/table', 'Matkul::tableMatkulMahasiswa', ['filter' => 'role:Admin, Mahasiswa']);
$routes->post('/matkul/join', 'Matkul::joinMatkul', ['filter' => 'role:Admin, Mahasiswa']);

$routes->get('/matkul/saya', 'Matkul::indexMatkulSaya', ['filter' => 'role:Admin, Mahasiswa']);
$routes->get('/matkul/saya/table', 'Matkul::tableMatkulSaya', ['filter' => 'role:Admin, Mahasiswa']);
$routes->post('/matkul/keluar', 'Matkul::keluarMatkul');

$routes->get('/agenda', 'Matkul::indexAgendaMahasiswa', ['filter' => 'role:Admin, Mahasiswa']);
$routes->get('/agenda/table', 'Matkul::tableAgendaMahasiswa', ['filter' => 'role:Admin, Mahasiswa']);
$routes->post('/agenda/izin', 'Matkul::modalIzin', ['filter' => 'role:Admin, Mahasiswa']);
$routes->post('/agenda/izin/save', 'Matkul::ajukanIzin', ['filter' => 'role:Admin, Mahasiswa']);
$routes->post('/agenda/izin/terima', 'Matkul::acceptIzin', ['filter' => 'role:Admin, Dosen']);
$routes->post('/agenda/izin/tolak', 'Matkul::tolakIzin', ['filter' => 'role:Admin, Dosen']);


$routes->get('/scanner', 'Scanner::index', ['filter' => 'role:Admin, Mahasiswa']);
$routes->post('/scanner/present', 'Matkul::changeStatus', ['filter' => 'role:Admin, Mahasiswa']);
$routes->get('/thankyou/(:segment)/(:segment)', 'Matkul::thankyouIndex/$1/$2', ['filter' => 'role:Admin, Mahasiswa']);

$routes->get('/profil/detail', 'Pengguna::profil');
$routes->get('/profil/pengaturan', 'Pengguna::pengaturanprofil');
$routes->post('/profil/savepass', 'Pengguna::changePassword');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
