<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

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
$routes->get('/daftar_mapel/periode_mapel/(:any)', 'Daftarmapel::periode/$1');

$routes->get('/daftar_siswa', 'Daftarsiswa::index');
$routes->get('/daftar_siswa/rinci_kelas/(:any)', 'Daftarsiswa::rinci_kelas/$1');
$routes->get('/daftar_siswa/rinci_siswa/(:any)/(:any)/(:any)', 'Daftarsiswa::rinci_siswa/$1/$2/$3');
$routes->post('/daftar_siswa/tambah', 'Daftarsiswa::tambah');
$routes->post('/daftar_siswa/ubah', 'Daftarsiswa::ubah');
$routes->get('/daftar_siswa/hapus/(:num)', 'Daftarsiswa::hapus/$1');

$routes->get('/daftar_nilai', 'Daftarnilai::index');
$routes->get('/daftar_nilai/nilai_tugas_periode/(:any)', 'Daftarnilai_tugas::nilai_tugas_periode/$1');
$routes->get('/daftar_nilai/nilai_pts_periode/(:any)', 'Daftarnilai_pts::nilai_pts_periode/$1');
$routes->get('/daftar_nilai/nilai_pas_periode/(:any)', 'Daftarnilai_pas::nilai_pas_periode/$1');

$routes->get('/daftar_nilai_tugas/peserta_didik/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Daftarnilai_tugas::peserta_didik/$1/$2/$3/$4/$5/$6');
$routes->post('/daftar_nilai_tugas/tambah', 'Daftarnilai_tugas::tambah');
$routes->post('/daftar_nilai_tugas/ubah', 'Daftarnilai_tugas::ubah');

$routes->get('/daftar_nilai_pts/peserta_didik/(:any)/(:any)', 'Daftarnilai_pts::peserta_didik/$1/$2');
$routes->post('/daftar_nilai_pts/tambah', 'Daftarnilai_pts::tambah');
$routes->post('/daftar_nilai_pts/ubah', 'Daftarnilai_pts::ubah');

$routes->get('/daftar_nilai_pas/peserta_didik/(:any)/(:any)', 'Daftarnilai_pas::peserta_didik/$1/$2');
$routes->post('/daftar_nilai_pas/tambah', 'Daftarnilai_pas::tambah');
$routes->post('/daftar_nilai_pas/ubah', 'Daftarnilai_pas::ubah');
