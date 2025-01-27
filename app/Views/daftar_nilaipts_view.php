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
                    <h2 class="mt-3">Nilai PTS <?= $tahun_ajaran; ?></h2>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Nilai</li>
                        <li class="breadcrumb-item active">Nilai PTS <?= $tahun_ajaran; ?></li>
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
                                        <th>KD Kelas</th>
                                        <th>Kelas</th>
                                        <th>T.A</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0; 
                                        foreach ($kelas as $data) : 
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $data['kd_kelas']; ?></td>
                                            <td><?= $data['kelas']; ?> <?= $data['nama_jurusan']; ?></td>
                                            <td><?= $data['tahun_ajaran']; ?></td>
                                            <td>
                                                <a href="/daftar_siswa/rinci_siswa/<?= $data['id_periode']; ?>/<?= $data['id_kelas'];?>/<?= $data['id_jurusan']; ?>" class="btn btn-primary btn-sm">Lihat Nilai</a> 
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
