<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Styles -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet"><link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
    <link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/customstyle.css" rel="stylesheet">

</head>

<body>

<div class="common-layout is-default ">
	<div id="sidebar" class="sidenav sidenav-fixed expand-md">
		<div class="sidenav-header primary-bg nav-logo">
			<div class="font-weight-strong d-flex"><a href="javascript:;" class="logo"><img src="assets/images/logo-login.png"></a>
			</div>
		</div>
		<ul class="collapsible collapsible-accordion sidbar-navbar">
		  <li class="active"><a href="dashboard.html">Dashboard</a></li>
		  <li><a href="#">Jobs</a></li>
		  <li><a href="#">Invoices</a></li>
		</ul>
	</div>
    <div class="content">
        <nav class="navbar navbar-expand">
            <a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <span class="navbar-text page-title">Dashboard</span>
	        <div class="collapse navbar-collapse" id="navbarNav">
	            <div class="ml-auto">
	            	<a class="welcome" href="javascript:;">
		          	    Welcome! Username <i class="fa fa-user" aria-hidden="true"></i> 
		            </a>
		            <a class="navbar-icon waves-effect waves-light" href="javascript:;">
		          	    <i class="fa fa-sign-out" aria-hidden="true"></i>
		            </a>
	            </div>
	    	</div>
		</nav>
		<div class="flud-container">
			<div class="interaction-listing">
				<div class="management-option management-pg row">
					<div class="col-lg-6 text-center text-lg-left">
						<button type="button" class="btn btn-primary group-btn mr-3 mb-4 "><span><i class="custom-icon add-icon" aria-hidden="true"></i></span>ADD HOURS</button>
						<button type="button" class="btn btn-primary schedule-btn mb-4 "><span><i class="fa fa-book" aria-hidden="true"></i></i></span>WORKS DIARY</button>
					</div>

					<div class="col-lg-6 text-center text-lg-right">
						<button type="button" class="btn btn-primary quick-btn mb-4 "><span><i class="fa fa-eye" aria-hidden="true"></i></span>VIEW RAMs</button>
						<button type="button" class="btn btn-primary upload-btn mb-4 ml-3"><span><i class="custom-icon add-icon" aria-hidden="true"></i></span>COMPLETE DATA</button>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped intro-tble ">
						<thead>
						    <tr>
						        <th scope="col">Job</th>
						        <th scope="col">Date</th>
						        <th scope="col">Hours</th>
						        <th scope="col">Completed</th>
						    </tr>
						 </thead>
						 <tbody>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
						    <tr>
						        <td>Demo</td>
						        <td>2019-06-13</td>
						        <td>07:15</td>
						        <td>Completed</td>
						    </tr>
					</table>
				</div>
			</div>	
		</div>
  	</div>
</div>
<footer class="text-right">
	<a href="#"><img src="assets/images/cpark_newlogo.png"></a>
	<p>Copyright © Cavendish Park 2020. All Rights reserved</p>
</footer>


 <script src="assets/js/vendor.js"></script>
 <script src="assets/js/app.js"></script>
 <script src="assets/js/material-bootstrap.min.js"></script>
 <script src="assets/js/custom.js"></script>

</body>
</html>
