<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard</title>
	<!-- Styles -->
	<link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
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
							Welcome! <?php echo $user = isset($_SESSION['82j2ud2891166sdispname']) ? $_SESSION['82j2ud2891166sdispname'] : 'User'; ?> <i class="fa fa-user" aria-hidden="true"></i>
						</a>
						<a class="navbar-icon waves-effect waves-light" href="logout.php">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</nav>
            <?php 
        error_reporting(0);
        session_start();
        include("functions.php");
        
        if( !$_SESSION['82j2ud2891166sid'] ) 
        { 
             header("location:adminlogin.php?loginerror=Invalid request.");
             die(); 
        }

        else {
            $month = date("m");
            $year = date("Y");
            $jobs = getJobsData(null,$month,$year);
            $invoices = getInvoiceData(null,$month,$year);
            $CompleteJob  =  getJobsData(null,$month,$year,1);
            $invoiceAmount  =  getInvoiceData(null,$month,$year,'amount');
            }

        
        ?>
			<div class="flud-container mt-5">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-md-6 stretch-card grid-margin">
															<div class="card bg-gradient-info card-img-holder text-white">
				<div class="card-body" ><img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                        <div style="position: absolute; margin-left:60%;">
                                            <label ><b>Month</b> </label><br>
                                            <?php $mnth = date("n"); ?>
                                            <select class="selectjob" id="jmonth" name="jmonth" style="height: 30px;width:80px; border: 1px solid black">
                                                <?php
                                                for ($i = 1; $i < 13; $i++) {
                                                    if ($i == $mnth) { ?>
                                                    <option selected="selected" value="<?php echo "$mnth"; ?>"><?php echo $mnth; ?></option>
                                                   <?php }
                                                   else {
                                                   echo "<option value='" . $i . "'>$i</option>"; }
                                                }
                                                ?>
                                            </select><br>
                                            <label ><b>Year</b> </label><br>
                                            <?php $year = date("Y"); ?>
                                            <select class="selectjob" id="jyear" name="jyear" style="height: 30px;width:80px; border: 1px solid black">
                                                <?php
                                                for ($i = $year; $i >= ($year - 25); $i--) {
                                                    echo "<option value='" . $i . "'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <h2 class="font-weight-bold mb-3 " >
                                            <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                        </h2>
                                        <button type="button" class="h2 btn-link font-weight-bold mb-5 widgetLink jobsWidgetBtn" onclick="sendJobStr();">
                                                <?php echo "Jobs : "; ?>
                                            <span id="totaljobscount"><?php echo sizeof($jobs); ?></span>
                                        </button>
                                        <h5 class="card-text">
                                            <?php echo "Completed Jobs : "; ?><span id="completedjobs"><?php echo sizeof($CompleteJob); ?></span> </h5>
</div>
							</div>
						</div>
						<div class="col-md-6 stretch-card grid-margin">
							<div class="card bg-gradient-success card-img-holder text-white">
								<div class="card-body">
									
                                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                        <div style="position: absolute; margin-left:60%;">
                                            <label ><b>Month</b> </label><br>
                                            <?php $mnth = date("n"); ?>
                                            <select class="selectinvoice" id="imonth" name="imonth" style="height: 30px;width:80px; border: 1px solid black">
                                                <?php
                                                for ($i = 1; $i < 13; $i++) {
                                                    if ($i == $mnth) { ?>
                                                    <option selected="selected" value="<?php echo "$mnth"; ?>"><?php echo $mnth; ?></option>
                                                   <?php }
                                                   else {
                                                   echo "<option value='" . $i . "'>$i</option>"; }
                                                }
                                                ?>
                                            </select><br>
                                            <label ><b>Year</b> </label><br>
                                            <?php $year = date("Y"); ?>
                                            <select class="selectinvoice" id="iyear" name="iyear" style="height: 30px;width:80px; border: 1px solid black">
                                                <?php
                                                for ($i = $year; $i >= ($year - 25); $i--) {
                                                    echo "<option value='" . $i . "'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <h2 class="font-weight-bold mb-3 " >
                                            <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                        </h2>
                                        

                                        <!--<h2 class="font-weight-bold mb-5 widgetLink invoiceWidgetBtn" style="cursor: pointer;" 
                                            onclick="sendInvoiceStr();">
                                                <?php echo "Invoices : "; ?>
                                            <span id="invoiceCount"><?php echo sizeof($invoices); ?></span>
                                        </h2> -->


                                        <button type="button" class="h2 btn-link font-weight-bold mb-5 widgetLink invoiceWidgetBtn" onclick="sendInvoiceStr();">
                                                <?php echo "Invoices : "; ?>
                                            <span id="invoiceCount"><?php echo sizeof($invoices); ?></span>
                                        </button>





                                        <h5 class="card-text">
                                            <?php echo "Invoice amount "; ?><span id="invoiceamount">
                                            <?php echo $amount = isset($invoiceAmount[0]['totalAmount']) ? "£".$invoiceAmount[0]['totalAmount'] : '0'; ?></span> </h5>
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
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
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
                                                
                        if(parsedResponse.totalJobs==0){
                            $('.jobsWidgetBtn').attr('disabled', 'disabled');
                        }
                        else {

                            $('.jobsWidgetBtn').removeAttr('disabled');
                        }

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
                        if(parsedResponse.invoiceCount==0){
                            $('.invoiceWidgetBtn').attr('disabled', 'disabled');
                        }
                        else {

                            $('.invoiceWidgetBtn').removeAttr('disabled');
                        }
                        $("#invoiceamount").html(parsedResponse.invoiceAmount);
                                                                                        
                }});
            });

// Function for pass dropdown month and year to another page //
        function sendJobStr(){
            var jbmonth = document.getElementById('jmonth').value;
            var jbyear  = document.getElementById('jyear').value;
            window.location = 'jobs.php?jmonth='+jbmonth+'&jyear='+jbyear;   
        }

        function sendInvoiceStr(){
            var imonth = document.getElementById('imonth').value;
            var iyear  = document.getElementById('iyear').value;
            window.location = 'invoice.php?imonth='+imonth+'&iyear='+iyear;   
        }
    </script>
</body>
</html>