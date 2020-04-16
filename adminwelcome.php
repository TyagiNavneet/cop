<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard</title>

	<!-- Styles -->
	<link rel="icon" type="image/png" href="assets/images/favicon.png" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link href="assets/css/font1.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/customstyle.css" rel="stylesheet">
	<!--<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">-->
	<link rel="stylesheet" type="text/css" href="assets/css/jquerydatatbl.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body style="overflow:hidden;" }>
	<?php
	session_start();
	if ($_SESSION['82j2ud2891166sid']) {
		$username = $_SESSION['82j2ud2891166sdispname'];
		include("functions.php");
		$jobs = getDashbordData();
	} else {
		session_destroy();
		header("location:adminlogin.php?loginerror=Invalid access.");
		exit;
	}
	?>
	<div class="common-layout is-default ">
		<div id="sidebar" class="sidenav sidenav-fixed expand-md">
			<div class="sidenav-header primary-bg nav-logo">
				<div class="font-weight-strong d-flex"><a href="javascript:;" class="logo"><img src="assets/images/logo-login.png"></a>
				</div>
			</div>
			<ul class="collapsible collapsible-accordion sidbar-navbar">
				<li class="active"><a href="adminwelcome.php">Dashboard</a></li>
				<li><a href="jobs.php">Jobs</a></li>
				<li><a href="invoice.php">Invoices</a></li>
			</ul>
		</div>
		<div class="content">
			<nav class="navbar navbar-expand">
				<a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<span class="navbar-text page-title">Dashboard</span>
				<div class="collapse navbar-collapse" id="navbarNav">
					<div class="ml-auto">
						<a class="welcome" href="javascript:;">
							Welcome! <?php echo $username; ?> <i class="fa fa-user" aria-hidden="true"></i>
						</a>
						<a class="navbar-icon waves-effect waves-light" href="logout.php">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</nav>
			<!--<div class="flud-container">
				<div class="interaction-listing">
					<div>
						<div class="container-fluid page-body-wrapper"> 
			<div class="main-panel">-->
			<div class="content-wrapper">
				<div class="row">
					<div class="col-md-4 stretch-card grid-margin">
						<div class="card bg-gradient-danger card-img-holder text-white">
							<div class="card-body" style="cursor: pointer;" onclick="window.location='#';">
								<img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
								<h4 class="font-weight-normal mb-3">Customer<i class="mdi mdi-chart-line mdi-24px float-right"></i>
								</h4>
								<h2 class="mb-5"><?php echo getCount('customers'); ?></h2>
								<h6 class="card-text"></h6>
							</div>
						</div>
					</div>
					<div class="col-md-4 stretch-card grid-margin">
						<div class="card bg-gradient-info card-img-holder text-white">
							<div class="card-body" style="cursor: pointer;" onclick="window.location='jobs.php';">
								<img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
								<h4 class="font-weight-normal mb-3">Total Jobs<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
								</h4>
								<h2 class="mb-5"><?php echo getCount('jobs');
													?></h2>
								<h6 class="card-text"><?php echo "Completed Jobs : " . getJobStatus(1); ?> </h6>
							</div>
						</div>
					</div>
					<div class="col-md-4 stretch-card grid-margin">
						<div class="card bg-gradient-success card-img-holder text-white">
							<div class="card-body" style="cursor: pointer;" onclick="window.location='invoice.php';">
								<img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
								<h4 class="font-weight-normal mb-3">Invoices <i class="mdi mdi-diamond mdi-24px float-right"></i>
								</h4>
								<h2 class="mb-5"><?php echo getCount('invoices'); ?></h2>
								<h6 class="card-text">Total amount $ <?php echo getInvoiceTotal(); ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<-- </div> </div> </div> </div> </div>--> </div> <footer class="text-right">
			<a href="#"><img src="assets/images/cpark_newlogo.png"></a>
			<p>Copyright © Cavendish Park 2020. All Rights reserved</p>
			</footer>

			<!--<script src="assets/js/vendor.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="assets/js/material-bootstrap.min.js"></script>-->
			<script src="assets/js/custom.js"></script>

</body>

</html>