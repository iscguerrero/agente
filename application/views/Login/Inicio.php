<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/logo.png') ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Agente</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="<?php echo 'assets/css/bootstrap.min.css' ?>" />
	<link rel="stylesheet" href="<?php echo 'assets/css/material-dashboard.css?v=1.2.0' ?>" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' type='text/css'>
	<style>
		.login-page > .content {
			padding-top: 20vh;
		}
		.swal2-popup {
			font-size: 1em !important;
		}
	</style>
</head>
<body>
	<div class="wrapper wrapper-full-page">
		<div class="full-page login-page" data-image="<?php echo base_url('assets/img/cover.jpg') ?>">
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4">
							<div class="card">
								<div class="card-header" data-background-color="blue">
									<h4 class="title">Acceso</h4>
									<p class="category">Proporciona credenciales</p>
								</div>
								<div class="card-content">
									<form id="formAcceder">
										<div class="form-group label-floating">
											<label class="control-label">Usuario</label>
											<input type="text" class="form-control" name="cve_usuario" id="cve_usuario" autofocus>
										</div>
										<div class="form-group label-floating">
											<label class="control-label">Contraseña</label>
											<input type="password" class="form-control" name="contrasenia" id="contrasenia">
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-info text-center">Acceder</button>
										</div>
									</form>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<p class="copyright text-center">&copy;
						<script>
							document.write(new Date().getFullYear())
						</script>
						<a href="http://www.creative-tim.com">DG & Asociados</a>, <i class="fa fa-heart heart"></i> Made with Love
					</p>
				</div>
			</footer>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/perfect-scrollbar.jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/material.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/es6-promise-auto.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/arrive.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.js') ?>"></script>
<script src="<?php echo base_url('assets/js/material-dashboard.js?v=1.2.0') ?>"></script>
<script src="<?php echo base_url('public/js/Login/Index.js') ?>"></script>
</html>
