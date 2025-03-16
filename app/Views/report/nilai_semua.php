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
                    <h3 class="mt-3 text-uppercase"><?= $kelas; ?> <?= $nama_jurusan; ?> - <?= $nama_mapel; ?></h3>
                    <p class="text-uppercase mb-2"><?= 'Semester ' . $semester; ?></p>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/cetak_laporan">Cetak Laporan</a></li>
                        <li class="breadcrumb-item"><a href="/cetak_laporan/cetak_semua/<?= $id_periode; ?>">Cetak Nilai Rapor T.A <?= $tahun_ajaran; ?></a></li>
                        <li class="breadcrumb-item active">
                            <?= $kelas; ?> <?= $nama_jurusan; ?> <?= $nama_mapel; ?> - <?= $semester; ?>
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="/cetak_laporan/cetak_semua/<?= $id_periode; ?>" class="btn btn-primary btn-sm">Kembali</a>
                            </div>
                            <div>
                                <?php
                                if ($jumlah > 0) {
                                ?>
                                    <a href="/laporan_nilai_semua/cetak_nilai_semua_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
                                    <a href="/laporan_nilai_semua/cetak_nilai_semua_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> Cetak Excel</a>
                                <?php
                                } else {
                                ?>
                                    <button href="/laporan_nilai_semua/cetak_nilai_semua_pdf/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm" disabled><i class="fas fa-file-pdf"></i> Cetak PDF</button>
                                    <button href="/laporan_nilai_semua/cetak_nilai_semua_excel/<?= $kelas; ?>/<?= $id_jurusan; ?>/<?= $nama_mapel; ?>/<?= $id_mapel; ?>/<?= $id_periode; ?>/<?= $semester; ?>" class="btn btn-primary btn-sm" disabled><i class="fas fa-file-excel"></i> Cetak Excel</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                        <?php
                            if ($jumlah > 0) {
                        ?>
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" style="font-size: 14px;" rowspan="2">No</th>
                                        <th class="text-center align-middle" style="font-size: 14px;" rowspan="2">NIS</th>
                                        <th class="text-center align-middle" style="font-size: 14px;" rowspan="2">NISN</th>
                                        <th class="text-center align-middle" style="font-size: 14px;" rowspan="2">Nama Peserta Didik</th>

                                        <th class="text-nowrap text-center" style="font-size: 14px;" colspan="3">Lingkup Materi 1</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;" colspan="3">Lingkup Materi 2</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;" colspan="3">Lingkup Materi 3</th>

                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">NA<br>(M)</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">LM1</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">LM2</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">LM3</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">NA<br>(S)</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">PTS</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">PAT</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">NA</th>
                                        <th class="text-nowrap text-center align-middle" style="font-size: 14px;" rowspan="2">NR</th>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP1</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP2</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP3</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP1</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP2</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP3</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP1</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP2</th>
                                        <th class="text-nowrap text-center" style="font-size: 14px;">TP3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($nilai as $data) :
                                        $no++;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td class="text-center"><?= $data['nis']; ?></td>
                                            <td class="text-center"><?= $data['nisn']; ?></td>
                                            <td><?= $data['nama_siswa']; ?></td>
                                            <td class="text-center"><?= $data['nilai_1']; ?></td>
                                            <td class="text-center"><?= $data['nilai_2']; ?></td>
                                            <td class="text-center"><?= $data['nilai_3']; ?></td>
                                            <td class="text-center"><?= $data['nilai_4']; ?></td>
                                            <td class="text-center"><?= $data['nilai_5']; ?></td>
                                            <td class="text-center"><?= $data['nilai_6']; ?></td>
                                            <td class="text-center"><?= $data['nilai_7']; ?></td>
                                            <td class="text-center"><?= $data['nilai_8']; ?></td>
                                            <td class="text-center"><?= $data['nilai_9']; ?></td>
                                            <td class="text-center"><?= $data['na_materi']; ?></td>
                                            <td class="text-center"><?= $data['LM_1']; ?></td>
                                            <td class="text-center"><?= $data['LM_2']; ?></td>
                                            <td class="text-center"><?= $data['LM_3']; ?></td>
                                            <td class="text-center"><?= $data['na_sumatif']; ?></td>
                                            <td class="text-center"><?= $data['pts']; ?></td>
                                            <td class="text-center"><?= $data['pat']; ?></td>
                                            <td class="text-center"><?= $data['nilai_akhir']; ?></td>
                                            <td class="text-center"><?= $data['nilai_rapor']; ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            } else {
                        ?>
                            <div class="border p-2">
                                <div class="fw-normal text-center">Data nilai belum tersedia..</div>
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </main>