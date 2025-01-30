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
                    	<h3 class="text-uppercase mt-3">Daftar Nilai</h3>
                    	<ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Nilai</li>
                    	</ol>
                    	<div class="card">
                    		<div class="card-header">
                    			Daftar Nilai Peserta Didik
                    		</div>
                    		<div class="card-body">
                    			<div class="accordion" id="accordionExample">
									  <div class="accordion-item">
									    <h2 class="accordion-header">
									      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									      	Nilai Tugas
									      </button>
									    </h2>
									    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
									      <div class="accordion-body">
				                    		<ul class="list-group list-group-flush">
					                    		<?php  
					                        	foreach ($periode as $data) :
					                    		?>
													  <li class="list-group-item d-flex justify-content-between">
													  	<?= $data['kd_ajaran']; ?> - Tahun Ajaran <?= $data['tahun_ajaran']; ?>
													  	<a href="/daftar_nilai/nilai_tugas_periode/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm">Lihat Mapel</a></li>
													<?php  
						                        endforeach;
						                    	?>
												</ul>
									      </div>
									    </div>
									  </div>
									  <div class="accordion-item">
									    <h2 class="accordion-header">
									      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									        Nilai PTS
									      </button>
									    </h2>
									    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
									      <div class="accordion-body">
									        	<ul class="list-group list-group-flush">
					                    		<?php  
					                        	foreach ($periode as $data) :
					                    		?>
													  <li class="list-group-item d-flex justify-content-between">
													  	<?= $data['kd_ajaran']; ?> - Tahun Ajaran <?= $data['tahun_ajaran']; ?>
													  	<a href="/daftar_nilai/nilai_pts_periode/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm">Lihat Kelas</a></li>
													<?php  
						                        endforeach;
						                    	?>
												</ul>
									      </div>
									    </div>
									  </div>
									  <div class="accordion-item">
									    <h2 class="accordion-header">
									      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									        Nilai PAS
									      </button>
									    </h2>
									    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
									      <div class="accordion-body">
									        	<ul class="list-group list-group-flush">
					                    		<?php  
					                        	foreach ($periode as $data) :
					                    		?>
													  <li class="list-group-item d-flex justify-content-between">
													  	<?= $data['kd_ajaran']; ?> - Tahun Ajaran <?= $data['tahun_ajaran']; ?>
													  	<a href="/daftar_nilai/nilai_pas_periode/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm">Lihat Kelas</a></li>
													<?php  
						                        endforeach;
						                    	?>
												</ul>
									      </div>
									    </div>
									  </div>
									</div>
                    		</div>
                    	</div>
                </div>
            </main>
