<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard</title>
	<!-- Styles -->
	<link rel="icon" type="image/png" href="assets/images/favicon.png" />
	<link href="assets/css/font1.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/customstyle.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquerydatatbl.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>
	<?php
        error_reporting(0);
	session_start();
	include("functions.php");
	if ($_SESSION['82j2ud2891166sid']) {
		$username = $_SESSION['82j2ud2891166sdispname'];
		$jobs = getDashbordData(NULL,NULL);
                $c = sizeof($jobs);
	} else {
		session_destroy();
		logmsg('#33 welcome - Invalid request');
		header("location:adminlogin.php?loginerror=Invalid request.");
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
	    <li><a href="jobs.php?j=1">Jobs</a></li>
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
			<div class="flud-container mt-5">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-md-6 stretch-card grid-margin">
															<div class="card bg-gradient-info card-img-holder text-white">
																											<div class="card-body" >Select Date Range -
																															<input type="text" name="datefilter"  id="datefilter" />
									<img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
																																	<h2 class="font-weight-bold mb-3 " >
																																			<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
									</h2>
																																	<br>
																																	<h2 class="font-weight-bold mb-5 widgetLink" style="cursor: pointer;" 
																																			onclick="window.location='jobs.php?j=2';">
																																			<?php echo "Total Jobs : ";?>
																																			<span id="totaljobscount"><?php echo $c; ?></span>
																																	</h2>
									<h5 class="card-text">
																																			<?php echo "Completed Jobs : ";?><span id="completedjobs"><?php echo getJobStatus('1',NULL,NULL);?></span> </h5>
																																			
								</div>
							</div>
						</div>
						<div class="col-md-6 stretch-card grid-margin">
							<div class="card bg-gradient-success card-img-holder text-white">
								<div class="card-body" style="cursor: pointer;" onclick="window.location='invoice.php';">
									<img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
									<h2 class="font-weight-bold mb-3">Invoices <i class="mdi mdi-diamond mdi-24px float-right"></i>
									</h2>
									<h2 class="mb-5"><?php echo getCount('invoices'); ?></h2>
									<h5 class="card-text">Total amount £ <?php echo getInvoiceTotal(); ?></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div> 	<footer class="text-right">
		<a href="#"><img src="assets/images/cpark_newlogo.png"></a>
		<p>Copyright © Cavendish Park 2020. All Rights reserved</p>
	</footer>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/material-bootstrap.min.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="assets/js/tagmanager.min.js"></script>  
	<script src="assets/js/bootstrap3-typeahead.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>  
	<script src="assets/js/dataTables.bootstrap4.min.js"></script>  
	<script src="assets/js/pushbar.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script type="text/javascript">
$(function() {
  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      opens: 'right',
      autoApply: true,
      locale: {
          cancelLabel: 'Clear'
      }
  });
  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      var f = picker.startDate.format('YYYY-MM-DD');
      var e = picker.endDate.format('YYYY-MM-DD');
      $.ajax({      
      type: "GET",
      url: "result.php",
      data: {fdt: f, ldt: e},
      success: function(result) {
            var parsedResponse = $.parseJSON(result);
            $("#totaljobscount").html(parsedResponse.totalJobs);
            $("#completedjobs").html(parsedResponse.completedJobs);
            }});
  });
  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
});

$('#totaljobscount').on('DOMSubtreeModified',function(){
  var sp = document.getElementById('totaljobscount').innerHTML;
  if(sp === '0 record') { $(".widgetLink").removeAttr("onclick");}
});
</script>
</body>
</html>