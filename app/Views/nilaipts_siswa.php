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
                    <p class="text-uppercase mb-2">Nilai PTS | <?= 'Semester '. $semester; ?></p>
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
                                data-bs-target="#tambah_nilai_pts"><i class="fas fa-plus"></i> Tambah</button>

                                <?php  
                                    if ($jumlah > 0) {
                                ?>
                                    <a href="/daftar_nilai_pts/cetak_nilai_pts_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-pdf"></i> Cetak PDF</a>

                                    <a href="/daftar_nilai_pts/cetak_nilai_pts_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-excel"></i> Cetak Excel</a>
                                <?php  
                                    } else {
                                ?>
                                    <button href="/daftar_nilai_pts/cetak_nilai_pts_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm" disabled>
                                    <i class="fas fa-file-pdf"></i> Cetak PDF</button>

                                    <button href="/daftar_nilai_pts/cetak_nilai_pts_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm" disabled>
                                    <i class="fas fa-file-excel"></i> Cetak Excel</button>
                                <?php  
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" style="width:100%" id="tabel_pts">
                                <thead>
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">NIS</th>
                                        <th class="text-start">NISN</th>
                                        <th class="text-start">Nama Peserta Didik</th>
                                        <th class="text-start">Mata Pelajaran</th>
                                        <th class="text-start">Nilai PTS</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $no = 0;
                                        foreach ($nilai as $data) :
                                        $no++;
                                    ?>
                                        <tr>
                                            <td class="text-start"><?= $no; ?></td>
                                            <td class="text-start"><?= $data['nis']; ?></td>
                                            <td class="text-start"><?= $data['nisn']; ?></td>
                                            <td class="text-start"><?= $data['nama_siswa']; ?></td>
                                            <td class="text-start"><?= $data['nama_mapel']; ?></td>
                                            <td class="text-start"><?= $data['nilai_pts']; ?></td>
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
                                                data-nilaipts="<?= $data['nilai_pts']; ?>"
                                                title="Ubah nilai"><i class="fas fa-edit"></i></button>
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-plus me-2"></i>Tambah data nilai PTS</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/daftar_nilai_pts/tambah" method="post">  
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h6 class="text-uppercase">
                                            <?= $kelas; ?> <?= $nama_jurusan; ?> - <?= $nama_mapel; ?> - <?= $semester; ?>    
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="nama_mapel" value="<?= $nama_mapel; ?>"
                                        hidden>
                                        <select class="form-select" name="id_mapel" hidden>
                                            <option value="<?= $id_mapel; ?>"><?= $nama_mapel; ?></option>
                                        </select>
                                        <select class="form-select" name="kelas" id="exampleInputKelas" hidden>
                                            <option value="<?= $kelas; ?>"><?= $kelas; ?></option>
                                        </select>
                                        <select class="form-select" name="jurusan" id="exampleInputJurusan" hidden>
                                            <option value="<?= $id_jurusan; ?>"><?= $nama_jurusan; ?></option>
                                        </select>
                                        <select class="form-select" name="periode" id="exampleInputPeriode" hidden>
                                            <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                                        </select>
                                        <input type="text" class="form-control" id="exampleInputSemester" name="semester" 
                                        value="<?= $semester; ?>" hidden>

                                        <div class="mb-3">
                                            <label for="exampleInputMurid" class="form-label">Nama Peserta Didik</label>
                                            <?php  
                                                if ($siswa_jumlah > 0) {
                                            ?>
                                                <select class="form-select" name="peserta_didik" id="exampleInputMurid" required>
                                                    <option value="" selected>-- Pilih peserta didik --</option>
                                                    <?php  
                                                        foreach ($siswa as $data) :
                                                    ?>
                                                        <option value="<?= $data['id_siswa']; ?>">
                                                        <?= $data['nisn']; ?> - <?= $data['nama_siswa']; ?></option>
                                                    <?php  
                                                        endforeach;
                                                    ?>
                                                </select>
                                            <?php  
                                                } else {
                                            ?>
                                                <input type="text" class="form-control"  value="Belum ada data peserta didik" disabled>
                                            <?php  
                                                }
                                            ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPTS" class="form-label">Nilai PTS</label>
                                            <input type="text" class="form-control" id="exampleInputPTS" name="nilai_pts" 
                                            placeholder="Masukkan Nilai PTS" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <?php  
                                    if ($siswa_jumlah > 0) {
                                ?>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                <?php  
                                    } else {
                                ?>
                                    <button type="submit" class="btn btn-primary" disabled>Tambah</button>
                                <?php  
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal ubah -->
            <div class="modal fade" id="ubah_nilai_pts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-edit me-2"></i>Ubah data nilai PTS</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/daftar_nilai_pts/ubah" method="post">  
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h6 class="text-uppercase">
                                            <?= $kelas; ?> <?= $nama_jurusan; ?> - <?= $nama_mapel; ?> - <?= $semester; ?>    
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="id" id="id" hidden>
                                        <input type="text" class="form-control" name="nama_mapel" value="<?= $nama_mapel; ?>"
                                        hidden>
                                        <select class="form-select" name="id_mapel" id="input_namamapel" hidden>
                                            <option value="<?= $id_mapel; ?>"><?= $nama_mapel; ?></option>
                                        </select>
                                        <select class="form-select" name="kelas" id="input_kelasmurid" hidden>
                                            <option value="<?= $kelas; ?>"><?= $kelas; ?></option>
                                        </select>
                                        <select class="form-select" name="jurusan" id="input_kelasjurusan" hidden>
                                            <option value="<?= $id_jurusan; ?>"><?= $nama_jurusan; ?></option>
                                        </select>
                                        <select class="form-select" name="periode" id="input_thnperiode" hidden>
                                            <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                                        </select>
                                        <input type="text" class="form-control" id="input_periodesemester" name="semester" 
                                        value="<?= $semester; ?>" hidden>

                                        <div class="mb-3">
                                            <label for="input_pesertadidik" class="form-label">Nama Peserta Didik</label>
                                            <?php  
                                                if ($siswa_jumlah > 0) {
                                            ?>
                                                <select class="form-select" name="peserta_didik" id="input_pesertadidik" required>
                                                    <?php  
                                                        foreach ($siswa as $data) :
                                                    ?>
                                                        <option value="<?= $data['id_siswa']; ?>">
                                                        <?= $data['nisn']; ?> - <?= $data['nama_siswa']; ?>
                                                        </option>
                                                    <?php  
                                                        endforeach;
                                                    ?>
                                                </select>
                                             <?php  
                                                } else {
                                            ?>
                                                <input type="text" class="form-control"  value="Belum ada data peserta didik" disabled>
                                            <?php  
                                                }
                                            ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_PTS" class="form-label">Nilai PTS</label>
                                            <input type="text" class="form-control" id="input_PTS" name="nilai_pts" required>
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
