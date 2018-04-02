<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Reysi</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-table.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/material-dashboard.css?v=1.2.0') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons" />
	<style>
		.form-control{margin-bottom:0;width:100%;float:none}.select-with-transition{border:0!important;background-image:linear-gradient(#9c27b0,#9c27b0),linear-gradient(#d2d2d2,#d2d2d2);background-size:0 2px,100% 1px;background-repeat:no-repeat;background-position:bottom,50% calc(100% - 1px);background-color:transparent!important;transition:background 0s ease-out!important;float:none!important;box-shadow:none!important;border-radius:0!important;color:#3c4858!important;height:34px;padding-left:0!important;padding-bottom:5px!important}.select-with-transition .caret,.select-with-transition .ripple-container{display:none}.btn-group.bootstrap-select.show-tick.open .select-with-transition{outline:none!important;background-image:linear-gradient(#9c27b0,#9c27b0),linear-gradient(#d2d2d2,#d2d2d2)!important;background-size:100% 2px,100% 1px!important;box-shadow:none;transition-duration:.3s!important}
		.ui-autocomplete{
			z-index: 2147483647
		}
		.modal .modal-dialog {
			margin-top: 20px;
		}
	</style>
	<?php echo $this->section('css') ?>
</head>
<body>
	<?php echo $this->section('outcontainer') ?>
		<div class="wrapper">
			<div class="sidebar" data-color="purple" data-image="<?php echo base_url('assets/img/sidebar-1.jpg') ?>">
				<div class="logo">
					<a href="<?php echo base_url() ?>" class="simple-text">
						Reysi
					</a>
				</div>
				<div class="sidebar-wrapper">
					<ul class="nav">
						<li class="<?php if($this->e($controller) == 'Escritorio') echo 'active' ?>">
							<a href="<?php echo base_url('Escritorio/Inicio') ?>">
								<i class="material-icons">dashboard</i>
								<p>Escritorio</p>
							</a>
						</li>
						<li class="<?php if($this->e($controller) == 'Cobranza') echo 'active' ?>">
							<a href="<?php echo base_url('Cobranza/Inicio') ?>">
								<i class="material-icons">monetization_on</i>
								<p>Cobranza</p>
							</a>
						</li>
						<li class="<?php if($this->e($controller) == 'Clientes') echo 'active' ?>">
							<a href="<?php echo base_url('Clientes/Inicio') ?>">
								<i class="material-icons">people</i>
								<p>Clientes</p>
							</a>
						</li>
						<li class="<?php if($this->e($controller) == 'Rutas') echo 'active' ?>">
							<a href="<?php echo base_url('Rutas/Inicio') ?>">
								<i class="material-icons">location_on</i>
								<p>Rutas</p>
							</a>
						</li>
						<li class="<?php if($this->e($controller) == 'Articulos') echo 'active' ?>">
							<a href="<?php echo base_url('Articulos/Inicio') ?>">
								<i class="material-icons">format_list_bulleted</i>
								<p>Artículos</p>
							</a>
						</li>
						<li class="<?php if($this->e($controller) == 'Agenda') echo 'active' ?>">
							<a href="<?php echo base_url('Agenda/Inicio') ?>">
								<i class="material-icons">perm_contact_calendar</i>
								<p>Agenda</p>
							</a>
						</li>
						<li class="<?php if($this->e($controller) == 'Reportes') echo 'active' ?>">
							<a href="<?php echo base_url('Reportes/Inicio') ?>">
								<i class="material-icons">pie_chart</i>
								<p>Reportes</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<nav class="navbar navbar-transparent navbar-absolute">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#"> <?php echo $this->e($controller) ?> </a>
						</div>
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="material-icons">more_vert</i>
										<p class="hidden-lg hidden-md">Perfil</p>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="<?php echo base_url('Login/Salir') ?>">Salir</a>
										</li>
									</ul>
								</li>
							</ul>
							<form class="navbar-form navbar-right" role="search"></form>
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
						<p class="copyright pull-right">
							&copy;
							<script>
								document.write(new Date().getFullYear())
							</script>
							DG Consultora <i class="fa fa-heart"></i> ideas nacen, proyectos crecen
						</p>
					</div>
				</footer>
			</div>
		</div>
</body>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/material.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/moment.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/locale-es.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.cookie.js') ?>"></script>
<script src="<?php echo base_url('assets/js/es6-promise-auto.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-selectpicker.js') ?>"></script>
<script src="<?php echo base_url('assets/js/arrive.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/perfect-scrollbar.jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-notify.js') ?>"></script>
<script src="<?php echo base_url('assets/js/material-dashboard.js?v=1.2.0') ?>"></script>
<?php echo $this->section('js') ?>
</html>