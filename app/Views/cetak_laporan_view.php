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
                    <h3 class="text-uppercase mt-3">Cetak Laporan Nilai</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cetak Laporan</li>
                    </ol>
                    <div class="card">
                        <div class="card-header">
                            Cetak Laporan Nilai
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="far fa-file-text me-2"></i> Data Nilai PTS
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php  
                                                if ($jumlah_data == 0) {
                                            ?>
                                                <div>Data belum tersedia..</div>
                                            <?php  
                                                } else { 
                                            ?>
                                                <ul class="list-group list-group-flush">
                                                    <?php
                                                    foreach ($periode as $data) :
                                                    ?>
                                                        <li class="list-group-item d-block d-sm-flex justify-content-between">
                                                            <div class="mb-2 mb-sm-0">
                                                                <i class="far fa-calendar me-2"></i>Tahun Ajaran <?= $data['tahun_ajaran']; ?>
                                                            </div>
                                                            <a href="/cetak_laporan/cetak_pts/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Mapel</a>
                                                        </li>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </ul>
                                            <?php  
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="far fa-file-text me-2"></i> Data Nilai PAS
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php  
                                                if ($jumlah_data == 0) {
                                            ?>
                                                <div>Data belum tersedia..</div>
                                            <?php  
                                                } else { 
                                            ?>
                                                <ul class="list-group list-group-flush">
                                                    <?php
                                                    foreach ($periode as $data) :
                                                    ?>
                                                        <li class="list-group-item d-block d-sm-flex justify-content-between">
                                                            <div class="mb-2 mb-sm-0">
                                                                <i class="far fa-calendar me-2"></i>Tahun Ajaran <?= $data['tahun_ajaran']; ?>
                                                            </div>
                                                            <a href="/cetak_laporan/cetak_pas/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Mapel</a>
                                                        </li>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </ul>
                                            <?php  
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="far fa-file-text me-2"></i> Data Nilai Rapor
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php  
                                                if ($jumlah_data == 0) {
                                            ?>
                                                <div>Data belum tersedia..</div>
                                            <?php  
                                                } else { 
                                            ?>
                                                <ul class="list-group list-group-flush">
                                                    <?php
                                                    foreach ($periode as $data) :
                                                    ?>
                                                        <li class="list-group-item d-block d-sm-flex justify-content-between">
                                                            <div class="mb-2 mb-sm-0">
                                                                <i class="far fa-calendar me-2"></i>Tahun Ajaran <?= $data['tahun_ajaran']; ?>
                                                            </div>
                                                            <a href="/cetak_laporan/cetak_semua/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Mapel</a>
                                                        </li>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </ul>
                                            <?php  
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>