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

$routes->get('/pengguna', 'Pengguna::index');
$routes->get('/pengguna/table', 'Pengguna::table');
$routes->post('/pengguna/add', 'Pengguna::add');
$routes->post('/pengguna/edit/(:segment)', 'Pengguna::edit/$1');
$routes->post('/pengguna/login/(:segment)', 'Pengguna::editLogin/$1');
$routes->post('/pengguna/reset/(:segment)', 'Pengguna::resetPassword/$1');
$routes->post('/pengguna/delete', 'Pengguna::delete');
$routes->get('/pengguna/detail/(:segment)', 'Pengguna::Detail/$1');
$routes->get('/pengguna/detail/(:segment)', 'Pengguna::detail/$1');
$routes->get('/pengguna/pengaturan/(:segment)', 'Pengguna::pengaturan/$1');

$routes->get('/matkul', 'Matkul::index');
$routes->get('/matkul/table', 'Matkul::tableMatkulDosen');
$routes->post('/matkul/add', 'Matkul::add');
$routes->post('/matkul/edit/(:segment)', 'Matkul::edit/$1');
$routes->post('/matkul/delete', 'Matkul::delete');
$routes->get('/matkul/mahasiswa/(:segment)', 'Matkul::mahasiswa/$1');
$routes->post('/matkul/mahasiswa/table', 'Matkul::tableMahasiswa');
$routes->get('/matkul/agenda/(:segment)', 'Matkul::agenda/$1');
$routes->post('/matkul/agenda/table', 'Matkul::tableAgendaDosen');
$routes->post('/matkul/agenda/simpan', 'Matkul::simpanAgenda');
$routes->post('/matkul/agenda/delete', 'Matkul::deleteAgenda');
$routes->get('/matkul/pengaturan/(:segment)', 'Matkul::pengaturan/$1');
$routes->get('/matkul/qr/(:segment)', 'Matkul::indexQR/$1');
$routes->post('/matkul/qr', 'Matkul::statusPresent');

$routes->get('/matkul/list', 'Matkul::indexListMatkul');
$routes->get('/matkul/list/table', 'Matkul::tableMatkulMahasiswa');
$routes->post('/matkul/join', 'Matkul::joinMatkul');

$routes->get('/matkul/saya', 'Matkul::indexMatkulSaya');
$routes->get('/matkul/saya/table', 'Matkul::tableMatkulSaya');
$routes->post('/matkul/keluar', 'Matkul::keluarMatkul');
$routes->post('/matkul/deletemhs', 'Matkul::deletemhs');

$routes->get('/agenda', 'Matkul::indexAgendaMahasiswa');
$routes->get('/agenda/table', 'Matkul::tableAgendaMahasiswa');


$routes->get('/scanner', 'Scanner::index');
$routes->post('/scanner/present', 'Matkul::changeStatus');
$routes->get('/thankyou/(:segment)/(:segment)', 'Matkul::thankyouIndex/$1/$2');

$routes->get('/profil/detail', 'Pengguna::deletemhs');
$routes->get('/profil/pengaturan', 'Pengguna::deletemhs');
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
