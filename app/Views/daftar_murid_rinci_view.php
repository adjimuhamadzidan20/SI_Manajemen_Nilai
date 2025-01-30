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
                    <h3 class="mt-3 text-uppercase">Daftar Peserta Didik</h3>
                    <p class="text-uppercase mb-2">Periode <?= $tahun_ajaran; ?></p>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/daftar_siswa">Daftar Peserta Didik</a></li>
                        <li class="breadcrumb-item active">Tahun Ajaran <?= $tahun_ajaran; ?></li>
                    </ol>
                    <div class="card">
                      <div class="card-header">
                        <div class="d-flex justify-content-between">
                          <div>
                            <a href="/daftar_siswa" class="btn btn-primary btn-sm">Kembali</a>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <ol class="list-group">
                          <?php
                            if ($jumlah > 0) {  
                              foreach ($kelas as $data) :
                          ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <div class="ms-2 me-auto">
                                <div class="fw-normal"><?= $data['kd_kelas']; ?> - <?= $data['kelas']; ?>
                                <?= $data['nama_jurusan']; ?></div>
                              </div>
                              <a href="/daftar_siswa/rinci_siswa/<?= $data['id_periode']; ?>/<?= $data['id_kelas']; ?>/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm">Lihat Peserta Didik</a>
                            </li>
                          <?php  
                              endforeach;
                            } else {
                          ?>
                            <li class="list-group-item align-items-center">
                              <div class="ms-2 me-auto">
                                <div class="fw-normal text-center">Daftar kelas tidak tersedia..</div>
                              </div>
                            </li>
                          <?php  
                            }
                          ?>
                        </ol>
                      </div>
                    </div>
                </div>
            </main>
