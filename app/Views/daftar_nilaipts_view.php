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
                    <h3 class="text-uppercase mt-3">Nilai PTS</h3>
                    <p class="text-uppercase mb-2">Tahun Ajaran <?= $tahun_ajaran; ?></p>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dasboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/daftar_nilai">Daftar Nilai</a></li>
                        <li class="breadcrumb-item active">Nilai PTS T.A <?= $tahun_ajaran; ?></li>
                    </ol>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                          <div>
                            <a href="/daftar_nilai" class="btn btn-primary btn-sm">Kembali</a>
                          </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Guru</th>
                                        <th>Semester</th>
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
                                            <td><?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?></td>
                                            <td><?= $data['guru']; ?></td>
                                            <td>
                                                <a href="/daftar_nilai_pts/peserta_didik/<?= $data['kelas']; ?>/<?= $data['id_jurusan']; ?>/<?= $data['nama_mapel']; ?>/<?= $data['id_mapel']; ?>/<?= $id_periode; ?>/Ganjil" class="btn btn-primary btn-sm">Ganjil</a> 

                                                <a href="/daftar_nilai_pts/peserta_didik/<?= $data['kelas']; ?>/<?= $data['id_jurusan']; ?>/<?= $data['nama_mapel']; ?>/<?= $data['id_mapel']; ?>/<?= $id_periode; ?>/Genap" class="btn btn-primary btn-sm">Genap</a> 
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
