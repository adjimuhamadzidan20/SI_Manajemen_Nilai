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
							<ul class="list-group list-group-flush">
								<?php
								foreach ($periode as $data) :
								?>
									<li class="list-group-item d-flex justify-content-between">
										<div>
											<i class="far fa-calendar me-2"></i>Tahun Ajaran <?= $data['tahun_ajaran']; ?>
										</div>
										<a href="/daftar_nilai/nilai_siswa_periode/<?= $data['id_periode']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Mapel</a>
									</li>
								<?php
								endforeach;
								?>
							</ul>
						</div>
					</div>
				</div>
			</main>