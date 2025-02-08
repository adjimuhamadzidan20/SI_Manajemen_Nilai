<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Beranda</div>
                <a class="nav-link <?php if ($linkActive == 'dashboard') { echo 'active'; } ?>" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Master Menu</div>
                <a class="nav-link <?php if ($linkActive == 'periode') { echo 'active'; } ?>" href="/periode_ajar">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                    Periode Ajaran
                </a>
                <a class="nav-link <?php if ($linkActive == 'daftar_jurusan') { echo 'active'; }?>" href="/daftar_jurusan">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Daftar Jurusan
                </a>
                <a class="nav-link <?php if ($linkActive == 'daftar_kelas') { echo 'active'; }?>" href="/daftar_kelas">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Daftar Kelas
                </a>
                <a class="nav-link <?php if ($linkActive == 'daftar_mapel') { echo 'active'; }?>" href="/daftar_mapel">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Daftar Mapel
                </a>
                <a class="nav-link <?php if ($linkActive == 'daftar_siswa') { echo 'active'; }?>" href="/daftar_siswa">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Daftar Peserta Didik
                </a>
                 <a class="nav-link <?php if ($linkActive == 'daftar_nilai') { echo 'active'; }?>" href="/daftar_nilai">
                    <div class="sb-nav-link-icon"><i class="fas fa-bar-chart"></i></div>
                    Daftar Nilai
                </a>
            </div>
        </div>
    </nav>
</div>