<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/assets/img/baznas.png" rel="icon">
    <title>SIPDZIS Papua - Register</title>
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/ruang-admin.min.css" rel="stylesheet">
    <style>
        small.text-danger {
            display: block;
            margin-top: 5px;
        }
    </style>
</head>

<body class="bg-gradient-login">
    <!-- Register Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form action="/auth/register" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('nama'); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?= set_value('telepon') ?>">
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('telepon'); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('email'); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control"><?= set_value('alamat') ?></textarea>
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('alamat'); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">-- Pilih Role --</option>
                                                <option value="muzaki" <?= set_select('role', 'muzaki') ?>>Muzaki</option>
                                                <option value="mustahik" <?= set_select('role', 'mustahik') ?>>Mustahik</option>
                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('role'); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>">
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('username'); ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            <?php if (isset($validation)) : ?>
                                                <small class="text-danger"><?= $validation->getError('password'); ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="/auth">Already have an account?</a>
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
    <!-- Register Content -->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/assets/js/ruang-admin.min.js"></script>
</body>

</html>