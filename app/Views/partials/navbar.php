<!-- Navbar Brand-->
<a class="navbar-brand ps-3 text-uppercase fs-6 d-flex align-items-center" href="/">
    <img src="<?= base_url('assets'); ?>/assets/img/smk_angkasa_1.png" alt="smk_angkasa_1" class="me-2" style="width: 35px;">
    SI Manajemen Nilai
</a>
<!-- Sidebar Toggle-->
<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

<!-- Navbar info -->
<div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-2 my-md-0 text-white text-uppercase small">
    <?= session()->get('nama_admin'); ?> | <?= session()->get('status'); ?>
</div>

<!-- Navbar-->
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/profil_admin"><i class="far fa-user me-1"></i> Profil</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout" style="cursor: pointer;"><i class="fas fa-sign-out me-1"></i> Logout</a></li>
        </ul>
    </li>
</ul>