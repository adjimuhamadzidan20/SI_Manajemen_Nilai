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
            <h3 class="mt-3 text-uppercase">Profil Admin</h3>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Profil Admin</li>
            </ol>
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 mb-3 mb-lg-0">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center my-3">
                          <img class="profile-user-img img-fluid img-circle w-50"
                            src="<?= base_url('assets'); ?>/assets/img/profile.png"
                            alt="User profile picture">
                        </div>
                        <h5 class="profile-username text-center"><?= session()->get('nama_admin'); ?></h5>
                        <p class="text-muted text-center"><?= session()->get('status'); ?></p>
                        <div class="mt-4">
                          <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#ubah_password"><i class="fas fa-edit"></i> Ubah Password</button>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-lg-9">
                    <ol class="list-group">
                      <?php foreach ($dtadmin as $data) : ?>
                        <li class="list-group-item d-block d-sm-flex justify-content-between align-items-center">
                          <div class="ms-sm-2 me-auto mb-2 mb-sm-0">
                            <div class="fw-bold">Username</div>
                            <?= $data['username']; ?>
                          </div>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ubah_username">
                          <i class="fas fa-edit"></i> Ubah</button>
                        </li>
                        <li class="list-group-item d-block d-sm-flex justify-content-between align-items-center">
                          <div class="ms-sm-2 me-auto mb-2 mb-sm-0">
                            <div class="fw-bold">Nama Admin</div>
                            <?= $data['nama_admin']; ?>
                          </div>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ubah_nama">
                          <i class="fas fa-edit"></i> Ubah</button>
                        </li>
                        <li class="list-group-item d-block d-sm-flex justify-content-between align-items-center">
                          <div class="ms-sm-2 me-auto mb-2 mb-sm-0">
                            <div class="fw-bold">Alamat</div>
                            <?= $data['alamat']; ?>
                          </div>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ubah_alamat">
                          <i class="fas fa-edit"></i> Ubah</button>
                        </li>
                        <li class="list-group-item d-block d-sm-flex justify-content-between align-items-center">
                          <div class="ms-sm-2 me-auto mb-2 mb-sm-0">
                            <div class="fw-bold">Email</div>
                            <?= $data['email']; ?>
                          </div>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ubah_email">
                          <i class="fas fa-edit"></i> Ubah</button>
                        </li>
                      <?php  
                        endforeach;
                      ?>
                    </ol>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            
            </div>
          </div>
        </main>

        <!-- Modal ubah password -->
        <div class="modal fade" id="ubah_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/profil_admin/ubah_pass" method="post">
                <div class="modal-body">
                  <input type="text" class="form-control" name="id" value="<?= session()->get('id'); ?>" hidden>
                  <div class="mb-3">
                    <label for="username" class="form-label">Password baru</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal ubah username -->
        <div class="modal fade" id="ubah_username" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data username</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/profil_admin/ubah_username" method="post">
                <div class="modal-body">
                  <input type="text" class="form-control" name="id" value="<?= session()->get('id'); ?>" hidden>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username lama</label>
                    <input type="text" class="form-control" value="<?= session()->get('username'); ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username baru</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan username baru" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal ubah nama admin -->
        <div class="modal fade" id="ubah_nama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data nama admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/profil_admin/ubah_nama" method="post">
                <div class="modal-body">
                  <input type="text" class="form-control" name="id" value="<?= session()->get('id'); ?>" hidden>
                  <div class="mb-3">
                    <label for="nama_admin" class="form-label">Nama admin lama</label>
                    <input type="text" class="form-control" value="<?= session()->get('nama_admin'); ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="nama_admin" class="form-label">Nama admin baru</label>
                    <input type="text" class="form-control" name="nama_admin" placeholder="Masukkan nama admin baru" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal ubah alamat -->
        <div class="modal fade" id="ubah_alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data alamat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/profil_admin/ubah_alamat" method="post">
                <div class="modal-body">
                  <input type="text" class="form-control" name="id" value="<?= session()->get('id'); ?>" hidden>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat lama</label>
                    <input type="text" class="form-control" value="<?= session()->get('alamat'); ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="kd_jur_edit" class="form-label">Alamat baru</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat baru" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal ubah email -->
        <div class="modal fade" id="ubah_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/profil_admin/ubah_email" method="post">
                <input type="text" class="form-control" name="id" value="<?= session()->get('id'); ?>" hidden>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email lama</label>
                    <input type="text" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email baru</label>
                    <input type="text" class="form-control" name="email" placeholder="Masukkan email baru" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

