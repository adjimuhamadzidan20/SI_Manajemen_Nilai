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
          <h3 class="mt-3 text-uppercase">Daftar Kelas</h3>
          <p class="text-uppercase mb-2">Tahun Ajaran <?= $tahun_ajaran; ?></p>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/daftar_kelas">Daftar Kelas</a></li>
            <li class="breadcrumb-item active">Tahun Ajaran <?= $tahun_ajaran; ?></li>
          </ol>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div>
                <a href="/daftar_kelas" class="btn btn-primary btn-sm">Kembali</a>
              </div>

              <div class="d-none d-sm-inline">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                data-bs-target="#tambah_kelas"><i class="fas fa-plus"></i> Tambah</button>

                <?php  
                  if ($jumlah > 0) {
                ?>
                  <a href="/daftar_kelas/cetak_kelas_pdf/<?= $id_periode; ?>" class="btn btn-primary btn-sm">
                  <i class="fas fa-file-pdf"></i> Cetak PDF</a>
                  <a href="/daftar_kelas/cetak_kelas_excel/<?= $id_periode; ?>" class="btn btn-primary btn-sm">
                  <i class="fas fa-file-excel"></i> Cetak Excel</a>
                <?php  
                  } else {
                ?>
                  <button href="/daftar_kelas/cetak_kelas_pdf/<?= $id_periode; ?>" class="btn btn-primary btn-sm" disabled>
                  <i class="fas fa-file-pdf"></i> Cetak PDF</button>
                  <button href="/daftar_kelas/cetak_kelas_excel/<?= $id_periode; ?>" class="btn btn-primary btn-sm" disabled>
                  <i class="fas fa-file-excel"></i> Cetak Excel</button>
                <?php  
                  }
                ?>
              </div>

              <div class="d-sm-none">
                <div class="dropdown">
                  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Opsi</button>

                  <ul class="dropdown-menu">
                    <li><button type="button" class="btn btn-primary btn-sm dropdown-item" data-bs-toggle="modal" data-bs-target="#tambah_kelas"><i class="fas fa-plus"></i> Tambah</button></li>

                    <?php  
                      if ($jumlah > 0) {
                    ?>
                      <li><a href="/daftar_kelas/cetak_kelas_pdf/<?= $id_periode; ?>" class="btn btn-primary btn-sm dropdown-item">
                      <i class="fas fa-file-pdf"></i> Cetak PDF</a></li>
                      <li><a href="/daftar_kelas/cetak_kelas_excel/<?= $id_periode; ?>" class="btn btn-primary btn-sm dropdown-item">
                      <i class="fas fa-file-excel"></i> Cetak Excel</a></li>
                    <?php  
                      } else {
                    ?>
                      <li><button href="/daftar_kelas/cetak_kelas_pdf/<?= $id_periode; ?>" class="btn btn-primary btn-sm dropdown-item" disabled><i class="fas fa-file-pdf"></i> Cetak PDF</button></li>
                      <li><button href="/daftar_kelas/cetak_kelas_excel/<?= $id_periode; ?>" class="btn btn-primary btn-sm dropdown-item" disabled><i class="fas fa-file-excel"></i> Cetak Excel</button></li>
                    <?php  
                      }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="display nowrap table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-start">No</th>
                    <th class="text-start">Kode</th>
                    <th class="text-start">Program Keahlian</th>
                    <th class="text-start">Kelas</th>
                    <th class="text-start">Tahun Ajaran</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 0; 
                    foreach ($kelas as $data) : 
                    $no++;
                  ?>
                    <tr>
                      <td class="text-start"><?= $no; ?></td>
                      <td class="text-start"><?= $data['kd_kelas']; ?></td>
                      <td class="text-start"><?= $data['nama_jurusan']; ?></td>
                      <td class="text-start"><?= $data['kelas']; ?></td>
                      <td class="text-start"><?= $data['tahun_ajaran']; ?></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#ubah_kelas"
                        data-id="<?= $data['id_kelas']; ?>"
                        data-kdkelas="<?= $data['kd_kelas']; ?>"
                        data-jurusan="<?= $data['id_jurusan']; ?>"
                        data-kelas="<?= $data['kelas']; ?>"
                        data-tahun="<?= $data['id_periode']; ?>"
                        title="Ubah"><i class="fas fa-edit"></i></button>

                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#hapus_kelas_<?= $data['id_kelas']; ?>"
                        title="Hapus"><i class="fas fa-trash"></i></button> 

                        <!-- modal hapus -->
                        <div class="modal fade" tabindex="-1" id="hapus_kelas_<?= $data['id_kelas']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Hapus data kelas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body text-start">
                                <p>Anda yakin ingin menghapus <?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?>?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <a href="/daftar_kelas/hapus/<?= $data['id_kelas']; ?>" class="btn btn-primary">Hapus</a>
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
      <div class="modal fade" id="tambah_kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/daftar_kelas/tambah" method="post">  
              <div class="modal-body">
                <div class="mb-3">
                  <label for="exampleInputKdKelas" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="exampleInputKdKelas" name="kd_kelas" value="<?= $kode; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputKeahlian" class="form-label">Program Keahlian</label>
                  <select class="form-select" aria-label="Default select example" name="keahlian" id="exampleInputKeahlian" required>
                    <option value="" selected>-- Pilih Program Keahlian --</option>
                    <?php  
                        foreach ($jurusan as $data) :
                    ?>
                        <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?> 
                        (<?= $data['nama_panjang']; ?>)
                        </option>
                    <?php  
                        endforeach;
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputKelas" class="form-label">Kelas</label>
                  <select class="form-select" aria-label="Default select example" name="kelas" id="exampleInputKelas" required>
                    <option value="" selected>-- Pilih Kelas --</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                  </select>
                </div>
                <div class="mb-3" hidden>
                  <label for="exampleInputPeriode" class="form-label">Tahun Ajaran</label>
                  <select class="form-select" aria-label="Default select example" name="tahun" id="exampleInputPeriode" required>
                    <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                  </select>
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
      <div class="modal fade" id="ubah_kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/daftar_kelas/ubah" method="post">  
              <div class="modal-body">
                <input type="text" class="form-control" name="id" id="id" hidden>
                <div class="mb-3">
                  <label for="input_kdkelas" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="input_kdkelas" name="kd_kelas" readonly>
                </div>
                <div class="mb-3">
                  <label for="input_keahlian" class="form-label">Program Keahlian</label>
                  <select class="form-select" aria-label="Default select example" name="keahlian" id="input_keahlian" required>
                    <?php  
                        foreach ($jurusan as $data) :
                    ?>
                        <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?> 
                        (<?= $data['nama_panjang']; ?>)
                        </option>
                    <?php  
                        endforeach;
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="input_kelas" class="form-label">Kelas</label>
                  <select class="form-select" aria-label="Default select example" name="kelas" id="input_kelas" required>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                  </select>
                </div>
                <div class="mb-3" hidden>
                  <label for="input_periode" class="form-label">Tahun Ajaran</label>
                  <select class="form-select" aria-label="Default select example" name="tahun" id="input_periode" required>
                    <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                  </select>
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

      <form method="post">
        <input type="text" name="id_period" value="<?= $id_periode; ?>" hidden>
      </form>
