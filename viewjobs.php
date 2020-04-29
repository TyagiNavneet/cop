<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title> Job <?php if(isset($_GET['jid'])) {echo $_GET['jid'];} ?></title>
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
				<li class="active"><a href="adminwelcome.php">Dashboard</a></li>
				<li><a href="jobs.php?j=1">Jobs </a></li>
				<li><a href="invoice.php">Invoices</a></li>
			</ul>
		</div>
		<div class="content">
         <nav class="navbar navbar-expand">
            <a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <span class="navbar-text page-title">Jobs <?php echo $id = isset($_GET['jid']) ? $_GET['jid'] : ''; ?></span>
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
     if( !$_SESSION['82j2ud2891166sid'] || !$_GET['jid'] ) 
        { 
          header("location:adminlogin.php?loginerror=Invalid request.");
          die(); 
        }
    else {
            $jobs = getJobsData($_GET['jid']);
            $Tab1 = getDetailsForTab1($_GET['jid']);
            $Invoice = getInvoiceData();
            $Tab3 = getAttchedFile();
            $j = $jobs[0];
         }

        ?>
         <div class="flud-container">
				<div class="interaction-listing">
					<div class="management-option management-pg row">
						<div class="form-content">
							<div class="row">
								<div class="col-md-5">
									<div class="top-bar">
										<div class="row">
											<div class="col-12 mb-5">
											</div>

											<div class="col-12">
												<form>

													<div class="form-group">
														<label>Job Id</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $j['jobid'];?>">
													</div>
													<div class="form-group">
														<label>Customer Name</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $j['cname'];?>">
													</div>
													<div class="form-group">
														<label>Customer Id</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $j['cidno'];?>">
													</div>
													<div class="form-group">
														<label>Sitename</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $j['sitename'];?>">
													</div>
													<div class="form-group">
														<label>Site Id</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $j['siteid'];?>">
													</div>

													<div class="form-group">
														<label>Defect</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="<?php echo $j['defect'];?>">
													</div>

												</form>


											</div>

										</div>




									</div>

								</div>
								<div class="col-md-7">
									<div class="custom-tab">
										<ul class="nav nav-tabs">
											<li>
												<a data-toggle="tab" href="#home" class="active">Planner</a>
											</li>
											<li>
												<a data-toggle="tab" href="#menu1">Invoice</a>
											</li>
											<li>
												<a data-toggle="tab" href="#menu2">Attached File</a>
											</li>

										</ul>

										<div class="tab-content">
											<div id="home" class="tab-pane fade in active show">
												<div class="col=12">
													<h4 class="tab-title">Planner</h4>
													<div class="table-responsive">
														<table id="dtBasicExample" class="table" width="100%">
															<thead>
																<tr>
																	<th class="th-sm">Plan Id
																	</th>
																	<th class="th-sm">Plan Date
																	</th>
																	<th class="th-sm">Plan Name
																	</th>
																	<th class="th-sm">Tradesmen
																	</th>
																</tr>
															</thead>
															<tbody>

												<?php 
												foreach ($Tab1 as $t1v) { ?>
												<tr>
													<td><?php echo $t1v['planid'] ?></td>
													<td><?php echo $t1v['plandate'] ?></td>
													<td><?php echo $t1v['planname'] ?></td>
													<td><?php echo $t1v['tname'] ?></td>
												</tr><?php	 } ?>
															</tbody>
														</table>
													</div>


												</div>
											</div>
											<div id="menu1" class="tab-pane fade">
												<h4 class="tab-title">Invoice</h4>
												<div class="table-responsive">

													<table id="dtBasicExample" class="table" width="100%">
														<thead>
															<tr>
																<th><span class="icon icon-download"></span></th>
																<th class="thx-sm"> Invoice No
																</th>
																<th class="th-sm">Date
																</th>
																<th class="th-sm">Total Amount
																</th>
															</tr>
														</thead>
														<tbody>

<?php 
												foreach ($Invoice as $t2i) { ?>
												<tr>
													<td><a href="download/invoices/invoice_1.pdf" download>
														<span class="icon icon-download"></span></a></td>
													<td><?php echo $t2i['invno'] ?></td>
													<td><?php echo $t2i['date'] ?></td>
													<td><?php echo $t2i['tot'] ?></td>
												</tr><?php	 } ?>
														</tbody>
													</table>
												</div>
											</div>
											<div id="menu2" class="tab-pane fade">
												<h4 class="tab-title">Attached Files</h4>
												<div class="table-responsive">

													<table id="dtBasicExample" class="table" width="100%">
														<thead>
															<tr>
																<th><span class="icon icon-download"></span></th>
																<th class="thx-sm"> File Name
																</th>
																<th class="th-sm">Date
																</th>
																<th class="th-sm">Added By
																</th>
															</tr>
														</thead>
														<tbody>

<?php 
												foreach ($Tab3 as $t3i) { ?>
												<tr>
													<td><a href="download/files/file_1.pdf" download><span class="icon icon-download"></span></a></td>
													<td><?php echo $t3i['filename'] ?></td>
													<td><?php echo $t3i['dtadded'] ?></td>
													<td><?php echo $t3i['addedby'] ?></td>
												</tr><?php	 } ?>
														</tbody>
													</table>
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
