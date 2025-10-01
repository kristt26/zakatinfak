<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/forbidden', 'Auth::forbidden');
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->add('auth', 'Auth::login');

$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->add('register', 'Auth::register');
    $routes->post('/', 'Auth::index');
    $routes->get('logout', 'Auth::logout');
});

// Routes for Jenis_bantuan
$routes->group('jenis_bantuan', function ($routes) {
    $routes->get('/', 'Jenis_bantuan::index');
    $routes->get('read', 'Jenis_bantuan::store');
    $routes->post('add', 'Jenis_bantuan::add');
    $routes->put('edit', 'Jenis_bantuan::edit');
    $routes->delete('delete/(:hash)', 'Jenis_bantuan::delete/$1');
});

// Routes for Kategori_zis
$routes->group('kategori_zis', function ($routes) {
    $routes->get('/', 'Kategori_zis::index');
    $routes->get('read', 'Kategori_zis::store');
    $routes->post('add', 'Kategori_zis::add');
    $routes->put('edit', 'Kategori_zis::edit');
    $routes->delete('delete/(:hash)', 'Kategori_zis::delete/$1');
});

// Routes for Kelengkapan
$routes->group('kelengkapan', function ($routes) {
    $routes->get('/', 'Kelengkapan::index');
    $routes->get('read', 'Kelengkapan::store');
    $routes->post('add', 'Kelengkapan::add');
    $routes->put('edit', 'Kelengkapan::edit');
    $routes->delete('delete/(:hash)', 'Kelengkapan::delete/$1');
});

// Routes for Kriteria
$routes->group('kriteria', function ($routes) {
    $routes->get('/', 'Kriteria::index');
    $routes->get('read', 'Kriteria::store');
    $routes->post('add', 'Kriteria::add');
    $routes->put('edit', 'Kriteria::edit');
    $routes->delete('delete/(:hash)', 'Kriteria::delete/$1');
});

// Routes for Migrations
$routes->group('migrations', function ($routes) {
    $routes->get('/', 'Migrations::index');
    $routes->get('read', 'Migrations::store');
    $routes->post('add', 'Migrations::add');
    $routes->put('edit', 'Migrations::edit');
    $routes->delete('delete/(:hash)', 'Migrations::delete/$1');
});

// Routes for Mustahik
$routes->group('mustahik', function ($routes) {
    $routes->get('/', 'Mustahik::index');
    $routes->get('read', 'Mustahik::store');
    $routes->post('add', 'Mustahik::add');
    $routes->put('edit', 'Mustahik::edit');
    $routes->delete('delete/(:hash)', 'Mustahik::delete/$1');
});

// Routes for Muzaki
$routes->group('muzaki-mustahik', function ($routes) {
    $routes->get('/', 'Muzaki::index');
    $routes->get('read', 'Muzaki::store');
    $routes->post('add', 'Muzaki::add');
    $routes->put('edit', 'Muzaki::edit');
    $routes->delete('delete/(:hash)', 'Muzaki::delete/$1');
});

// Routes for Pendaftaran
$routes->group('pendaftaran', function ($routes) {
    $routes->get('/', 'Pendaftaran::index');
    $routes->get('detail/(:hash)', 'Pendaftaran::detail/$1');
    $routes->get('read', 'Pendaftaran::store');
    $routes->get('read_detail/(:hash)', 'Pendaftaran::storeDetail/$1');
    $routes->post('add', 'Pendaftaran::add');
    $routes->put('edit', 'Pendaftaran::edit');
    $routes->delete('delete/(:hash)', 'Pendaftaran::delete/$1');
});

// Routes for Persyaratan
$routes->group('persyaratan', function ($routes) {
    $routes->get('(:hash)', 'Persyaratan::index/$1');
    $routes->get('read/(:hash)', 'Persyaratan::store/$1');
    $routes->post('add', 'Persyaratan::add');
    $routes->put('edit', 'Persyaratan::edit');
    $routes->delete('delete/(:hash)', 'Persyaratan::delete/$1');
});

// Routes for Pertanyaan
$routes->group('pertanyaan', function ($routes) {
    $routes->get('(:hash)', 'Pertanyaan::index/$1');
    $routes->get('read/(:hash)', 'Pertanyaan::store/$1');
    $routes->post('add', 'Pertanyaan::add');
    $routes->put('edit', 'Pertanyaan::edit');
    $routes->delete('delete/(:hash)', 'Pertanyaan::delete/$1');
});

// Routes for Rekomendasi
$routes->group('rekomendasi', function ($routes) {
    $routes->get('/', 'Rekomendasi::index');
    $routes->get('read', 'Rekomendasi::store');
    $routes->post('add', 'Rekomendasi::add');
    $routes->put('edit', 'Rekomendasi::edit');
    $routes->delete('delete/(:hash)', 'Rekomendasi::delete/$1');
});

// Routes for Sub_kriteria
$routes->group('sub_kriteria', function ($routes) {
    $routes->get('(:hash)', 'Sub_kriteria::index/$1');
    $routes->get('read/(:hash)', 'Sub_kriteria::store/$1');
    $routes->post('add', 'Sub_kriteria::add');
    $routes->put('edit', 'Sub_kriteria::edit');
    $routes->delete('delete/(:hash)', 'Sub_kriteria::delete/$1');
});

// Routes for Survey
$routes->group('survey', function ($routes) {
    $routes->get('/', 'Survey::index');
    $routes->get('read', 'Survey::store');
    $routes->post('add', 'Survey::add');
    $routes->put('edit', 'Survey::edit');
    $routes->delete('delete/(:hash)', 'Survey::delete/$1');
});

// Routes for Users
$routes->group('users', function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('read', 'Users::store');
    $routes->post('add', 'Users::add');
    $routes->put('edit', 'Users::edit');
    $routes->delete('delete/(:hash)', 'Users::delete/$1');
});

// Routes for Zakat
$routes->group('pembayaran', function ($routes) {
    $routes->get('/', 'Zakat::index');
    $routes->get('detail/(:hash)', 'Zakat::detail/$1');
    $routes->get('read', 'Zakat::store');
    $routes->get('read_detail/(:hash)', 'Zakat::storeDetail/$1');
    $routes->post('add', 'Zakat::add');
    $routes->put('edit', 'Zakat::edit');
    $routes->delete('delete/(:hash)', 'Zakat::delete/$1');
});

// Routes for Petugas
$routes->group('petugas', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Petugas::index');
    $routes->get('read', 'Petugas::store');
    $routes->post('add', 'Petugas::add');
    $routes->put('edit', 'Petugas::edit');
    $routes->delete('delete/(:hash)', 'Petugas::delete/$1');
});

$routes->group('mustahik', function ($routes) {
    $routes->get('dashboard', 'Mustahik\Dashboard::index');
    $routes->group('biodata', ['filter' => 'role:mustahik'], function ($routes) {
        $routes->get('/', 'Mustahik\Biodata::index');
        $routes->get('read', 'Mustahik\Biodata::store');
        $routes->put('edit', 'Mustahik\Biodata::edit');
    });
    $routes->group('pengajuan', ['filter' => 'role:mustahik'], function ($routes) {
        $routes->get('/', 'Mustahik\Pengajuan::index');
        $routes->get('tambah_pengajuan', 'Mustahik\Pengajuan::tambah');
        $routes->get('ubah_pengajuan/(:hash)', 'Mustahik\Pengajuan::ubah/$1');
        $routes->get('read', 'Mustahik\Pengajuan::store');
        $routes->get('readAdd', 'Mustahik\Pengajuan::storeAddPengajuan');
        $routes->get('readEdit/(:hash)', 'Mustahik\Pengajuan::storeEditPengajuan/$1');
        $routes->post('add', 'Mustahik\Pengajuan::add');
        $routes->put('edit', 'Mustahik\Pengajuan::edit');
    });

    $routes->group('pembayaran', ['filter' => 'role:mustahik'], function ($routes) {
        $routes->get('/', 'Mustahik\Pembayaran::index');
        $routes->get('tambah_pembayaran', 'Mustahik\Pembayaran::tambah');
        $routes->get('ubah_pengajuan/(:hash)', 'Mustahik\Pembayaran::ubah/$1');
        $routes->get('read', 'Mustahik\Pembayaran::store');
        $routes->get('readAdd', 'Mustahik\Pembayaran::storeAddPengajuan');
        $routes->get('readEdit/(:hash)', 'Mustahik\Pembayaran::storeEditPengajuan/$1');
        $routes->post('add', 'Mustahik\Pembayaran::add');
        $routes->put('edit', 'Mustahik\Pembayaran::edit');
    });

    $routes->group('survey', ['filter' => 'role:mustahik,petugas'], function ($routes) {
        $routes->get('(:hash)', 'Mustahik\Survey::index');
        $routes->get('read/(:hash)', 'Mustahik\Survey::store/$1');
        $routes->post('add', 'Mustahik\Survey::add');
        $routes->put('edit', 'Mustahik\Survey::edit');
        $routes->delete('delete/(:hash)', 'Mustahik\Survey::delete/$1');
    });
});

$routes->group('muzaki', function ($routes) {
    $routes->get('dashboard', 'Muzaki\Dashboard::index');
    $routes->group('biodata', ['filter' => 'role:muzaki'], function ($routes) {
        $routes->get('/', 'Muzaki\Biodata::index');
        $routes->get('read', 'Muzaki\Biodata::store');
        $routes->put('edit', 'Muzaki\Biodata::edit');
    });
    $routes->group('pembayaran', ['filter' => 'role:muzaki'], function ($routes) {
        $routes->get('/', 'Muzaki\Pengajuan::index');
        $routes->get('tambah_pembayaran', 'Muzaki\Pengajuan::tambah');
        $routes->get('ubah_pengajuan/(:hash)', 'Muzaki\Pengajuan::ubah/$1');
        $routes->get('read', 'Muzaki\Pengajuan::store');
        $routes->get('readAdd', 'Muzaki\Pengajuan::storeAddPengajuan');
        $routes->get('readEdit/(:hash)', 'Muzaki\Pengajuan::storeEditPengajuan/$1');
        $routes->post('add', 'Muzaki\Pengajuan::add');
        $routes->put('edit', 'Muzaki\Pengajuan::edit');
    });

    $routes->group('survey', ['filter' => 'role:mustahik,petugas'], function ($routes) {
        $routes->get('(:hash)', 'Mustahik\Survey::index');
        $routes->get('read/(:hash)', 'Mustahik\Survey::store/$1');
        $routes->post('add', 'Mustahik\Survey::add');
        $routes->put('edit', 'Mustahik\Survey::edit');
        $routes->delete('delete/(:hash)', 'Mustahik\Survey::delete/$1');
    });
});
$routes->group('laporan', function ($routes) {
    $routes->get('pembayaran-zis', 'Laporan::pembayaran');
    $routes->get('bantuan', 'Laporan::bantuan');
    $routes->post('pembayaran/data', 'Laporan::data');
    $routes->get('pembayaran/excel', 'Laporan::excel');
    $routes->get('pembayaran/print', 'Laporan::print');
    $routes->post('bantuan/data', 'Laporan::bantuan_data');
    $routes->get('bantuan/excel', 'Laporan::bantuan_excel');
    $routes->get('bantuan/print', 'Laporan::bantuan_print');
});
