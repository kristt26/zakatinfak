<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="/assets/img/baznas.png" rel="icon">
  <title>SIPDZIS Papua - Login</title>
  <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>

                  <!-- tampilkan pesan error / success -->
                  <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                      <?= session()->getFlashdata('error') ?>
                    </div>
                  <?php endif; ?>
                  <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                      <?= session()->getFlashdata('success') ?>
                    </div>
                  <?php endif; ?>

                  <!-- form login -->
                  <form class="user" action="<?= base_url('auth') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                  </form>

                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="/auth/register">Create an Account!</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/assets/js/ruang-admin.min.js"></script>
</body>

</html>
