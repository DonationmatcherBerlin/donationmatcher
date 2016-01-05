<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" style="min-height: 100%; position: relative;">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bedarfsplaner.org</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<!-- Styles: General -->
	<?php /* <link href="<?= base_url('assets/css/local/local.css') ?>" rel="stylesheet"> */ ?>
	<link href="<?= base_url('assets/css/bootstrap.min_v2.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/jquery.businessHours.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/jquery.ioslist.css') ?>" rel="stylesheet">
	<link href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet">

	<!-- Styles: Shared components -->
	<link href="<?= base_url('assets/css/components/site-header.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/components/site-content.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/components/footer.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/components/progressbar.css') ?>" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<!-- Styles: Components -->
	<?php if (isset($current_view) && $current_view === 'register') : ?>
		<link href="<?= base_url('assets/css/components/register.css'); ?>" rel="stylesheet">
	<?php endif; ?>

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body style="min-height: 100%; margin: 0 0 50px;">


	<?php if(array_key_exists('su',$_SESSION)){ ?>
						
		<div class="alert alert-danger">
			<a href="<?php echo site_url('admin/exit_su'); ?>"> &lt;&lt; Zurück zum Admin</a>
		</div>
	
	<?php } ?>

	<header id="site-header" class="site-header">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">öffne Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?= base_url(); ?>">Bedarfsplaner.org</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
								<li class="<?php echo !isset($current_view) ? 'active' : ''; ?>"><a href="<?= base_url(); ?>">Bedarfsplan Berlin</a></li>
							<?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
                                <li><a href="<?= base_url('/local/match') ?>">Bedarfsplaner</a></li>
								<li><a href="<?= base_url('/stocklist') ?>">Interne Bedarfsliste</a></li>
                                <li><a href="<?= base_url('/user/profile') ?>">Profil</a></li>
								<li><a href="<?= base_url('/user/logout') ?>">Logout</a></li>
							<?php else : ?>
								<li class="<?php echo isset($current_view) && $current_view === 'register' ? 'active' : ''; ?>"><a href="<?= base_url('/user/register') ?>">Registrieren</a></li>
								<li class="<?php echo isset($current_view) && $current_view === 'login' ? 'active' : ''; ?>"><a href="<?= base_url('/user/login') ?>">Login</a></li>
							<?php endif; ?>
						</ul>
					</div><!-- .navbar-collapse -->
				</div><!-- .container-fluid -->
			</nav><!-- .navbar -->
		</div>
	</header><!-- #site-header -->

	<main id="site-content" class="site-content" role="main">
