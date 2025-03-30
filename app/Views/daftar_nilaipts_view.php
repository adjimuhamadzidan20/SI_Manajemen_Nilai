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
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
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
                            <table id="datatablesSimple" class="display nowrap table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">Kode</th>
                                        <th class="text-start">Mata Pelajaran</th>
                                        <th class="text-start">Kelas</th>
                                        <th class="text-start">Guru</th>
                                        <th class="text-center">Semester</th>
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
                                            <td class="text-start"><?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?></td>
                                            <td class="text-start"><?= $data['guru']; ?></td>
                                            <td class="text-center">
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
