<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b><?= SITE_NAME ?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>Login</b> dengan email sudah terdaftar.</p>
      <?php if (session('error') !== null) : ?>
          <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
      <?php endif ?>

      <?php if (session('message') !== null) : ?>
          <div class="alert alert-success" role="alert"><?= session('message') ?></div>
      <?php endif ?>

      <form action="<?= base_url('/login') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
            <button type="submit" class="btn btn-block btn-primary">
              Login
            </button>
            <!-- <a href="<?= base_url('dashboard') ?>" class="btn btn-block btn-primary">Login</a> -->
        </div>
        <!-- /.social-auth-links -->
      </form>
      <a href="<?= base_url('/daftar') ?>" class="text-center text-primary">Belum punya akun</a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?= $this->endSection() ?>