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
            <h3 class="mt-3 text-uppercase">Periode Tahun Ajaran</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Periode Tahun Ajaran</li>
            </ol>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_periode">Tambah</button>
                <div>Data periode tahun ajaran</div>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Semester Pertama</th>
                      <th>Semester Kedua</th>
                      <th>Tahun Ajaran</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0; 
                      foreach ($periode as $data) : 
                      $no++;
                    ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['kd_ajaran']; ?></td>
                        <td><?= $data['semester_pertama']; ?></td>
                        <td><?= $data['semester_kedua']; ?></td>
                        <td><?= $data['tahun_ajaran']; ?></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-sm" 
                          data-bs-toggle="modal" 
                          data-bs-target="#ubah_periode"
                          data-id="<?= $data['id_periode']; ?>"
                          data-kdajaran="<?= $data['kd_ajaran']; ?>"
                          data-semester1="<?= $data['semester_pertama']; ?>"
                          data-semester2="<?= $data['semester_kedua']; ?>"
                          data-tahunajaran="<?= $data['tahun_ajaran']; ?>">
                          Ubah</button>
                          <a href="/periode_ajar/hapus/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm" 
                          onclick="return confirm('Anda ingin menghapusnya?')">Hapus</a> 
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
        <div class="modal fade" id="tambah_periode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Periode Ajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/periode_ajar/tambah" method="post">
                <div class="modal-body">
                  <div class="row">
                    <div class="col">
                        <div class="mb-3">
                          <label for="input_kd_ajaran" class="form-label">Kode</label>
                          <input type="text" class="form-control" id="input_kd_ajaran" name="kd_ajaran" value="<?= $kode; ?>" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="input_semester_1" class="form-label">Semester Pertama</label>
                          <input type="text" class="form-control" id="input_semester_1" name="semester_1" value="Semester 1 (Ganjil)" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="input_semester_2" class="form-label">Semester Kedua</label>
                          <input type="text" class="form-control" id="input_semester_2" name="semester_2" value="Semester 2 (Genap)" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="input_ta" class="form-label">Tahun Ajaran</label>
                          <input type="text" class="form-control" id="input_ta" placeholder="Masukkan Tahun Ajaran (ex: 2024/2025)" name="tahun_ajaran" required>
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
        <div class="modal fade" id="ubah_periode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Periode Ajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/periode_ajar/ubah" method="post">
                <div class="modal-body">
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="id" id="id" hidden>
                      <div class="mb-3">
                        <label for="kd_ajaran" class="form-label">Kode</label>
                        <input type="text" class="form-control" name="kd_ajaran" id="kd_ajaran" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="semester_1" class="form-label">Semester Pertama</label>
                        <input type="text" class="form-control" id="semester_1" name="semester_1" value="Semester 1 (Ganjil)" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="semester_2" class="form-label">Semester Kedua</label>
                        <input type="text" class="form-control" id="semester_2" name="semester_2" value="Semester 2 (Genap)" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
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
