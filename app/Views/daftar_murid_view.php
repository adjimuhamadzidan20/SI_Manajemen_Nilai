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
                    <h3 class="mt-3 text-uppercase">Daftar Peserta Didik</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Peserta Didik</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            Data Daftar Peserta Didik
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="display nowrap table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-start">No</th>
                                        <th class="text-start">Kode</th>
                                        <th class="text-start">Tahun Ajaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0; 
                                        foreach ($periode as $data) : 
                                        $no++;
                                    ?>
                                        <tr>
                                            <td class="text-start"><?= $no; ?></td>
                                            <td class="text-start"><?= $data['kd_ajaran']; ?></td>
                                            <td class="text-start"><?= $data['tahun_ajaran']; ?></td>
                                            <td class="text-center">
                                                <a href="/daftar_siswa/rinci_kelas/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-list"></i> Daftar Kelas
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
