<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="si_manajemen_nilai" />
        <meta name="author" content="adji_muhamad_zidan" />
        <title>SI Manajemen Nilai | Forgot Password</title>
        <link href="<?= base_url('assets'); ?>/css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="<?= base_url('assets'); ?>/assets/img/smk_angkasa_1.ico">

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="card shadow-lg border-0 rounded-lg" style="margin-top: 75px;">
                                    <div class="card-header text-center pt-3 pb-2">
                                        <img src="<?= base_url('assets'); ?>/assets/img/smk_angkasa_1.png" alt="smk_angkasa_1" 
                                        class="w-25 mb-3">
                                        <h6 class="text-center font-weight-light text-uppercase">Forgot Password</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="/forgot_password/ganti_password" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="Email" 
                                                name="email" required />
                                                <label for="inputEmail">Masukkan Email Anda</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input class="form-control" id="inputPasswordBaru" type="password" placeholder="Password Baru" name="password_baru" required />
                                                <label for="inputPasswordBaru">Password Baru</label>
                                            </div>
                                            <div class="d-flex flex-column mb-0">
                                                <button type="submit" class="btn btn-primary mb-3">Ganti Password Anda</button>
                                                <a class="small text-center" href="/login">Kembali Ke Login</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-transparent mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-white">Copyright &copy; SI Manajemen Nilai <?= date('Y'); ?></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets'); ?>/js/scripts.js"></script>
        <script type="text/javascript">
            // pesan alert login
            let notif = document.getElementById('pesan');
            if (notif.style.display = 'block') {
              setTimeout(function() {
                notif.style.opacity = '0'
                notif.style.transition = 'opacity 2s ease-in-out';
                setTimeout(function() {
                    notif.style.display = 'none';
                }, 1000)
              }, 1000);
            }
        </script>
    </body>
</html>
