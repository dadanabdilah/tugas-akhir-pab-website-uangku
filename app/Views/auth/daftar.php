<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b><?= SITE_NAME ?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftar pengguna baru</p>
      <?php if (session('error') !== null) : ?>
          <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
      <?php endif ?>

      <?php if (session('message') !== null) : ?>
          <div class="alert alert-success" role="alert"><?= session('message') ?></div>
      <?php endif ?>

      <form action="<?= base_url('/daftar') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
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
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
            <button type="submit" class="btn btn-block btn-primary">
              Daftar
            </button>
        </div>
      </form>
      <a href="<?= base_url('/login') ?>" class="text-center text-primary">Saya sudah punya akun</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
