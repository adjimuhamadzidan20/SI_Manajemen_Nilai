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
                    <h3 class="mt-3 text-uppercase">Daftar Mata Pelajaran</h3>
                    <p class="text-uppercase mb-2">Tahun Ajaran <?= $tahun_ajaran; ?></p>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Mapel</li>
                        <li class="breadcrumb-item active">Tahun Ajaran <?= $tahun_ajaran; ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="/daftar_mapel" class="btn btn-primary btn-sm">Kembali</a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_mapel"><i class="fas fa-plus"></i> Tambah</button>

                                <?php  
                                    if ($jumlah > 0) {
                                ?>
                                    <a href="/daftar_mapel/cetak_mapel_pdf/<?= $id_periode; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-pdf"></i> Cetak PDF</a>
                                    <a href="/daftar_mapel/cetak_mapel_excel/<?= $id_periode; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-excel"></i> Cetak Excel</a>
                                <?php  
                                    } else {
                                ?>
                                    <button href="/daftar_mapel/cetak_mapel_pdf/<?= $id_periode; ?>" class="btn btn-primary btn-sm" disabled>
                                    <i class="fas fa-file-pdf"></i> Cetak PDF</button>
                                    <button href="/daftar_mapel/cetak_mapel_excel/<?= $id_periode; ?>" class="btn btn-primary btn-sm" disabled>
                                    <i class="fas fa-file-excel"></i> Cetak Excel</button>
                                <?php  
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">Kode</th>
                                        <th class="text-start">Nama Mapel</th>
                                        <th class="text-start">Kelas</th>
                                        <th class="text-start">Jurusan</th>
                                        <th class="text-start">Tahun Ajaran</th>
                                        <th class="text-start">Guru Mapel</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0; 
                                        foreach ($mapel as $data) : 
                                        $no++;
                                    ?>
                                        <tr>
                                            <td class="text-start"><?= $no; ?></td>
                                            <td class="text-start"><?= $data['kd_mapel']; ?></td>
                                            <td class="text-start"><?= $data['nama_mapel']; ?></td>
                                            <td class="text-start"><?= $data['kelas']; ?></td>
                                            <td class="text-start"><?= $data['nama_jurusan']; ?></td>
                                            <td class="text-start"><?= $data['tahun_ajaran']; ?></td>
                                            <td class="text-start"><?= $data['guru']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ubah_mapel"
                                                data-id="<?= $data['id_mapel']; ?>"
                                                data-kdmapel="<?= $data['kd_mapel']; ?>"
                                                data-mapel="<?= $data['nama_mapel']; ?>"
                                                data-kelas="<?= $data['kelas']; ?>"
                                                data-jurusan="<?= $data['id_jurusan']; ?>"
                                                data-periode="<?= $data['id_periode']; ?>"
                                                data-guru="<?= $data['guru']; ?>"
                                                title="Ubah">
                                                <i class="fas fa-edit"></i></button>

                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                                data-bs-target="#hapus_mapel_<?= $data['id_mapel']; ?>"
                                                title="Hapus"><i class="fas fa-trash"></i></button> 

                                                <!-- modal hapus -->
                                                <div class="modal fade" tabindex="-1" id="hapus_mapel_<?= $data['id_mapel']; ?>">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title">Hapus data mapel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body text-start">
                                                        <p>Anda yakin ingin menghapus <?= $data['nama_mapel']; ?> <?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?>?</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                        <a href="/daftar_mapel/hapus/<?= $data['id_mapel']; ?>" class="btn btn-primary">Hapus</a>
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
            <div class="modal fade" id="tambah_mapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data mapel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_mapel/tambah" method="post">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col">
                            <select class="form-select" aria-label="Default select example" name="periode" hidden>
                                <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                            </select>
                            <div class="mb-3">
                                <label for="exampleInputKdMapel" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="exampleInputKdMapel" name="kd_mapel" value="<?= $kode; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputMapel" class="form-label">Nama Mata Pelajaran</label>
                                <input type="text" class="form-control" id="exampleInputMapel" name="mapel" placeholder="Masukkan Nama Mapel" required>
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
                            <div class="mb-3">
                                <label for="exampleInputJurusan" class="form-label">Jurusan</label>
                                <select class="form-select" aria-label="Default select example" name="jurusan" id="exampleInputJurusan" required>
                                    <option value="" selected>-- Pilih Jurusan --</option>
                                    <?php 
                                        foreach($jurusan as $data) : 
                                    ?>
                                        <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                                    <?php  
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputGuru" class="form-label">Guru Mapel</label>
                                <input type="text" class="form-control" id="exampleInputGuru" name="guru" placeholder="Masukkan Nama Guru Mapel" required>
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
            <div class="modal fade" id="ubah_mapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data mapel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/daftar_mapel/ubah" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                              <input type="text" class="form-control" name="id" id="id" hidden>
                              <select class="form-select" name="periode" id="input_periode" hidden>
                                <option value="<?= $id_periode; ?>"><?= $tahun_ajaran; ?></option>
                              </select>
                              <div class="mb-3">
                                <label for="input_kdmapel" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="input_kdmapel" name="kd_mapel" readonly>
                              </div>
                              <div class="mb-3">
                                <label for="input_mapel" class="form-label">Nama Mata Pelajaran</label>
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
                                <label for="input_jurusan" class="form-label">Jurusan</label>
                                <select class="form-select" aria-label="Default select example" name="jurusan" id="input_jurusan" required>
                                    <option selected>-- Pilih Jurusan --</option>
                                    <?php 
                                        foreach($jurusan as $data) : 
                                    ?>
                                        <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                                    <?php  
                                        endforeach;
                                    ?>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="input_guru" class="form-label">Guru Mapel</label>
                                <input type="text" class="form-control" id="input_guru" name="guru" required>
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
