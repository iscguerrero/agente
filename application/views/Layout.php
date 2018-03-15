<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Material Dashboard by Creative Tim</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
	<link href="../assets/css/demo.css" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="wrapper">
		<div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
			<div class="sidebar-wrapper">
				<ul class="nav">
						<li>
							<a href="dashboard.html">
								<i class="material-icons">dashboard</i>
								<p>Dashboard</p>
							</a>
						</li>
						<li>
							<a href="./user.html">
								<i class="material-icons">person</i>
								<p>User Profile</p>
							</a>
						</li>
						<li class="active-pro">
							<a href="upgrade.html">
								<i class="material-icons">unarchive</i>
								<p>Upgrade to PRO</p>
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
										<a class="navbar-brand" href="#"> Table List </a>
								</div>
								<div class="collapse navbar-collapse">
										<ul class="nav navbar-nav navbar-right">
												<li>
														<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
																<i class="material-icons">dashboard</i>
																<p class="hidden-lg hidden-md">Dashboard</p>
														</a>
												</li>
												<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="material-icons">notifications</i>
																<span class="notification">5</span>
																<p class="hidden-lg hidden-md">Notifications</p>
														</a>
														<ul class="dropdown-menu">
																<li>
																		<a href="#">Mike John responded to your email</a>
																</li>
																<li>
																		<a href="#">You have 5 new tasks</a>
																</li>
																<li>
																		<a href="#">You're now friend with Andrew</a>
																</li>
																<li>
																		<a href="#">Another Notification</a>
																</li>
																<li>
																		<a href="#">Another One</a>
																</li>
														</ul>
												</li>
												<li>
														<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
																<i class="material-icons">person</i>
																<p class="hidden-lg hidden-md">Profile</p>
														</a>
												</li>
										</ul>
										<form class="navbar-form navbar-right" role="search">
												<div class="form-group  is-empty">
														<input type="text" class="form-control" placeholder="Search">
														<span class="material-input"></span>
												</div>
												<button type="submit" class="btn btn-white btn-round btn-just-icon">
														<i class="material-icons">search</i>
														<div class="ripple-container"></div>
												</button>
										</form>
								</div>
						</div>
				</nav>
				<div class="content">
						<div class="container-fluid">
								<div class="row">
										<div class="col-md-12">
												<div class="card">
														<div class="card-header" data-background-color="purple">
																<h4 class="title">Simple Table</h4>
																<p class="category">Here is a subtitle for this table</p>
														</div>
														<div class="card-content table-responsive">
																<table class="table">
																		<thead class="text-primary">
																				<th>Name</th>
																				<th>Country</th>
																				<th>City</th>
																				<th>Salary</th>
																		</thead>
																		<tbody>
																				<tr>
																						<td>Dakota Rice</td>
																						<td>Niger</td>
																						<td>Oud-Turnhout</td>
																						<td class="text-primary">$36,738</td>
																				</tr>
																				<tr>
																						<td>Minerva Hooper</td>
																						<td>Curaçao</td>
																						<td>Sinaai-Waas</td>
																						<td class="text-primary">$23,789</td>
																				</tr>
																				<tr>
																						<td>Sage Rodriguez</td>
																						<td>Netherlands</td>
																						<td>Baileux</td>
																						<td class="text-primary">$56,142</td>
																				</tr>
																				<tr>
																						<td>Philip Chaney</td>
																						<td>Korea, South</td>
																						<td>Overland Park</td>
																						<td class="text-primary">$38,735</td>
																				</tr>
																				<tr>
																						<td>Doris Greene</td>
																						<td>Malawi</td>
																						<td>Feldkirchen in Kärnten</td>
																						<td class="text-primary">$63,542</td>
																				</tr>
																				<tr>
																						<td>Mason Porter</td>
																						<td>Chile</td>
																						<td>Gloucester</td>
																						<td class="text-primary">$78,615</td>
																				</tr>
																		</tbody>
																</table>
														</div>
												</div>
										</div>
										<div class="col-md-12">
												<div class="card card-plain">
														<div class="card-header" data-background-color="purple">
																<h4 class="title">Table on Plain Background</h4>
																<p class="category">Here is a subtitle for this table</p>
														</div>
														<div class="card-content table-responsive">
																<table class="table table-hover">
																		<thead>
																				<th>ID</th>
																				<th>Name</th>
																				<th>Salary</th>
																				<th>Country</th>
																				<th>City</th>
																		</thead>
																		<tbody>
																				<tr>
																						<td>1</td>
																						<td>Dakota Rice</td>
																						<td>$36,738</td>
																						<td>Niger</td>
																						<td>Oud-Turnhout</td>
																				</tr>
																				<tr>
																						<td>2</td>
																						<td>Minerva Hooper</td>
																						<td>$23,789</td>
																						<td>Curaçao</td>
																						<td>Sinaai-Waas</td>
																				</tr>
																				<tr>
																						<td>3</td>
																						<td>Sage Rodriguez</td>
																						<td>$56,142</td>
																						<td>Netherlands</td>
																						<td>Baileux</td>
																				</tr>
																				<tr>
																						<td>4</td>
																						<td>Philip Chaney</td>
																						<td>$38,735</td>
																						<td>Korea, South</td>
																						<td>Overland Park</td>
																				</tr>
																				<tr>
																						<td>5</td>
																						<td>Doris Greene</td>
																						<td>$63,542</td>
																						<td>Malawi</td>
																						<td>Feldkirchen in Kärnten</td>
																				</tr>
																				<tr>
																						<td>6</td>
																						<td>Mason Porter</td>
																						<td>$78,615</td>
																						<td>Chile</td>
																						<td>Gloucester</td>
																				</tr>
																		</tbody>
																</table>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
				<footer class="footer">
						<div class="container-fluid">
								<nav class="pull-left">
										<ul>
												<li>
														<a href="#">
																Home
														</a>
												</li>
												<li>
														<a href="#">
																Company
														</a>
												</li>
												<li>
														<a href="#">
																Portfolio
														</a>
												</li>
												<li>
														<a href="#">
																Blog
														</a>
												</li>
										</ul>
								</nav>
								<p class="copyright pull-right">
										&copy;
										<script>
												document.write(new Date().getFullYear())
										</script>
										<a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
								</p>
						</div>
				</footer>
				<div class="fixed-plugin">
						<div class="dropdown">
								<a href="#" data-toggle="dropdown">
										<i class="fa fa-cog fa-2x"> </i>
								</a>
								<ul class="dropdown-menu">
										<li class="header-title"> Sidebar Filters</li>
										<li class="adjustments-line">
												<a href="javascript:void(0)" class="switch-trigger">
														<div class="text-center">
																<span class="badge filter badge-purple active" data-color="purple"></span>
																<span class="badge filter badge-blue" data-color="blue"></span>
																<span class="badge filter badge-green" data-color="green"></span>
																<span class="badge filter badge-orange" data-color="orange"></span>
																<span class="badge filter badge-red" data-color="red"></span>
														</div>
														<div class="clearfix"></div>
												</a>
										</li>
										<li class="header-title">Images</li>
										<li class="active">
												<a class="img-holder switch-trigger" href="javascript:void(0)">
														<img src="../assets/img/sidebar-1.jpg">
												</a>
										</li>
										<li>
												<a class="img-holder switch-trigger" href="javascript:void(0)">
														<img src="../assets/img/sidebar-2.jpg">
												</a>
										</li>
										<li>
												<a class="img-holder switch-trigger" href="javascript:void(0)">
														<img src="../assets/img/sidebar-3.jpg">
												</a>
										</li>
										<li>
												<a class="img-holder switch-trigger" href="javascript:void(0)">
														<img src="../assets/img/sidebar-4.jpg">
												</a>
										</li>
										<li class="button-container">
												<div class="">
														<a href="https://www.creative-tim.com/product/material-dashboard" target="_blank" class="btn btn-primary btn-block">Free Download</a>
												</div>
										</li>
										<li class="header-title">Want more components?</li>
										<li class="button-container">
												<div class="">
														<a href="http://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">Get The PRO Version</a>
												</div>
										</li>
										<li class="button-container">
												<div class="">
														<a href="../documentation/tutorial-components.html" target="_blank" class="btn btn-default btn-block">View Documentation</a>
												</div>
										</li>
										<li class="header-title">Thank you for 520 shares!</li>
										<li class="button-container">
												<button id="twitter" class="btn btn-social btn-twitter btn-round"><i class="fa fa-twitter"></i> &middot; 120</button>
												<button id="facebook" class="btn btn-social btn-facebook btn-round"><i class="fa fa-facebook-square"> &middot;</i>400</button>
										</li>
								</ul>
						</div>
				</div>
		</div>
	</div>
</body>
<script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<script src="../assets/js/arrive.min.js"></script>
<script src="../assets/js/jquery.sharrre.js"></script>
<script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>

</html>