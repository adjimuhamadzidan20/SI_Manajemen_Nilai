<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/login', 'Loginadmin::index', ['filter' => 'administrator']);
$routes->post('/login/masuk', 'Loginadmin::masuk');
$routes->get('/login/keluar', 'Loginadmin::keluar');

$routes->get('/', 'Dashboard::index', ['filter' => 'nonadministrator']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'nonadministrator']);

$routes->get('/periode_ajar', 'Periodeajaran::index', ['filter' => 'nonadministrator']);
$routes->post('/periode_ajar/tambah', 'Periodeajaran::tambah', ['filter' => 'nonadministrator']);
$routes->post('/periode_ajar/ubah', 'Periodeajaran::ubah', ['filter' => 'nonadministrator']);
$routes->get('/periode_ajar/hapus/(:num)', 'Periodeajaran::hapus/$1', ['filter' => 'nonadministrator']);

$routes->get('/daftar_jurusan', 'Daftarjurusan::index', ['filter' => 'nonadministrator']);
$routes->post('/daftar_jurusan/tambah', 'Daftarjurusan::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_jurusan/ubah', 'Daftarjurusan::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_jurusan/hapus/(:num)', 'Daftarjurusan::hapus/$1', ['filter' => 'nonadministrator']);

$routes->get('/daftar_kelas', 'Daftarkelas::index', ['filter' => 'nonadministrator']);
$routes->post('/daftar_kelas/tambah', 'Daftarkelas::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_kelas/ubah', 'Daftarkelas::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_kelas/hapus/(:num)', 'Daftarkelas::hapus/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_kelas/periode_kelas/(:any)', 'Daftarkelas::periode/$1', ['filter' => 'nonadministrator']);

$routes->get('/daftar_mapel', 'Daftarmapel::index', ['filter' => 'nonadministrator']);
$routes->post('/daftar_mapel/tambah', 'Daftarmapel::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_mapel/ubah', 'Daftarmapel::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_mapel/hapus/(:num)', 'Daftarmapel::hapus/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_mapel/periode_mapel/(:any)', 'Daftarmapel::periode/$1', ['filter' => 'nonadministrator']);

$routes->get('/daftar_siswa', 'Daftarsiswa::index', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/rinci_kelas/(:any)', 'Daftarsiswa::rinci_kelas/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/rinci_siswa/(:any)/(:any)/(:any)', 'Daftarsiswa::rinci_siswa/$1/$2/$3', 
['filter' => 'nonadministrator']);

$routes->post('/daftar_siswa/tambah', 'Daftarsiswa::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_siswa/ubah', 'Daftarsiswa::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/hapus/(:num)', 'Daftarsiswa::hapus/$1', ['filter' => 'nonadministrator']);

$routes->get('/daftar_nilai', 'Daftarnilai::index', ['filter' => 'nonadministrator']);
$routes->get('/daftar_nilai/nilai_tugas_periode/(:any)', 'Daftarnilai_tugas::nilai_tugas_periode/$1', 
['filter' => 'nonadministrator']);

$routes->get('/daftar_nilai/nilai_pts_periode/(:any)', 'Daftarnilai_pts::nilai_pts_periode/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_nilai/nilai_pas_periode/(:any)', 'Daftarnilai_pas::nilai_pas_periode/$1', ['filter' => 'nonadministrator']);

$routes->get('/daftar_nilai_tugas/peserta_didik/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Daftarnilai_tugas::peserta_didik/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->post('/daftar_nilai_tugas/tambah', 'Daftarnilai_tugas::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_nilai_tugas/ubah', 'Daftarnilai_tugas::ubah', ['filter' => 'nonadministrator']);

$routes->get('/daftar_nilai_pts/peserta_didik/(:any)/(:any)', 'Daftarnilai_pts::peserta_didik/$1/$2', 
['filter' => 'nonadministrator']);

$routes->post('/daftar_nilai_pts/tambah', 'Daftarnilai_pts::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_nilai_pts/ubah', 'Daftarnilai_pts::ubah', ['filter' => 'nonadministrator']);

$routes->get('/daftar_nilai_pas/peserta_didik/(:any)/(:any)', 'Daftarnilai_pas::peserta_didik/$1/$2', 
['filter' => 'nonadministrator']);

$routes->post('/daftar_nilai_pas/tambah', 'Daftarnilai_pas::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_nilai_pas/ubah', 'Daftarnilai_pas::ubah', ['filter' => 'nonadministrator']);

$routes->get('/profil_admin', 'Profiladmin::index', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_pass', 'Profiladmin::ubah_pass', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_username', 'Profiladmin::ubah_user', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_nama', 'Profiladmin::ubah_nama', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_alamat', 'Profiladmin::ubah_alamat', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_email', 'Profiladmin::ubah_email', ['filter' => 'nonadministrator']);
