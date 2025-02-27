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
                    <?php  
                      foreach ($kelas as $data) :
                    ?>
                      <h3 class="mt-3 text-uppercase">Daftar Peserta Didik</h3>
                      <p class="text-uppercase mb-2"><?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?> - tahun ajaran <?= $data['tahun_ajaran']; ?></p>
                    <?php  
                      endforeach;
                    ?>
                    <ol class="breadcrumb mb-4">
                      <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="/daftar_siswa">Daftar Peserta Didik</a></li>
                      <?php  
                        foreach ($kelas as $data) :
                      ?>
                        <li class="breadcrumb-item"><a href="/daftar_kelas/rinci_kelas/<?= $data['id_periode']; ?>">Tahun Ajaran <?= $data['tahun_ajaran']; ?></a></li>
                        <li class="breadcrumb-item active">Peserta Didik <?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?></li>
                      <?php  
                        endforeach;
                      ?>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                          <div>
                            <?php  
                              foreach ($kelas as $data) :
                            ?>
                              <a href="/daftar_siswa/rinci_kelas/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm">Kembali</a>
                            <?php  
                              endforeach;
                            ?>
                          </div>
                          <div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_murid"><i class="fas fa-plus"></i> Tambah</button>

                            <?php  
                              foreach ($kelas as $data) :
                            ?>
                              <?php  
                                if ($jumlah > 0) {
                              ?>
                                <a href="/daftar_siswa/cetak_siswa_pdf/<?= $data['id_periode']; ?>/<?= $data['id_kelas']; ?>/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-pdf"></i> Cetak PDF</a>
                                <a href="/daftar_siswa/cetak_siswa_excel/<?= $data['id_periode']; ?>/<?= $data['id_kelas']; ?>/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-excel"></i> Cetak Excel</a>
                              <?php  
                                } else {
                              ?>
                                <button href="/daftar_siswa/cetak_siswa_pdf/<?= $data['id_periode']; ?>/<?= $data['id_kelas']; ?>/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm" disabled>
                                <i class="fas fa-file-pdf"></i> Cetak PDF</button>
                                <button href="/daftar_siswa/cetak_siswa_excel/<?= $data['id_periode']; ?>/<?= $data['id_kelas']; ?>/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm" disabled>
                                <i class="fas fa-file-excel"></i> Cetak Excel</button>
                              <?php  
                                }
                              ?>
                            <?php  
                              endforeach;
                            ?>

                          </div>
                        </div>
                        <div class="card-body">
                          <table id="datatablesSimple" class="table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th class="text-start">No</th>
                                <th class="text-start">Kode</th>
                                <th class="text-start">NIS</th>
                                <th class="text-start">NISN</th>
                                <th class="text-start">Nama Peserta Didik</th>
                                <th class="text-start">Kelas</th>
                                <th class="text-start">Tahun Ajaran</th>
                                <th class="text-center">Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $no = 0; 
                                foreach ($siswa as $data) : 
                                $no++;
                              ?>
                                <tr>
                                  <td class="text-start"><?= $no; ?></td>
                                  <td class="text-start"><?= $data['kd_siswa']; ?></td>
                                  <td class="text-start"><?= $data['nis']; ?></td>
                                  <td class="text-start"><?= $data['nisn']; ?></td>
                                  <td class="text-start"><?= $data['nama_siswa']; ?></td>
                                  <td class="text-start"><?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?></td>
                                  <td class="text-start"><?= $data['tahun_ajaran']; ?></td>
                                  <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#ubah_murid"
                                    data-id="<?= $data['id_siswa']; ?>"
                                    data-kdsiswa="<?= $data['kd_siswa']; ?>"
                                    data-nis="<?= $data['nis']; ?>"
                                    data-nisn="<?= $data['nisn']; ?>"
                                    data-siswa="<?= $data['nama_siswa']; ?>"
                                    data-kelas="<?= $data['id_kelas']; ?>"
                                    data-jurusan="<?= $data['id_jurusan']; ?>"
                                    data-periode="<?= $data['id_periode']; ?>"
                                    title="Ubah"><i class="fas fa-edit"></i></button>
                                
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#hapus_siswa_<?= $data['id_siswa']; ?>"
                                    title="Hapus"><i class="fas fa-trash"></i></button> 

                                    <!-- modal hapus -->
                                    <div class="modal fade" tabindex="-1" id="hapus_siswa_<?= $data['id_siswa']; ?>">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus data murid</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-start">
                                            <p>Anda yakin ingin menghapus <?= $data['nama_siswa']; ?>?</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                            <a href="/daftar_siswa/hapus/<?= $data['id_siswa']; ?>" class="btn btn-primary">Hapus</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal tambah -->
            <div class="modal fade" id="tambah_murid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-plus me-2"></i>Tambah data murid</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_siswa/tambah" method="post">
                    <div class="modal-body">
                      <div class="row mb-2">
                        <div class="col">
                          <?php  
                            foreach ($kelas as $data) :
                          ?>
                            <h6 class="text-uppercase">
                              <?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?> - tahun ajaran <?= $data['tahun_ajaran']; ?>   
                            </h6>
                          <?php  
                            endforeach;
                          ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label for="exampleInputKdsiswa" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="exampleInputKdsiswa" name="kd_siswa" value="<?= $kode; ?>" readonly>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputNis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="exampleInputNis" name="nis" placeholder="Masukkan NIS" required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputNisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="exampleInputNisn" name="nisn" placeholder="Masukkan NISN" required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputMurid" class="form-label">Nama Peserta Didik</label>
                            <input type="text" class="form-control" id="exampleInputMurid" name="nama_murid" placeholder="Masukkan Nama Peserta Didik" required>
                          </div>
                        </div>
                        <div class="col" hidden>
                          <div class="mb-3">
                            <label for="exampleInputKelas" class="form-label">Kelas</label>
                            <select class="form-select" aria-label="Default select example" name="kelas" id="exampleInputKelas">
                              <?php  
                                foreach ($kelas as $data) :
                              ?>
                                <option value="<?= $data['id_kelas']; ?>"><?= $data['kelas']; ?></option>
                              <?php  
                                endforeach;
                              ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputJurusan" class="form-label">Jurusan</label>
                            <select class="form-select" aria-label="Default select example" name="jurusan" id="exampleInputJurusan" required>
                              <?php  
                                foreach ($kelas as $data) :
                              ?>
                                <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                              <?php  
                                endforeach;
                              ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputTahun" class="form-label">Tahun Ajaran</label>
                            <select class="form-select" aria-label="Default select example" name="tahun" id="exampleInputTahun" required>
                              <?php  
                                foreach ($kelas as $data) :
                              ?>
                                <option value="<?= $data['id_periode']; ?>"><?= $data['tahun_ajaran']; ?></option>
                              <?php  
                                endforeach;
                              ?>
                            </select>
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
            <div class="modal fade" id="ubah_murid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-edit me-2"></i>Ubah data murid</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_siswa/ubah" method="post">
                    <div class="modal-body">
                      <div class="row mb-2">
                        <div class="col">
                          <?php  
                            foreach ($kelas as $data) :
                          ?>
                            <h6 class="text-uppercase">
                              <?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?> - tahun ajaran <?= $data['tahun_ajaran']; ?>   
                            </h6>
                          <?php  
                            endforeach;
                          ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" name="id" id="id" hidden>
                          <div class="mb-3">
                            <label for="input_kdsiswa" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="input_kdsiswa" name="kd_siswa" value="<?= $kode; ?>" 
                            readonly>
                          </div>
                          <div class="mb-3">
                            <label for="input_nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="input_nis" name="nis" placeholder="Masukkan NIS" required>
                          </div>
                          <div class="mb-3">
                            <label for="input_nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="input_nisn" name="nisn" placeholder="Masukkan NISN" required>
                          </div>
                          <div class="mb-3">
                            <label for="input_murid" class="form-label">Nama Peserta Didik</label>
                            <input type="text" class="form-control" id="input_murid" name="nama_murid" placeholder="Masukkan Nama Peserta Didik" required>
                          </div>
                        </div>
                        <div class="col" hidden>
                          <div class="mb-3">
                            <label for="input_kelas" class="form-label">Kelas</label>
                            <select class="form-select" aria-label="Default select example" name="kelas" id="input_kelas">
                              <?php  
                                foreach ($kelas as $data) :
                              ?>
                                <option value="<?= $data['id_kelas']; ?>"><?= $data['kelas']; ?></option>
                              <?php  
                                endforeach;
                              ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="input_jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" aria-label="Default select example" name="jurusan" id="input_jurusan" required>
                              <?php  
                                foreach ($kelas as $data) :
                              ?>
                                <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                              <?php  
                                endforeach;
                              ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="input_tahun" class="form-label">Tahun Ajaran</label>
                            <select class="form-select" aria-label="Default select example" name="tahun" id="input_tahun" required>
                              <?php  
                                foreach ($kelas as $data) :
                              ?>
                                <option value="<?= $data['id_periode']; ?>"><?= $data['tahun_ajaran']; ?></option>
                              <?php  
                                endforeach;
                              ?>
                            </select>
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
