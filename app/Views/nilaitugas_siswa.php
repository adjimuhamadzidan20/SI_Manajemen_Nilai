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
                    <h2 class="mt-3"><?= $kelas; ?> <?= $nama_jurusan; ?> - <?= $nama_mapel; ?></h2>
                    <h5><?= 'Semester '. $semester; ?></h4>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    </ol>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="/daftar_nilai" class="btn btn-primary btn-sm">Kembali</a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#tambah_nilai">Tambah</button>
                                <button type="button" class="btn btn-primary btn-sm">Cetak PDF</button>
                                <button type="button" class="btn btn-primary btn-sm">Cetak Excel</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-nowrap">Peserta Didik</th>
                                        <th class="text-nowrap text-center">TP1</th>
                                        <th class="text-nowrap text-center">TP2</th>
                                        <th class="text-nowrap text-center">TP3</th>
                                        <th class="text-nowrap text-center">TP4</th>
                                        <th class="text-nowrap text-center">TP5</th>
                                        <th class="text-nowrap text-center">TP6</th>
                                        <th class="text-nowrap text-center">TP7</th>
                                        <th class="text-nowrap text-center">TP8</th>
                                        <th class="text-nowrap text-center">TP9</th>
                                        <th class="text-nowrap text-center">LM1</th>
                                        <th class="text-nowrap text-center">LM2</th>
                                        <th class="text-nowrap text-center">LM3</th>
                                        <th class="text-nowrap text-center">NA(M)</th>
                                        <th class="text-nowrap text-center">NA(S)</th>
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
                                            <td class="text-center"><?= $data['nilai_1']; ?></td>
                                            <td class="text-center"><?= $data['nilai_2']; ?></td>
                                            <td class="text-center"><?= $data['nilai_3']; ?></td>
                                            <td class="text-center"><?= $data['nilai_4']; ?></td>
                                            <td class="text-center"><?= $data['nilai_5']; ?></td>
                                            <td class="text-center"><?= $data['nilai_6']; ?></td>
                                            <td class="text-center"><?= $data['nilai_7']; ?></td>
                                            <td class="text-center"><?= $data['nilai_8']; ?></td>
                                            <td class="text-center"><?= $data['nilai_9']; ?></td>
                                            <td class="text-center"><?= $data['LM_1']; ?></td>
                                            <td class="text-center"><?= $data['LM_2']; ?></td>
                                            <td class="text-center"><?= $data['LM_3']; ?></td>
                                            <td class="text-center"><?= $data['na_materi']; ?></td>
                                            <td class="text-center"><?= $data['na_sumatif']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                                data-bs-target="#ubah_nilai"
                                                data-idtugas="<?= $data['id_tugas']; ?>"
                                                data-idsiswa="<?= $data['id_siswa']; ?>"
                                                data-idmapel="<?= $data['id_mapel']; ?>"
                                                data-kelas="<?= $data['kelas']; ?>"
                                                data-idjurusan="<?= $data['id_jurusan']; ?>"
                                                data-idperiode="<?= $data['id_periode']; ?>"
                                                data-semester="<?= $data['semester']; ?>"
                                                data-nilai1="<?= $data['nilai_1']; ?>"
                                                data-nilai2="<?= $data['nilai_2']; ?>"
                                                data-nilai3="<?= $data['nilai_3']; ?>"
                                                data-nilai4="<?= $data['nilai_4']; ?>"
                                                data-nilai5="<?= $data['nilai_5']; ?>"
                                                data-nilai6="<?= $data['nilai_6']; ?>"
                                                data-nilai7="<?= $data['nilai_7']; ?>"
                                                data-nilai8="<?= $data['nilai_8']; ?>"
                                                data-nilai9="<?= $data['nilai_9']; ?>"
                                                >Ubah</button>
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
            <div class="modal fade" id="tambah_nilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Nilai</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/daftar_nilai/tambah" method="post">  
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
                                            <select class="form-select" name="mapel" id="exampleInputMapel">
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
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label fw-bold">LM 1</label>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP1" name="tp_1">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP2" name="tp_2">
                                                </div>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" placeholder="TP3" name="tp_3">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label fw-bold">LM 2</label>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP1" name="tp_4">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP2" name="tp_5">
                                                </div>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" placeholder="TP3" name="tp_6">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label fw-bold">LM 3</label>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP1" name="tp_7">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP2" name="tp_8">
                                                </div>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" placeholder="TP3" name="tp_9">
                                                </div>
                                            </div>
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
            <div class="modal fade" id="ubah_nilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Nilai</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/daftar_nilai/ubah" method="post">  
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
                                            <select class="form-select" name="mapel" id="input_namamapel">
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
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label fw-bold">LM 1</label>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP1" name="tp_1" id="input_tp_1">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP2" name="tp_2" id="input_tp_2">
                                                </div>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" placeholder="TP3" name="tp_3" id="input_tp_3">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label fw-bold">LM 2</label>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP1" name="tp_4" id="input_tp_4">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP2" name="tp_5" id="input_tp_5">
                                                </div>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" placeholder="TP3" name="tp_6" id="input_tp_6">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label fw-bold">LM 3</label>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP1" name="tp_7" id="input_tp_7">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="TP2" name="tp_8" id="input_tp_8">
                                                </div>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" placeholder="TP3" name="tp_9" id="input_tp_9">
                                                </div>
                                            </div>
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
