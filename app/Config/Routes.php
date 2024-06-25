<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/daftar', 'Auth::daftar');
$routes->post('/daftar', 'Auth::daftar');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'sessionFilter'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    
    $routes->get('rekening', 'Rekening::index');
    $routes->post('rekening/insert', 'Rekening::insert');
    $routes->post('rekening/update', 'Rekening::update');
    $routes->get('rekening/delete/(:num)', 'Rekening::delete/$1');
    
    $routes->get('pengguna', 'Pengguna::index');
    $routes->post('pengguna/insert', 'Pengguna::insert');
    $routes->post('pengguna/update', 'Pengguna::update');
    $routes->get('pengguna/delete/(:num)', 'Pengguna::delete/$1');

    $routes->get('kategori', 'Kategori::index');
    $routes->post('kategori/insert', 'Kategori::insert');
    $routes->post('kategori/update', 'Kategori::update');
    $routes->get('kategori/delete/(:num)', 'Kategori::delete/$1');

    $routes->get('keuangan', 'Keuangan::index');
    $routes->post('keuangan/insert', 'Keuangan::insert');
    $routes->post('keuangan/update', 'Keuangan::update');
    $routes->get('keuangan/delete/(:num)', 'Keuangan::delete/$1');
    $routes->get('keuangan/kategori/(:any)', 'Keuangan::kategori/$1');

    $routes->get('laporan/catatan', 'Laporan::catatan');
    $routes->post('laporan/export/(:any)', 'Laporan::export/$1');
    $routes->post('laporan/update', 'Laporan::update');
    $routes->get('laporan/delete/(:num)', 'Laporan::delete/$1');
});


$routes->get('/api/daftar', 'Api\Auth::daftar');
$routes->post('/api/daftar', 'Api\Auth::daftar');
$routes->get('/api/login', 'Api\Auth::login');
$routes->post('/api/login', 'Api\Auth::login');
$routes->get('/api/logout', 'Api\Auth::logout');

$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'jwt'], function($routes) {

    $routes->get('rekening', 'Rekening::index');
    $routes->post('rekening/add', 'Rekening::add');
    $routes->post('rekening/update', 'Rekening::update');
    $routes->delete('rekening/(:num)', 'Rekening::delete/$1');

    $routes->get('kategori', 'Kategori::index');
    $routes->post('kategori/add', 'Kategori::add');
    $routes->post('kategori/update', 'Kategori::update');
    $routes->delete('kategori/(:num)', 'Kategori::delete/$1');

    $routes->get('keuangan', 'Keuangan::index');
    $routes->get('keuangan/info', 'Keuangan::info');
    $routes->post('keuangan/add', 'Keuangan::add');
    $routes->post('keuangan/update', 'Keuangan::update');
    $routes->delete('keuangan/(:num)', 'Keuangan::delete/$1');
    $routes->get('keuangan/kategori/(:any)', 'Keuangan::kategori/$1');
});


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
