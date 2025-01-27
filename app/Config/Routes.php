<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');

$routes->get('/periode_ajar', 'Periodeajaran::index');
$routes->post('/periode_ajar/tambah', 'Periodeajaran::tambah');
$routes->post('/periode_ajar/ubah', 'Periodeajaran::ubah');
$routes->get('/periode_ajar/hapus/(:num)', 'Periodeajaran::hapus/$1');

$routes->get('/daftar_jurusan', 'Daftarjurusan::index');
$routes->post('/daftar_jurusan/tambah', 'Daftarjurusan::tambah');
$routes->post('/daftar_jurusan/ubah', 'Daftarjurusan::ubah');
$routes->get('/daftar_jurusan/hapus/(:num)', 'Daftarjurusan::hapus/$1');

$routes->get('/daftar_kelas', 'Daftarkelas::index');
$routes->post('/daftar_kelas/tambah', 'Daftarkelas::tambah');
$routes->post('/daftar_kelas/ubah', 'Daftarkelas::ubah');
$routes->get('/daftar_kelas/hapus/(:num)', 'Daftarkelas::hapus/$1');
$routes->get('/daftar_kelas/periode_kelas/(:any)', 'Daftarkelas::periode/$1');

$routes->get('/daftar_mapel', 'Daftarmapel::index');
$routes->post('/daftar_mapel/tambah', 'Daftarmapel::tambah');
$routes->post('/daftar_mapel/ubah', 'Daftarmapel::ubah');
$routes->get('/daftar_mapel/hapus/(:num)', 'Daftarmapel::hapus/$1');

$routes->get('/daftar_siswa', 'Daftarsiswa::index');
$routes->get('/daftar_siswa/rinci_kelas/(:any)', 'Daftarsiswa::rinci_kelas/$1');
$routes->get('/daftar_siswa/rinci_siswa/(:any)/(:any)/(:any)', 'Daftarsiswa::rinci_siswa/$1/$2/$3');
$routes->post('/daftar_siswa/tambah', 'Daftarsiswa::tambah');
$routes->post('/daftar_siswa/ubah', 'Daftarsiswa::ubah');
$routes->get('/daftar_siswa/hapus/(:num)', 'Daftarsiswa::hapus/$1');

$routes->get('/daftar_nilai', 'Daftarnilai::index');
$routes->get('/daftar_nilai/nilai_tugas_periode/(:any)', 'Daftarnilai::nilai_tugas_periode/$1');
$routes->get('/daftar_nilai/nilai_pts_periode/(:any)', 'Daftarnilai::nilai_pts_periode/$1');
$routes->get('/daftar_nilai/nilai_pas_periode/(:any)', 'Daftarnilai::nilai_pas_periode/$1');
$routes->get('/daftar_nilai/mapel_nilai/(:any)', 'Daftarnilai::mapel_nilai/$1');
$routes->get('/daftar_nilai/peserta_didik/(:any)/(:any)', 'Daftarnilai::peserta_didik/$1/$2');

$routes->post('/daftar_nilai/tambah', 'Daftarnilai::tambah');
$routes->post('/daftar_nilai/ubah', 'Daftarnilai::ubah');
