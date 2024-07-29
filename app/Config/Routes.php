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
$routes->setDefaultController('Homectrl');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
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

//ADMIN
$routes->get('login', 'Login::index');
$routes->post('login/process', 'Login::process');
$routes->get('logout', 'Login::logout');


// $routes->group('admin', ['filter' => 'usersAuth'], function ($routes) {
    // Daftarkan rute-rute admin di sini
    $routes->get('admin', 'admin\Dashboardctrl::routetoDashboard');
    $routes->get('admin/dashboard', 'admin\Dashboardctrl::index');

    $routes->get('admin/kategori/index', 'admin\Kategori::index');
    $routes->get('admin/kategori/tambah', 'admin\Kategori::tambah');
    $routes->post('admin/kategori/proses_tambah', 'admin\Kategori::proses_tambah');
    $routes->get('admin/kategori/edit/(:num)', 'admin\Kategori::edit/$1');
    $routes->post('admin/kategori/proses_edit/(:num)', 'admin\Kategori::proses_edit/$1');
    $routes->get('admin/kategori/delete/(:any)', 'admin\Kategori::delete/$1');
    
    $routes->get('admin/dpd/index', 'admin\DPD::index');
    $routes->get('admin/dpd/tambah', 'admin\DPD::tambah');
    $routes->post('admin/dpd/proses_tambah', 'admin\DPD::proses_tambah');
    $routes->get('admin/dpd/edit/(:num)', 'admin\DPD::edit/$1');
    $routes->post('admin/dpd/proses_edit/(:num)', 'admin\DPD::proses_edit/$1');
    $routes->get('admin/dpd/delete/(:any)', 'admin\DPD::delete/$1');
    
    $routes->get('admin/dpc/index', 'admin\DPC::index');
    $routes->get('admin/dpc/tambah', 'admin\DPC::tambah');
    $routes->post('admin/dpc/proses_tambah', 'admin\DPC::proses_tambah');
    $routes->get('admin/dpc/edit/(:num)', 'admin\DPC::edit/$1');
    $routes->post('admin/dpc/proses_edit/(:num)', 'admin\DPC::proses_edit/$1');
    $routes->get('admin/dpc/delete/(:any)', 'admin\DPC::delete/$1');

    $routes->get('admin/artikel/index', 'admin\Artikel::index');
    $routes->get('admin/artikel/detail/(:num)/(:any)', 'admin\Artikel::viewArtikel/$1/$2');
    $routes->get('admin/artikel/tambah', 'admin\Artikel::tambah');
    $routes->post('admin/artikel/proses_tambah', 'admin\Artikel::proses_tambah');
    $routes->get('/admin/artikel/edit/(:num)', 'admin\Artikel::edit/$1');
    $routes->post('admin/artikel/proses_edit/(:num)', 'admin\Artikel::proses_edit/$1');
    $routes->get('admin/artikel/delete/(:any)', 'admin\Artikel::delete/$1');
    
    // Member
    $routes->get('admin/member/index', 'admin\Member::index');
    $routes->get('admin/member/detail/(:num)/(:any)', 'admin\Member::viewMember/$1/$2');
    $routes->get('admin/member/tambah', 'admin\Member::tambah');
    $routes->post('admin/member/proses_tambah', 'admin\Member::proses_tambah');
    $routes->get('/admin/member/edit/(:num)', 'admin\Member::edit/$1');
    $routes->post('admin/member/proses_edit/(:num)', 'admin\Member::proses_edit/$1');
    $routes->get('admin/member/delete/(:any)', 'admin\Member::delete/$1');
    // Akhir Member

    // Kategori Video
    $routes->get('admin/kategori_videos/index', 'admin\KategoriVideo::index');
    $routes->get('admin/kategori_videos/tambah', 'admin\KategoriVideo::tambah');
    $routes->post('admin/kategori_videos/proses_tambah', 'admin\KategoriVideo::proses_tambah');
    $routes->get('admin/kategori_videos/edit/(:num)', 'admin\KategoriVideo::edit/$1');
    $routes->post('admin/kategori_videos/proses_edit/(:num)', 'admin\KategoriVideo::proses_edit/$1');
    $routes->get('admin/kategori_videos/delete/(:any)', 'admin\KategoriVideo::delete/$1');

    // Video
    $routes->get('admin/videos', 'VideoController::index');
    $routes->get('admin/videos/create', 'VideoController::create');
    $routes->post('admin/videos/store', 'VideoController::store');
    $routes->get('admin/videos/edit/(:num)', 'VideoController::edit/$1');
    $routes->post('admin/videos/update/(:num)', 'VideoController::update/$1');
    $routes->get('admin/videos/delete/(:num)', 'VideoController::delete/$1');

    // Pengumuman
    $routes->get('admin/pengumuman/index', 'admin\Pengumuman::index');
    $routes->get('admin/pengumuman/tambah', 'admin\Pengumuman::tambah');
    $routes->post('admin/pengumuman/proses_tambah', 'admin\Pengumuman::proses_tambah');
    $routes->get('/admin/pengumuman/edit/(:num)', 'admin\Pengumuman::edit/$1');
    $routes->post('admin/pengumuman/proses_edit/(:num)', 'admin\Pengumuman::proses_edit/$1');
    $routes->get('admin/pengumuman/delete/(:any)', 'admin\Pengumuman::delete/$1');
    // Akhir Pengumuman

    $routes->get('admin/user/index', 'admin\User::index');
    $routes->get('admin/user/tambah', 'admin\User::tambah');
    $routes->post('admin/user/proses_tambah', 'admin\User::proses_tambah');
    $routes->get('/admin/user/edit/(:num)', 'admin\User::edit/$1');
    $routes->post('admin/user/proses_edit/(:num)', 'admin\User::proses_edit/$1');
    $routes->get('admin/user/delete/(:any)', 'admin\User::delete/$1');   

// });



//USER
// start frond end routes
$routes->get('/', 'user\Pengumumanctrl::index');
$routes->get('/detail/(:any)', 'user\Pengumumanctrl::viewPengumuman/$1');
// route halaman member
$routes->get('/member', 'user\Memberctrl::index');
$routes->get('/member/(:num)', 'user\Memberctrl::indexdpd/$1');
$routes->get('/member/detail/(:num)/(:any)', 'user\Memberctrl::viewMember/$1/$2');
$routes->get('/member/search', 'user\Memberctrl::search');
// route halaman profil
$routes->get('/profil', 'user\Profilctrl::edit');
$routes->post('/profil/proses_edit', 'user\Profilctrl::edit');
// end frond end routes

// route language home
// $routes->get('lang/{locale}', 'user\Homectrl::language');
// $routes->get('lang/(:segment)', 'user\Homectrl::language/$1');

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
