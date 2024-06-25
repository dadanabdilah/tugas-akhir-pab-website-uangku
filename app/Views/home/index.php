<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?= SITE_NAME ?></title>
		<meta content="" name="description">
		<meta content="" name="keywords">
		<!-- Favicons -->
		<link rel="icon" href="<?= base_url() ?>assets/img/favicon.ico" type="image/x-icon">
		<link href="<?=  base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com" rel="preconnect">
		<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
		<!-- Vendor CSS Files -->
		<link href="<?=  base_url() ?>assets/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=  base_url() ?>assets/plugin/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="<?=  base_url() ?>assets/plugin/aos/aos.css" rel="stylesheet">
		<link href="<?=  base_url() ?>assets/plugin/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="<?=  base_url() ?>assets/plugin/swiper/swiper-bundle.min.css" rel="stylesheet">
		<!-- Main CSS File -->
		<link href="<?=  base_url() ?>assets/css/main.css" rel="stylesheet">
	</head>
	<body class="index-page">
		<header id="header" class="header d-flex align-items-center sticky-top">
			<div class="container position-relative d-flex align-items-center justify-content-between">
				<nav id="navmenu" class="navmenu">
					<ul>
						<li>
							<a href="<?= base_url() ?>" class="d-flex align-items-center me-auto me-xl-0">
								<!-- Uncomment the line below if you also wish to use an image logo -->
								<img src="<?= base_url() ?>assets/img/uangku.png" width="150px" class="image" alt="Logo">
								<!-- <h1 class="sitename"><?= SITE_NAME ?></h1> -->
							</a>
						</li>
						<li class="ml-auto"><a href="<?= base_url() ?>" class="active">Beranda<br></a></li>
						<li><a href="<?= base_url('login') ?>">Login</a></li>
						<li><a href="<?= base_url('daftar') ?>">Daftar</a></li>
					</ul>
					<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
				</nav>
			</div>
		</header>
		<main class="main">
			<!-- Hero Section -->
			<section id="hero" class="hero section">
				<div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
					<img src="<?=  base_url() ?>assets/img/hero-img.svg" class="img-fluid animated" alt="">
					<h1>Selamat datang di <span><?= SITE_NAME ?></span></h1>
					<p>Simpan semua catatan keuangan anda dengan aman di server kami</p>
					<div class="d-flex">
						<a href="<?= base_url('assets/uangku.apk') ?>" class="btn-get-started scrollto">Download</a>
					</div>
				</div>
			</section>
			<!-- /Hero Section -->
			<!-- Featured Services Section -->
			<section id="featured-services" class="featured-services section">
				<div class="container">
					<div class="row justify-content-center gy-4">
						<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
							<div class="service-item position-relative">
								<div class="icon"><i class="bi bi-activity icon"></i></div>
								<h4><a href="" class="stretched-link">Server Kuat</a></h4>
								<p>Data yang anda simpan diserver kami akan tetap bisa diakses</p>
							</div>
						</div>
						<!-- End Service Item -->
						<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
							<div class="service-item position-relative">
								<div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
								<h4><a href="" class="stretched-link">Keamanan</a></h4>
								<p>Jaminan kemanan data, semua catatan dienkripsi dengan rumit</p>
							</div>
						</div>
						<!-- End Service Item -->
						<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
							<div class="service-item position-relative">
								<div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
								<h4><a href="" class="stretched-link">Manajemen</a></h4>
								<p>Catatan tersimpan secara terstruktur diserver kami</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- /Featured Services Section -->
			<!-- Clients Section -->
			<section id="clients" class="clients section">
				<div class="container" data-aos="fade-up">
					<div class="row justify-content-center gy-4">
						<!-- End Client Item -->
						<div class="col-xl-2 col-md-3 col-6 client-logo">
							<img src="<?=  base_url() ?>assets/img/clients/client-2.png" class="img-fluid" alt="">
						</div>
						<!-- End Client Item -->
						<div class="col-xl-2 col-md-3 col-6 client-logo">
							<img src="<?=  base_url() ?>assets/img/clients/client-3.png" class="img-fluid" alt="">
						</div>
						<!-- End Client Item -->
						<div class="col-xl-2 col-md-3 col-6 client-logo">
							<img src="<?=  base_url() ?>assets/img/clients/client-5.png" class="img-fluid" alt="">
						</div>
						<!-- End Client Item -->
					</div>
				</div>
			</section>
		</main>
		<footer id="footer" class="footer">
			<div class="copyright text-center">
				<div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
					<div class="d-flex flex-column align-items-center align-items-lg-start">
						<div>
							© Copyright <strong><span><?= SITE_NAME ?></span></strong>. All Rights Reserved
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Scroll Top -->
		<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
		<!-- Preloader -->
		<div id="preloader"></div>
		<!-- Vendor JS Files -->
		<script src="<?=  base_url() ?>assets/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?=  base_url() ?>assets/plugin/php-email-form/validate.js"></script>
		<script src="<?=  base_url() ?>assets/plugin/aos/aos.js"></script>
		<script src="<?=  base_url() ?>assets/plugin/glightbox/js/glightbox.min.js"></script>
		<script src="<?=  base_url() ?>assets/plugin/swiper/swiper-bundle.min.js"></script>
		<script src="<?=  base_url() ?>assets/plugin/imagesloaded/imagesloaded.pkgd.min.js"></script>
		<script src="<?=  base_url() ?>assets/plugin/isotope-layout/isotope.pkgd.min.js"></script>
		<!-- Main JS File -->
		<script src="<?=  base_url() ?>assets/js/main.js"></script>
	</body>
</html>