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
                    <h2 class="mt-3">Daftar Mapel</h2>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Mapel</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_mapel">Tambah</button>
                            <button type="button" class="btn btn-primary btn-sm">Cetak PDF</button>
                            <button type="button" class="btn btn-primary btn-sm">Cetak Excel</button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>KD Mapel</th>
                                        <th>Nama Mapel</th>
                                        <th>Kelas</th>
                                        <th>Guru Mapel</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0; 
                                        foreach ($mapel as $data) : 
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $data['kd_mapel']; ?></td>
                                            <td><?= $data['nama_mapel']; ?></td>
                                            <td><?= $data['kelas']; ?></td>
                                            <td><?= $data['guru']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ubah_mapel"
                                                data-id="<?= $data['id_mapel']; ?>"
                                                data-kdmapel="<?= $data['kd_mapel']; ?>"
                                                data-mapel="<?= $data['nama_mapel']; ?>"
                                                data-kelas="<?= $data['kelas']; ?>"
                                                data-guru="<?= $data['guru']; ?>">
                                                Ubah</button>
                                                <a href="/daftar_mapel/hapus/<?= $data['id_mapel']; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Anda ingin menghapusnya?')">Hapus</a> 
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
            <div class="modal fade" id="tambah_mapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Mapel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_mapel/tambah" method="post">
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputKdMapel" class="form-label">KD Mapel</label>
                        <input type="text" class="form-control" id="exampleInputKdMapel" name="kd_mapel" value="<?= $kode; ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputMapel" class="form-label">Nama Mapel</label>
                        <input type="text" class="form-control" id="exampleInputMapel" name="mapel" placeholder="Masukkan Nama Mapel" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputKelas" class="form-label">Kelas</label>
                        <select class="form-select" aria-label="Default select example" name="kelas" id="exampleInputKelas" required>
                            <option selected>-- Pilih Kelas --</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputGuru" class="form-label">Guru Mapel</label>
                        <input type="text" class="form-control" id="exampleInputGuru" name="guru" placeholder="Masukkan Nama Guru Mapel" required>
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
            <div class="modal fade" id="ubah_mapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Mapel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_mapel/ubah" method="post">
                    <div class="modal-body">
                      <input type="text" class="form-control" name="id" id="id" hidden>
                      <div class="mb-3">
                        <label for="input_kdmapel" class="form-label">KD Mapel</label>
                        <input type="text" class="form-control" id="input_kdmapel" name="kd_mapel" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="input_mapel" class="form-label">Nama Mapel</label>
                        <input type="text" class="form-control" id="input_mapel" name="mapel" required>
                      </div>
                      <div class="mb-3">
                        <label for="input_kelas" class="form-label">Kelas</label>
                        <select class="form-select" aria-label="Default select example" name="kelas" id="input_kelas" required>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="input_guru" class="form-label">Guru Mapel</label>
                        <input type="text" class="form-control" id="input_guru" name="guru" required>
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
