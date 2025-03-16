<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

// route login 
$routes->get('/login', 'Loginadmin::index', ['filter' => 'administrator']);
$routes->post('/login/masuk', 'Loginadmin::masuk');
$routes->get('/login/keluar', 'Loginadmin::keluar');

// route lupa password
$routes->get('/forgot_password', 'Lupapassword::index');
$routes->post('/forgot_password/ganti_password', 'Lupapassword::ganti_password');

// route dashboard
$routes->get('/', 'Dashboard::index', ['filter' => 'nonadministrator']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'nonadministrator']);

// route tahun ajaran
$routes->get('/periode_ajar', 'Periodeajaran::index', ['filter' => 'nonadministrator']);
$routes->post('/periode_ajar/tambah', 'Periodeajaran::tambah', ['filter' => 'nonadministrator']);
$routes->post('/periode_ajar/ubah', 'Periodeajaran::ubah', ['filter' => 'nonadministrator']);
$routes->get('/periode_ajar/hapus/(:num)', 'Periodeajaran::hapus/$1', ['filter' => 'nonadministrator']);

// route daftar jurusan
$routes->get('/daftar_jurusan', 'Daftarjurusan::index', ['filter' => 'nonadministrator']);
$routes->post('/daftar_jurusan/tambah', 'Daftarjurusan::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_jurusan/ubah', 'Daftarjurusan::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_jurusan/hapus/(:num)', 'Daftarjurusan::hapus/$1', ['filter' => 'nonadministrator']);

// route daftar kelas
$routes->get('/daftar_kelas', 'Daftarkelas::index', ['filter' => 'nonadministrator']);
$routes->post('/daftar_kelas/tambah', 'Daftarkelas::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_kelas/ubah', 'Daftarkelas::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_kelas/hapus/(:num)', 'Daftarkelas::hapus/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_kelas/periode_kelas/(:any)', 'Daftarkelas::periode/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_kelas/cetak_kelas_pdf/(:any)', 'Daftarkelas::cetakPDF/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_kelas/cetak_kelas_excel/(:any)', 'Daftarkelas::cetakExcel/$1', ['filter' => 'nonadministrator']);

// route daftar mapel
$routes->get('/daftar_mapel', 'Daftarmapel::index', ['filter' => 'nonadministrator']);
$routes->post('/daftar_mapel/tambah', 'Daftarmapel::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_mapel/ubah', 'Daftarmapel::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_mapel/hapus/(:num)', 'Daftarmapel::hapus/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_mapel/periode_mapel/(:any)', 'Daftarmapel::periode/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_mapel/cetak_mapel_pdf/(:any)', 'Daftarmapel::cetakPDF/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_mapel/cetak_mapel_excel/(:any)', 'Daftarmapel::cetakExcel/$1', ['filter' => 'nonadministrator']);

// route daftar siswa
$routes->get('/daftar_siswa', 'Daftarsiswa::index', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/rinci_kelas/(:any)', 'Daftarsiswa::rinci_kelas/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/rinci_siswa/(:any)/(:any)/(:any)', 'Daftarsiswa::rinci_siswa/$1/$2/$3', 
['filter' => 'nonadministrator']);
$routes->post('/daftar_siswa/tambah', 'Daftarsiswa::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_siswa/ubah', 'Daftarsiswa::ubah', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/hapus/(:num)', 'Daftarsiswa::hapus/$1', ['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/cetak_siswa_pdf/(:any)/(:any)/(:any)', 'Daftarsiswa::cetakPDF/$1/$2/$3', 
['filter' => 'nonadministrator']);
$routes->get('/daftar_siswa/cetak_siswa_excel/(:any)/(:any)/(:any)', 'Daftarsiswa::cetakExcel/$1/$2/$3', 
['filter' => 'nonadministrator']);

// route daftar nilai
$routes->get('/daftar_nilai', 'Daftarnilai::index', ['filter' => 'nonadministrator']);
$routes->get('/daftar_nilai/nilai_siswa_periode/(:any)', 'Daftarnilai_siswa::nilai_siswa_periode/$1', 
['filter' => 'nonadministrator']);
$routes->get('/daftar_nilai_siswa/peserta_didik/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Daftarnilai_siswa::peserta_didik/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->post('/daftar_nilai_siswa/tambah', 'Daftarnilai_siswa::tambah', ['filter' => 'nonadministrator']);
$routes->post('/daftar_nilai_siswa/ubah', 'Daftarnilai_siswa::ubah', ['filter' => 'nonadministrator']);

// route profil admin
$routes->get('/profil_admin', 'Profiladmin::index', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_pass', 'Profiladmin::ubah_pass', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_username', 'Profiladmin::ubah_user', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_nama', 'Profiladmin::ubah_nama', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_alamat', 'Profiladmin::ubah_alamat', ['filter' => 'nonadministrator']);
$routes->post('/profil_admin/ubah_email', 'Profiladmin::ubah_email', ['filter' => 'nonadministrator']);

// route cetak laporan (pts)
$routes->get('/cetak_laporan', 'Cetaklaporan_pts::index', ['filter' => 'nonadministrator']);
$routes->get('/cetak_laporan/cetak_pts/(:any)', 'Cetaklaporan_pts::nilai_mapel_pts/$1', ['filter' => 'nonadministrator']);
$routes->get('/cetak_laporan_pts/peserta_didik/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_pts::peserta_didik/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->get('/laporan_nilai_pts/cetak_nilai_pts_pdf/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_pts::cetakPDF/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->get('/laporan_nilai_pts/cetak_nilai_pts_excel/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_pts::cetakExcel/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

// route cetak laporan (pas)
$routes->get('/cetak_laporan', 'Cetaklaporan_pas::index', ['filter' => 'nonadministrator']);
$routes->get('/cetak_laporan/cetak_pas/(:any)', 'Cetaklaporan_pas::nilai_mapel_pas/$1', ['filter' => 'nonadministrator']);
$routes->get('/cetak_laporan_pas/peserta_didik/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_pas::peserta_didik/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->get('/laporan_nilai_pas/cetak_nilai_pas_pdf/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_pas::cetakPDF/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->get('/laporan_nilai_pas/cetak_nilai_pas_excel/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_pas::cetakExcel/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

// route cetak laporan (semua)
$routes->get('/cetak_laporan', 'Cetaklaporan_semua::index', ['filter' => 'nonadministrator']);
$routes->get('/cetak_laporan/cetak_semua/(:any)', 'Cetaklaporan_semua::nilai_mapel_semua/$1', ['filter' => 'nonadministrator']);
$routes->get('/cetak_laporan_semua/peserta_didik/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_semua::peserta_didik/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->get('/laporan_nilai_semua/cetak_nilai_semua_pdf/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_semua::cetakPDF/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);

$routes->get('/laporan_nilai_semua/cetak_nilai_semua_excel/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 
'Cetaklaporan_semua::cetakExcel/$1/$2/$3/$4/$5/$6', ['filter' => 'nonadministrator']);
