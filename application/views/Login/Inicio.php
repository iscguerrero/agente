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
	<link href="<?php echo base_url('assets/css/paper-dashboard.css') ?>" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet">
</head>
<body>
	<div class="wrapper wrapper-full-page">
		<div class="full-page login-page" data-color="blue" data-image="<?php echo base_url('assets/img/bg.jpg') ?>">
		<!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
							<form id="formAcceder">
								<div class="card" data-background="color" data-color="blue">
									<div class="card-header">
										<h3 class="card-title">Acceso</h3>
									</div>
									<div class="card-content">
										<div class="form-group">
											<label>Usuario</label>
											<input type="text" class="form-control input-no-border" name="cve_usuario" id="cve_usuario">
										</div>
										<div class="form-group">
											<label>Contraseña</label>
											<input type="password" class="form-control input-no-border" name="contrasenia" id="contrasenia">
										</div>
									</div>
									<div class="card-footer text-center">
										<button type="submit" class="btn btn-fill btn-wd">Acceder</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer footer-transparent">
				<div class="container">
					<div class="copyright">
						&copy; <script>document.write(new Date().getFullYear())</script>
						DG Consultoria <i class="fa fa-heart"></i> ideas nacen proyectos crecen
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
<!-- Promise Library for SweetAlert2 working on IE -->
<script src="<?php echo base_url('assets/js/es6-promise-auto.min.js') ?>"></script>
<!--  Switch and Tags Input Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-switch-tags.js') ?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?php echo base_url('assets/js/sweetalert2.js') ?>"></script>
<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/paper-dashboard.js') ?>"></script>
<script src="<?php echo base_url('public/js/Login/Index.js') ?>"></script>
</html>