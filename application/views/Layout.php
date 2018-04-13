<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon.png') ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/favicon.png') ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Reysi</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/paper-dashboard.css') ?>" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet">
	<style>
		.ui-autocomplete {
			z-index: 2147483647
		}
	</style>
	<?php echo $this->section('css') ?>
</head>
<body class="sidebar-mini">
	<?php echo $this->section('outcontainer') ?>
	<div class="wrapper">
		<div class="sidebar" data-background-color="white" data-active-color="danger">
			<!--Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown" Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger" -->
			<div class="logo">
				<a href="<?php echo base_url() ?>" class="simple-text logo-mini">
					R
				</a>
				<a href="<?php echo base_url() ?>" class="simple-text logo-normal">
					Reysi
				</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					<li class="<?php if($this->e($controller) ==  'Cobranza') echo 'active' ?>">
						<a href="<?php echo base_url('Cobranza/Inicio') ?>">
							<i class="ti-bookmark-alt"></i>
							<p>Cobranza</p>
						</a>
					</li>
					<li class="<?php if($this->e($controller) ==  'Clientes') echo 'active' ?>">
						<a href="<?php echo base_url('Clientes/Inicio') ?>">
							<i class="ti-id-badge"></i>
							<p>Clientes</p>
						</a>
					</li>
					<li class="<?php if($this->e($controller) ==  'Rutas') echo 'active' ?>">
						<a href="<?php echo base_url('Rutas/Inicio') ?>">
							<i class="ti-map-alt"></i>
							<p>Rutas</p>
						</a>
					</li>
					<li class="<?php if($this->e($controller) ==  'Articulos') echo 'active' ?>">
						<a href="<?php echo base_url('Articulos/Inicio') ?>">
							<i class="ti-clipboard"></i>
							<p>Artículos</p>
						</a>
					</li>
					<li class="<?php if($this->e($controller) ==  'Agenda') echo 'active' ?>">
						<a href="<?php echo base_url('Agenda/Inicio') ?>">
							<i class="ti-calendar"></i>
							<p>Agenda</p>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="main-panel">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon">
							<i class="ti-more-alt"></i>
						</button>
					</div>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar bar1"></span>
							<span class="icon-bar bar2"></span>
							<span class="icon-bar bar3"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#notifications" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
									<i class="ti-user"></i>
									<p class="hidden-md hidden-lg">
										Perfil
										<b class="caret"></b>
									</p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url('Login/Salir') ?>">Salir</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					<?php echo $this->section('incontainer') ?>
				</div>
			</div>

			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script> DG Consultora
						<i class="fa fa-heart"></i> ideas nacen, proyectos crecen
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/perfect-scrollbar.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.cookie.js') ?>" type="text/javascript"></script>
<!-- Promise Library for SweetAlert2 working on IE -->
<script src="<?php echo base_url('assets/js/es6-promise-auto.min.js') ?>"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?php echo base_url('assets/js/moment.min.js') ?>"></script>
<!--  Date Time Picker Plugin is included in this js file -->
<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/locale-es.js') ?>"></script>
<!--  Select Picker Plugin -->
<script src="<?php echo base_url('assets/js/bootstrap-selectpicker.js') ?>"></script>
<!--  Switch and Tags Input Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-switch-tags.js') ?>"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js') ?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?php echo base_url('assets/js/sweetalert2.js') ?>"></script>
<!--  Bootstrap Table Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
<!--  Full Calendar Plugin    -->
<script src="<?php echo base_url('assets/js/fullcalendar.min.js') ?>"></script>
<!-- Autocomplete -->
<script src="<?php echo base_url('assets/js/typeahead.jquery.min.js') ?>"></script>
<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/paper-dashboard.js') ?>"></script>
<?php echo $this->section('js') ?>
</html>