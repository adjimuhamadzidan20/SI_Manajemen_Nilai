<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- navbar -->
        <?= $this->include('partials/navbar') ?>
    </nav>
    <div id="layoutSidenav">
        <!-- sidebar -->
        <?= $this->include('partials/sidebar') ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-3">
                    <h3 class="mt-3 text-uppercase"><?= $kelas; ?> <?= $nama_jurusan; ?> - <?= $nama_mapel; ?></h3>
                    <p class="text-uppercase mb-2"><?= 'Semester '. $semester; ?></p>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/daftar_nilai">Daftar Nilai</a></li>
                        <li class="breadcrumb-item"><a href="/daftar_nilai/nilai_pts_periode/<?= $id_periode; ?>">Nilai Tugas T.A <?= $tahun_ajaran; ?></a></li>
                        <li class="breadcrumb-item active"><?= $kelas; ?> <?= $nama_jurusan; ?> <?= $nama_mapel; ?> - <?= $semester; ?></li>
                    </ol>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="/daftar_nilai/nilai_pts_periode/<?= $id_periode; ?>" class="btn btn-primary btn-sm">Kembali</a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#tambah_nilai_pts">Tambah</button>
                                <button type="button" class="btn btn-primary btn-sm">Cetak PDF</button>
                                <button type="button" class="btn btn-primary btn-sm">Cetak Excel</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-nowrap">Nama Peserta Didik</th>
                                        <th class="text-nowrap">Mata Pelajaran</th>
                                        <th class="text-nowrap">Nilai PTS</th>
                                        <th class="text-nowrap text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $no = 0;
                                        foreach ($nilai as $data) :
                                        $no++;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $data['nisn']; ?></td>
                                            <td><?= $data['nama_siswa']; ?></td>
                                            <td><?= $data['nama_mapel']; ?></td>
                                            <td><?= $data['nilai_pts']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ubah_nilai_pts"
                                                data-idpts="<?= $data['id_pts']; ?>"
                                                data-idsiswa="<?= $data['id_siswa']; ?>"
                                                data-idmapel="<?= $data['id_mapel']; ?>"
                                                data-kelas="<?= $data['kelas']; ?>"
                                                data-idjurusan="<?= $data['id_jurusan']; ?>"
                                                data-idperiode="<?= $data['id_periode']; ?>"
                                                data-semester="<?= $data['semester']; ?>"
                                                data-nilaipts="<?= $data['nilai_pts']; ?>""
                                                >Ubah Nilai</button>
                                            </td>
                                        </tr>
                                    <?php  
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal tambah -->
            <div class="modal fade" id="tambah_nilai_pts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Nilai</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/daftar_nilai_pts/tambah" method="post">  
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputMurid" class="form-label">Nama Peserta Didik</label>
                                            <select class="form-select" name="peserta_didik" id="exampleInputMurid">
                                            <?php  
                                                foreach ($siswa as $data) :
                                            ?>
                                                <option value="<?= $data['id_siswa']; ?>"><?= $data['kd_siswa']; ?> - <?= $data['nisn']; ?> - <?= $data['nama_siswa']; ?></option>
                                            <?php  
                                                endforeach;
                                            ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputMapel" class="form-label">Mata Pelajaran</label>
                                            <input type="text" class="form-control" name="nama_mapel" value="<?= $nama_mapel; ?>"
                                            hidden>
                                            <select class="form-select" name="id_mapel" id="exampleInputMapel">
                                                <option value="<?= $id_mapel; ?>"><?= $nama_mapel; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputKelas" class="form-label">Kelas</label>
                                            <select class="form-select" name="kelas" id="exampleInputKelas">
                                                <option value="<?= $kelas; ?>"><?= $kelas; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputJurusan" class="form-label">Jurusan</label>
                                            <select class="form-select" name="jurusan" id="exampleInputJurusan">
                                                <option value="<?= $id_jurusan; ?>"><?= $nama_jurusan; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputPeriode" class="form-label">Periode</label>
                                            <select class="form-select" name="periode" id="exampleInputPeriode">
                                                <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputSemester" class="form-label">Semester</label>
                                            <input type="text" class="form-control" id="exampleInputSemester" name="semester" 
                                            value="<?= $semester; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPTS" class="form-label">Nilai PTS</label>
                                            <input type="text" class="form-control" id="exampleInputPTS" name="nilai_pts" placeholder="Masukkan Nilai PTS">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal ubah -->
            <div class="modal fade" id="ubah_nilai_pts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Nilai</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/daftar_nilai_pts/ubah" method="post">  
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="id" id="id" hidden>
                                            <label for="input_pesertadidik" class="form-label">Nama Peserta Didik</label>
                                            <select class="form-select" name="peserta_didik" id="input_pesertadidik">
                                                <?php  
                                                    foreach ($siswa as $data) :
                                                ?>
                                                    <option value="<?= $data['id_siswa']; ?>"><?= $data['kd_siswa']; ?> - <?= $data['nisn']; ?> - <?= $data['nama_siswa']; ?></option>
                                                <?php  
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_namamapel" class="form-label">Mata Pelajaran</label>
                                            <input type="text" class="form-control" name="nama_mapel" value="<?= $nama_mapel; ?>"
                                            hidden>
                                            <select class="form-select" name="id_mapel" id="input_namamapel">
                                                <option value="<?= $id_mapel; ?>"><?= $nama_mapel; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_kelasmurid" class="form-label">Kelas</label>
                                            <select class="form-select" name="kelas" id="input_kelasmurid">
                                                <option value="<?= $kelas; ?>"><?= $kelas; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_kelasjurusan" class="form-label">Jurusan</label>
                                            <select class="form-select" name="jurusan" id="input_kelasjurusan">
                                                <option value="<?= $id_jurusan; ?>"><?= $nama_jurusan; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_thnperiode" class="form-label">Periode</label>
                                            <select class="form-select" name="periode" id="input_thnperiode">
                                                <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_periodesemester" class="form-label">Semester</label>
                                            <input type="text" class="form-control" id="input_periodesemester" name="semester" 
                                            value="<?= $semester; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_PTS" class="form-label">Nilai PTS</label>
                                            <input type="text" class="form-control" id="input_PTS" name="nilai_pts">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
