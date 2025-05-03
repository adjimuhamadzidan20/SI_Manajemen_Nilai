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
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Mapel</li>
                    </ol>
                    <div class="card mb-4">
                       <div class="card-header">
                            Daftar data mata pelajaran
                        </div>
                        <div class="card-body">
                            <?php  
                                if ($jumlah_data == 0) {
                            ?>
                                <div>Data belum tersedia..</div>
                            <?php  
                                } else { 
                            ?>
                                <?php  
                                    foreach ($periode as $data) :
                                ?>
                                    <div class="card mb-2">
                                      <div class="card-body d-block d-sm-flex justify-content-between align-items-center">
                                        <div class="mb-2 mb-sm-0">
                                            <i class="far fa-calendar me-2"></i>Tahun Ajaran <?= $data['tahun_ajaran']; ?>
                                        </div>
                                        <a href="/daftar_mapel/periode_mapel/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Mapel</a>
                                      </div>
                                    </div>
                                <?php  
                                    endforeach;
                                ?>
                            <?php } ?>  
                        </div>
                    </div>
                </div>
            </main>
