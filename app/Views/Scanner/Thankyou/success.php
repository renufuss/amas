<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sukses</title>
	<link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/amas/favicon.ico">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
	</style>
	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
	<style>
		* {
			margin: 0;
			padding: 0;
		}
		p{
			color: white;
		}
	</style>
</head>
<body style="background-color: #0fa549;">
	<header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title" style="color: white;">Terima kasih!</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check-circle main-content__checkmark" id="checkmark" style="color: white;"></i>
		<p class="main-content__body" data-lead-id="main-content-body">Anda telah berhasil melakukan presensi</p>
	</div>
	<br>
	<div class="agenda">
		<p style="font-weight:600; letter-spacing: 1px;">Nama Agenda : <?= ucwords(strtolower($agenda->name)); ?></p>
		<p style="font-weight:600; letter-spacing: 1px;">Nama User : <?= ucwords(strtolower(user()->first_name)); ?> <?= ucwords(strtolower(user()->last_name)); ?></p>
		<p style="font-weight:600; letter-spacing: 1px;">NPM : <?= user()->npm; ?></p>
		<p style="font-weight:600; letter-spacing: 1px;">Status : Hadir</p>
		<p style="font-weight:600; letter-spacing: 1px;">Waktu Absen : <?= $mahasiswaAgenda->updated_at; ?></p>

		<br>
		<a href="<?= base_url('scanner'); ?>" style="color:blue">&laquo Kembali ke Halaman Scan</a>
	</div>
	<br>
	<footer class="site-footer" id="footer" >
		<p class="site-footer__fineprint" id="fineprint">Copyright © <?= date('Y'); ?>| All Rights Reserved</p>
	</footer>
</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>

