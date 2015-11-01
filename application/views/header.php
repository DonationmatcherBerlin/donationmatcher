<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
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
	<link href="<?= base_url('assets/css/bootstrap.min_v1.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet">

	<!-- Styles: Shared components -->
	<link href="<?= base_url('assets/css/components/main-header.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/landingpage/landingpage.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/components/progressbar.css') ?>" rel="stylesheet">

	<!-- Styles: Components -->
	<?php if (isset($current_view) && $current_view === 'register') : ?>
		<link href="<?= base_url('assets/css/components/register.css'); ?>" rel="stylesheet">
	<?php endif; ?>

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<header id="site-header" class="main-header">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
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
								<li><a href="<?= base_url('/user/logout') ?>">Logout</a></li>
							<?php else : ?>
								<li class="<?php echo isset($current_view) && $current_view === 'register' ? 'active' : ''; ?>"><a href="<?= base_url('/user/register') ?>">Register</a></li>
								<li class="<?php echo isset($current_view) && $current_view === 'login' ? 'active' : ''; ?>"><a href="<?= base_url('/user/login') ?>">Login</a></li>
							<?php endif; ?>
						</ul>
					</div><!-- .navbar-collapse -->
				</div><!-- .container-fluid -->
			</nav><!-- .navbar -->
		</div>
	</header><!-- #site-header -->

	<main id="site-content" role="main">

