<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Dashboard</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<?php if (session('error') !== null) : ?>
			<div class="alert alert-danger" role="alert"><?= session('error') ?></div>
		<?php endif ?>

		<?php if (session('message') !== null) : ?>
			<div class="alert alert-success" role="alert"><?= session('message') ?></div>
		<?php endif ?>
		<!-- Small boxes (Stat box) -->
		<?php if(session()->get('jabatan') == "Admin") { ?>
		<div class="row">
			<div class="col-lg-8 col-12">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h4>Rp. <?=number_format( $Saldo, 0, '.', ',') ?></h4>
						<p>Total Saldo</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(session()->get('jabatan') == "Customer") { ?>
		<div class="row">
			<div class="col-lg-6 col-12">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h4>Rp. <?=number_format( $Saldo, 0, '.', ',') ?></h4>
						<p>Total Saldo</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<?php if(session()->get('jabatan') == "Admin" ) { ?>
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h4 class="text-white"><?= $Pengguna ?></h4>
							<p class="text-white">Total Pengguna</p>
						</div>
						<div class="icon">
							<i class="fas fa-users"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h4>Rp. <?= number_format($UangMasuk,0,".",",") ?></h4>
							<p>Total Uang Masuk</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h4>Rp. <?= number_format($UangKeluar,0,".",",") ?></h4>
							<p>Total Uang Keluar</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if(session()->get('jabatan') == "Customer") { ?>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h4>Rp. <?= number_format($UangMasuk,0,".",",") ?></h4>
							<p>Total Uang Masuk</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h4>Rp. <?= number_format($UangKeluar,0,".",",") ?></h4>
							<p>Total Uang Keluar</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
					</div>
				</div>
			<?php } ?>
			<!-- ./col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>