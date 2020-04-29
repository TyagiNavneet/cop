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
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/customstyle.css" rel="stylesheet">
	<link href="assets/css/toolkit-light.css" rel="stylesheet">

</head>

<body>

	<div class="common-layout is-default ">
		<div id="sidebar" class="sidenav sidenav-fixed expand-md">
			<div class="sidenav-header primary-bg nav-logo">
				<div class="font-weight-strong d-flex">
					<a href="javascript:;" class="logo">
						<img src="assets/images/logo-login.png">
					</a>
				</div>
			</div>
			<ul class="collapsible collapsible-accordion sidbar-navbar">
				<li>
					<a href="dashboard.html">Dashboard</a>
				</li>
				<li class="active">
					<a href="#">Jobs</a>
				</li>
				<li>
					<a href="#">Invoices</a>
				</li>
			</ul>
		</div>
		<div class="content">
			<nav class="navbar navbar-expand">
				<a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</a>
				<span class="navbar-text page-title">Dashboard</span>
				<div class="collapse navbar-collapse" id="navbarNav">
					<div class="ml-auto">
						<a class="welcome" href="javascript:;">
							Welcome! Username
							<i class="fa fa-user" aria-hidden="true"></i>
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
						<div class="form-content">
							<div class="row">
								<div class="col-md-5">
									<div class="top-bar">
										<div class="rpw">
											<div class="col-12 mb-5">
												<button id="delbutton" class="btn mb-2" type="button" disabled="disabled">
													<span class="icon icon-erase"></span>
												</button>

												<button class="btn mb-2" type="button" disabled="disabled">
													<span class="icon icon-v-card"></span>
												</button>
												<button class="btn mb-2" type="button" disabled="disabled">
													View Customer
												</button>
												<button class="btn mb-2" type="button" disabled="disabled">
													View Development
												</button>
												<button class="btn mb-2" type="button" disabled="disabled">
													View Plot
												</button>
												<button class="btn mb-2 completebutton" type="button" disabled="disabled">Job completed</button>
											</div>

											<div class="col-12">
												<form>
													<div class="form-group">
														<label>Job Date</label>
														<input type="text" disabled="disabled" class="form-control" placeholder="02/09/2019">
													</div>

													<div class="form-group">
														<label>Job Description</label>
														<textarea placeholder="Description" disabled="disabled" class="form-control" rows="10"></textarea>
													</div>
													<div class="form-group">
														<button class="btn btn-lg btn-primary mt-3" type="submit" id="savebutton" name="savebutton" disabled="disabled">Save</button>

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
												<a data-toggle="tab" href="#menu1">Work Diary</a>
											</li>
											<li>
												<a data-toggle="tab" href="#menu2">Survey </a>
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
																	<th class="th-sm">
																		<span class="icon icon-magnifying-glass"></span>
																	</th>
																	<th class="th-sm">Plan Date
																	</th>
																	<th class="th-sm">Plan Name
																	</th>
																	<th class="th-sm">Special Ins
																	</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>
																		<span class="icon icon-magnifying-glass"></span>
																	</td>
																	<td>27/09/2019</td>
																	<td>Job need to be done quickly and verify the same before marking it done.</td>
																	<td></td>
																</tr>
																<tr>
																	<td>
																		<span class="icon icon-magnifying-glass"></span>
																	</td>
																	<td>27/09/2019</td>
																	<td>Job need to be done quickly and verify the same before marking it done.</td>
																	<td></td>
																</tr>
																<tr>
																	<td>
																		<span class="icon icon-magnifying-glass"></span>
																	</td>
																	<td>27/09/2019</td>
																	<td>Job need to be done quickly and verify the same before marking it done.</td>
																	<td></td>
																</tr>
																<tr>
																	<td>
																		<span class="icon icon-magnifying-glass"></span>
																	</td>
																	<td>27/09/2019</td>
																	<td>Job need to be done quickly and verify the same before marking it done.</td>
																	<td></td>
																</tr>
																<tr>
																	<td>
																		<span class="icon icon-magnifying-glass"></span>
																	</td>
																	<td>27/09/2019</td>
																	<td>Job need to be done quickly and verify the same before marking it done.</td>
																	<td></td>
																</tr>
																<tr>
																	<td>
																		<span class="icon icon-magnifying-glass"></span>
																	</td>
																	<td>27/09/2019</td>
																	<td>Job need to be done quickly and verify the same before marking it done.</td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>


												</div>
											</div>
											<div id="menu1" class="tab-pane fade">
												<h4 class="tab-title">Work Diary</h4>
												<div class="table-responsive">

													<table id="dtBasicExample" class="table" width="100%">
														<thead>
															<tr>
																<th class="th-sm">
																	<span class="icon icon-magnifying-glass"></span>
																</th>
																<th class="th-sm"> Date
																</th>
																<th class="th-sm">Comments
																</th>
																<th class="th-sm">Type
																</th>
																<th class="th-sm">SQM-Hours
																</th>
																<th class="th-sm"> Actions
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<span class="icon icon-magnifying-glass"></span>
																</td>
																<td>13/09/2019</td>
																<td>Job need to be done quickly and verify the same before marking it done.</td>
																<td>defect</td>
																<td></td>
																<td>
																	<a onclick="deleterow(event,'30','workdiary','work diary','work_diary','waid')">
																		<span class="icon icon-trash"></span>
																	</a>
																</td>
															</tr>
															<tr>
																<td>
																	<span class="icon icon-magnifying-glass"></span>
																</td>
																<td>13/09/2019</td>
																<td>Job need to be done quickly and verify the same before marking it done.</td>
																<td>defect</td>
																<td></td>
																<td>
																	<a onclick="deleterow(event,'30','workdiary','work diary','work_diary','waid')">
																		<span class="icon icon-trash"></span>
																	</a>
																</td>
															</tr>
															<tr>
																<td>
																	<span class="icon icon-magnifying-glass"></span>
																</td>
																<td>13/09/2019</td>
																<td>Job need to be done quickly and verify the same before marking it done.</td>
																<td>defect</td>
																<td></td>
																<td>
																	<a onclick="deleterow(event,'30','workdiary','work diary','work_diary','waid')">
																		<span class="icon icon-trash"></span>
																	</a>
																</td>
															</tr>
															<tr>
																<td>
																	<span class="icon icon-magnifying-glass"></span>
																</td>
																<td>13/09/2019</td>
																<td>Job need to be done quickly and verify the same before marking it done.</td>
																<td>defect</td>
																<td></td>
																<td>
																	<a onclick="deleterow(event,'30','workdiary','work diary','work_diary','waid')">
																		<span class="icon icon-trash"></span>
																	</a>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div id="menu2" class="tab-pane fade">
												<h4 class="tab-title">Survey</h4>
												<button class="btn btn-lg btn-primary mb-3 w-100" type="submit" id="savebutton" name="savebutton" disabled="disabled">Add Survey</button>
												<div class="table-responsive">
													<table class="table table-striped table-hover" id="example">
														<thead>
															<tr>
																<th></th>
																<th>Survey Date</th>
																<th>Comment</th>
																<th>Who signed off</th>
																<th></th>

															</tr>
														</thead>
														<tbody>
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

					<h5>
						<a style="cursor:pointer;" class="pr-1">
							<button class="btn" type="button" data-toggle="tooltip" title="Add File">
								<span class="icon icon-add-user"></span>
							</button>
						</a>
						Attached file(s)
					</h5>
					<div class="table-responsive">
							
							<table id="dtBasicExample" class="table table-striped " width="100%">
							  <thead>
								<tr>
								  <th class="th-sm"> 
									<span class="icon icon-magnifying-glass"></span>
								  </th>
								  <th class="th-sm"> Change File Name
								  </th>
								  <th class="th-sm">File Name
								  </th>
								  <th class="th-sm">DT Added	
								  </th>
								  <th class="th-sm">Added By	
								  </th>
								  <th class="th-sm"> Full Filename	  
								  </th>
								  <th class="th-sm"></th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <td><a href=""><span class="icon icon-download"></span></a></td>
								  <td><a href=""><span class="icon icon-unread"></span></a></td>
								  <td>survey(16-04-2020).</td>
								  <td>2020-04-16 12:08:09</td>
								  <td>Chris Bailey</td>
								  <td>survey(16-04-2020).pdf</td>
								  <td><a onclick="deleterowattachment(event,'1090','1','survey(16-04-2020).pdf','JOB')"> <span class="icon icon-trash"></span></a></td>
								</tr>
								<tr>
										<td><a href=""><span class="icon icon-download"></span></a></td>
										<td><a href=""><span class="icon icon-unread"></span></a></td>
										<td>survey(16-04-2020).</td>
										<td>2020-04-16 12:08:09</td>
										<td>Chris Bailey</td>
										<td>survey(16-04-2020).pdf</td>
										<td><a onclick="deleterowattachment(event,'1090','1','survey(16-04-2020).pdf','JOB')"> <span class="icon icon-trash"></span></a></td>
									  </tr>
							
									  <tr>
											<td><a href=""><span class="icon icon-download"></span></a></td>
											<td><a href=""><span class="icon icon-unread"></span></a></td>
											<td>survey(16-04-2020).</td>
											<td>2020-04-16 12:08:09</td>
											<td>Chris Bailey</td>
											<td>survey(16-04-2020).pdf</td>
											<td><a onclick="deleterowattachment(event,'1090','1','survey(16-04-2020).pdf','JOB')"> <span class="icon icon-trash"></span></a></td>
										  </tr>
							
										  <tr>
												<td><a href=""><span class="icon icon-download"></span></a></td>
												<td><a href=""><span class="icon icon-unread"></span></a></td>
												<td>survey(16-04-2020).</td>
												<td>2020-04-16 12:08:09</td>
												<td>Chris Bailey</td>
												<td>survey(16-04-2020).pdf</td>
												<td><a onclick="deleterowattachment(event,'1090','1','survey(16-04-2020).pdf','JOB')"> <span class="icon icon-trash"></span></a></td>
											  </tr>
							
											  <tr>
													<td><a href=""><span class="icon icon-download"></span></a></td>
													<td><a href=""><span class="icon icon-unread"></span></a></td>
													<td>survey(16-04-2020).</td>
													<td>2020-04-16 12:08:09</td>
													<td>Chris Bailey</td>
													<td>survey(16-04-2020).pdf</td>
													<td><a onclick="deleterowattachment(event,'1090','1','survey(16-04-2020).pdf','JOB')"> <span class="icon icon-trash"></span></a></td>
												  </tr>
							
							  </tbody>
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="text-right">
		<a href="#">
			<img src="assets/images/cpark_newlogo.png">
		</a>
		<p>Copyright © Cavendish Park 2020. All Rights reserved</p>
	</footer>


	<script src="assets/js/vendor.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="assets/js/material-bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>

</body>

</html>