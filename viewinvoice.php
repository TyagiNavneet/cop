<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title> Invoice <?php if(isset($_GET['id'])) {echo $_GET['id'];} ?></title>
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
	  <link href="assets/css/toolkit-light.css" rel="stylesheet">
   </head>
   <body>
      <div class="common-layout is-default ">
			<div id="sidebar" class="sidenav sidenav-fixed expand-md">
			<div class="sidenav-header primary-bg nav-logo">
				<div class="font-weight-strong d-flex"><a href="javascript:;" class="logo"><img src="assets/images/logo-login.png"></a>
				</div>
			</div>
			<ul class="collapsible collapsible-accordion sidbar-navbar">
				<li><a href="adminwelcome.php">Dashboard</a></li>
				<li><a href="jobs.php?j=1">Jobs </a></li>
				<li><a href="invoice.php">Invoices</a></li>
			</ul>
		</div>
		<div class="content">
         <nav class="navbar navbar-expand">
            <a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <span class="navbar-text page-title">Record <?php echo $id = isset($_GET['id']) ? $_GET['id'] : ''; ?></span>
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
     if( !$_SESSION['82j2ud2891166sid'] || !$_GET['id'] ) 
        { 
          header("location:adminlogin.php?loginerror=Invalid request.");
          die(); 
        }
    else {
            $data = getInvoiceData($_GET['id']);
            $c = $data[0];
          }

        ?>
         <div class="flud-container">
				<div class="interaction-listing">
					<div class="management-option management-pg row">
						<div class="form-content p-4">
							<div class="row">
								<div class="col-md-12">
									<div class="top-bar">
									    	<form>
										<div class="row">
										 
		 									<div class="col-md-6">
		 									    	<div class="form-group">
														<label>Invoice Id</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $c['invno'];?>">
													</div>
		 									</div>
		 									<div class="col-md-6">
		 									    	<div class="form-group">
														<label>Date</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $c['date'];?>">
													</div>
		 									</div>
		 									<div class="col-md-6">
		 									    	<div class="form-group">
														<label>Description</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $c['description'];?>">
													</div>
		 									    	
		 									</div>
		 									<div class="col-md-6">
		 									    		<div class="form-group">
														<label>Sub</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $c['sub'];?>">
													</div>
		 									</div>
		 										<div class="col-md-6">
		 									    		<div class="form-group">
														<label>Vat</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $c['vat'];?>">
													</div>
		 									</div>
		 										<div class="col-md-6">
		 									    		<div class="form-group">
														<label>Total</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $c['tot'];?>">
													</div>
		 									</div>
											
										</div>
	</form>



									</div>

								</div>
								
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
	  </div>
	</div>
      
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
   </body>
</html>
