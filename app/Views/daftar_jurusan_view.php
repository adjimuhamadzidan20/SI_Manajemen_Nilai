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
                    <h2 class="mt-3">Daftar Jurusan</h2>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Jurusan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_jurusan">Tambah</button>
                            <button type="button" class="btn btn-primary btn-sm">Cetak PDF</button>
                            <button type="button" class="btn btn-primary btn-sm">Cetak Excel</button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>KD Jurusan</th>
                                        <th>Nama Jurusan</th>
                                        <th>Nama Kepanjangan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0; 
                                        foreach ($jurusan as $data) : 
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $data['kd_jurusan']; ?></td>
                                            <td><?= $data['nama_jurusan']; ?></td>
                                            <td><?= $data['nama_panjang']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ubah_jurusan"
                                                data-id="<?= $data['id_jurusan']; ?>"
                                                data-kdjurusan="<?= $data['kd_jurusan']; ?>"
                                                data-namajurusan="<?= $data['nama_jurusan']; ?>"
                                                data-namapanjang="<?= $data['nama_panjang']; ?>">
                                                Ubah</button>
                                                <a href="/daftar_jurusan/hapus/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Anda ingin menghapusnya?')">Hapus</a> 
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
            <div class="modal fade" id="tambah_jurusan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_jurusan/tambah" method="post">
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputKdJurusan" class="form-label">KD Jurusan</label>
                        <input type="text" class="form-control" id="exampleInputKdJurusan" name="kd_jurusan" value="<?= $kode; ?>"readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputNamaJur" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="exampleInputNamaJur" placeholder="Masukkan Nama Jurusan" name="nama_jurusan">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputNamaPanjang" class="form-label">Nama Kepanjangan</label>
                        <input type="text" class="form-control" id="exampleInputNamaPanjang" placeholder="Masukkan Nama Panjang" name="nama_panjang">
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
            <div class="modal fade" id="ubah_jurusan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Jurusan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_jurusan/ubah" method="post">
                    <div class="modal-body">
                        <input type="text" class="form-control" name="id" id="id" hidden>
                        <div class="mb-3">
                            <label for="kd_jur_edit" class="form-label">KD Jurusan</label>
                            <input type="text" class="form-control" id="kd_jur_edit" name="kd_jurusan" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan_edit" class="form-label">Nama Jurusan</label>
                            <input type="text" class="form-control" id="jurusan_edit" name="nama_jurusan">
                        </div>
                        <div class="mb-3">
                            <label for="panjangjurusan_edit" class="form-label">Nama Kepanjangan</label>
                            <input type="text" class="form-control" id="panjangjurusan_edit" name="nama_panjang">
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
