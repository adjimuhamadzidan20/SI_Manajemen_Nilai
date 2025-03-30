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
                        <li class="breadcrumb-item"><a href="/cetak_laporan">Cetak Laporan</a></li>
                        <li class="breadcrumb-item"><a href="/cetak_laporan/cetak_pas/<?= $id_periode; ?>">Cetak Nilai PAS T.A <?= $tahun_ajaran; ?></a></li>
                        <li class="breadcrumb-item active"><?= $kelas; ?> <?= $nama_jurusan; ?> <?= $nama_mapel; ?> - <?= $semester; ?></li>
                    </ol>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="/cetak_laporan/cetak_pas/<?= $id_periode; ?>" class="btn btn-primary btn-sm">Kembali</a>
                            </div>
                            <div class="d-none d-sm-inline">
                                <?php  
                                    if ($jumlah > 0) {
                                ?>
                                    <a href="/laporan_nilai_pas/cetak_nilai_pas_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i> Cetak PDF</a>

                                    <a href="/laporan_nilai_pas/cetak_nilai_pas_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> Cetak Excel</a>
                                <?php  
                                    } else {
                                ?>
                                    <button href="/laporan_nilai_pas/cetak_nilai_pas_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm" disabled><i class="fas fa-file-pdf"></i> Cetak PDF</button>

                                    <button href="/laporan_nilai_pas/cetak_nilai_pas_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm" disabled><i class="fas fa-file-excel"></i> Cetak Excel</button>
                                <?php  
                                    }
                                ?>
                            </div>

                            <div class="d-sm-none">
                                <div class="dropdown">
                                  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Opsi</button>

                                  <ul class="dropdown-menu">
                                    <?php  
                                      if ($jumlah > 0) {
                                    ?>
                                      <li><a href="/laporan_nilai_pas/cetak_nilai_pas_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm dropdown-item"><i class="fas fa-file-pdf"></i> Cetak PDF</a></li>
                                      <li><a href="/laporan_nilai_pas/cetak_nilai_pas_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm dropdown-item"><i class="fas fa-file-excel"></i> Cetak Excel</a></li>
                                    <?php  
                                      } else {
                                    ?>
                                      <li>
                                        <button href="/laporan_nilai_pas/cetak_nilai_pas_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm dropdown-item" disabled><i class="fas fa-file-pdf"></i> Cetak PDF</button>
                                      </li>
                                      <li>
                                        <button href="/laporan_nilai_pas/cetak_nilai_pas_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm dropdown-item" disabled><i class="fas fa-file-excel"></i> Cetak Excel</button>
                                      </li>
                                    <?php  
                                      }
                                    ?>
                                  </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                        <?php
                            if ($jumlah > 0) {
                        ?>
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-start text-nowrap">No</th>
                                        <th class="text-start text-nowrap">NIS</th>
                                        <th class="text-start text-nowrap">NISN</th>
                                        <th class="text-start text-nowrap">Nama Peserta Didik</th>
                                        <th class="text-start text-nowrap">Mata Pelajaran</th>
                                        <th class="text-center text-nowrap">Nilai PAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $no = 0;
                                        foreach ($nilai as $data) :
                                        $no++;
                                    ?>
                                        <tr>
                                            <td class="text-start text-nowrap"><?= $no; ?></td>
                                            <td class="text-start text-nowrap"><?= $data['nis']; ?></td>
                                            <td class="text-start text-nowrap"><?= $data['nisn']; ?></td>
                                            <td class="text-start text-nowrap"><?= $data['nama_siswa']; ?></td>
                                            <td class="text-start text-nowrap"><?= $data['nama_mapel']; ?></td>
                                            <td class="text-center text-nowrap"><?= $data['pat']; ?></td>
                                        </tr>
                                    <?php  
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            } else {
                        ?>
                            <div class="border p-2">
                                <div class="fw-normal text-center">Data nilai PAS belum tersedia..</div>
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </main>
