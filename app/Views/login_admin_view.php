<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="si_manajemen_nilai" />
        <meta name="author" content="adji_muhamad_zidan" />
        <title>SI Manajemen Nilai | Login</title>
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
                                        <h5 class="text-center font-weight-light text-uppercase">SI Manajemen Nilai</h5>
                                    </div>
                                    <div class="card-body">

                                        <!-- alert pesan error -->
                                        <?php  
                                            if (session()->getFlashData('alert')) :
                                        ?>
                                            <div class="alert alert-danger small" role="alert" id="pesan">
                                                <?= session()->getFlashData('alert'); ?>
                                            </div>
                                        <?php  
                                            endif;
                                        ?>
                                        
                                        <form action="/login/masuk" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUser" type="text" placeholder="Username" name="username" required />
                                                <label for="inputUser">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" required />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="remember" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Me</label>
                                            </div>
                                            <div class="d-flex flex-column mb-0">
                                                <button type="submit" class="btn btn-primary mb-3">Masuk</button>
                                                <a class="small text-center" href="/forgot_password">Forgot Password?</a>
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
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-white">Copyright &copy; SI Manajemen Nilai <?= date('Y'); ?></div>
                            <div>
                                <a href="#" class="text-white">Privacy Policy</a>
                                &middot;
                                <a href="#" class="text-white">Terms &amp; Conditions</a>
                            </div>
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
                notif.style.transition = 'opacity 1s ease-in-out';
                setTimeout(function() {
                    notif.style.display = 'none';
                }, 1000)
              }, 1000);
            }
        </script>
    </body>
</html>
