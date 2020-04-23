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
	if($_GET['cid']) {
	include("functions.php");
	if ($_SESSION['82j2ud2891166sid']) {
		$username = $_SESSION['82j2ud2891166sdispname'];
		$DatabyId = getCustomerbyId($_GET['cid']);
		if($DatabyId) { $JobData = $DatabyId; }
		else {} 

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
            <li><a href="adminwelcome.php">Dashboard</a></li>
	    <li><a href="jobs.php?j=1">Jobs</a></li>
	    <li><a href="invoice.php">Invoices</a></li>
	</ul>
		</div>
		<div class="content">
			<nav class="navbar navbar-expand">
				<a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<span class="navbar-text page-title">View record : <?php echo $_GET['cid'];?></span>
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
				<div class="content-wrapper"> <?php echo "<pre>";
				print_r($JobData);?>
			</div></div>		
			
		</div> 	
		<?php 
		
	} else { } ?>
    <footer class="text-right">
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
                                                    $('.selectjob').change(function () {
                                                        var jm = $("#jmonth").val();
                                                        var jy = $("#jyear").val();
                                                        $.ajax({
                                                            type: "GET",
                                                            url: "result.php",
                                                            data: { jm: jm, jy: jy },
                                                            success: function (result) {
                                                                var parsedResponse = $.parseJSON(result);
                                                                $("#totaljobscount").html(parsedResponse.totalJobs);
                                                                $("#completedjobs").html(parsedResponse.completedJobs);
                                                                                                                             
                                                        }});
                                                    });
                                                    
                                                    $('.selectinvoice').change(function () {
                                                        var jm = $("#imonth").val();
                                                        var jy = $("#iyear").val();
                                                        $.ajax({
                                                            type: "GET",
                                                            url: "result.php",
                                                            data: { im: jm, iy: jy },
                                                            success: function (result) {
                                                                var parsedResponse = $.parseJSON(result);
                                                                $("#invoiceCount").html(parsedResponse.invoiceCount);
                                                                $("#invoiceamount").html(parsedResponse.invoiceAmount);
                                                                                                                             
                                                        }});
                                                    });
                                                

                                                $('#totaljobscount').on('DOMSubtreeModified', function () {
                                                    var sp = document.getElementById('totaljobscount').innerHTML;
                                                    if (sp === '0 record') {
                                                        $(".widgetLink").removeAttr("onclick");
                                                    }
                                                });
        </script>
</body>
</html>