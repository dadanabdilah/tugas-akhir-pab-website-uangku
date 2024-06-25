<aside class="main-sidebar sidebar-light-primary">
	<!-- Brand Logo -->
	<a href="<?= base_url('dashboard') ?>" class="brand-link text-center">
		<!-- <img src="<?= base_url() ?>assets/img/uangku.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
		<span class="brand-text font-weight-light">
			<img src="<?= base_url() ?>assets/img/uangku.png" alt="Logo" class="image" width="200px" style="opacity: .8">
		</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/img/user-avatar.webp" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= session()->get('nama_pengguna') ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<?php if(session()->get('jabatan') == "Admin") { ?>
					<li class="nav-item">
						<a href="<?= base_url('pengguna') ?>" class="nav-link">
							<i class="nav-icon fas fa-users"></i>
							<p>
								Data Pengguna
							</p>
						</a>
					</li>
				<?php } ?>
				<?php if(session()->get('jabatan') == "Admin" OR session()->get('jabatan') == "Customer") { ?>
					<li class="nav-item">
						<a href="<?= base_url('rekening') ?>" class="nav-link">
							<i class="nav-icon fas fa-dollar-sign"></i>
							<p>
								Data Rekening
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('kategori') ?>" class="nav-link">
						<i class="nav-icon fas fa-table"></i>
							<p>
								Data Kategori
							</p>
						</a>
					</li>
				<?php } ?>
				<?php if(session()->get('jabatan') == "Admin" OR session()->get('jabatan') == "Customer") { ?>
				<li class="nav-item">
					<a href="#" class="nav-link">
					<i class="nav-icon fas fa-book"></i>
						<p>
							Keuangan
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('keuangan') ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Catatan Keuangan</p>
							</a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<?php if(session()->get('jabatan') == "Admin" OR session()->get('jabatan') == "Customer") { ?>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>
							Laporan
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('laporan/catatan') ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Laporan Keuangan</p>
							</a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<li class="nav-item">
					<a href="<?= base_url('logout') ?>" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>