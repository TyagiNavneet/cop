<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Jobs</title>
      <!-- Styles -->
      <link rel="icon" type="image/png" href="assets/images/favicon.png" />
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
      <!-- <link href="assets/css/font1.css" rel="stylesheet"> -->
      <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
      <link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
      <link href="assets/css/customstyle.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!--<link rel="stylesheet" type="text/css" href="assets/css/jquerydatatbl.css">-->
   </head>
   <body>
      <?php
         error_reporting(0);
             session_start();
         
             include("functions.php");
         
             if ($_SESSION['82j2ud2891166sid']) {
         
                 $username = $_SESSION['82j2ud2891166sdispname'];
                if($_SESSION['resultbyidjobsdata'] && $_GET['j']=='2') {
                    $jobs = $_SESSION['resultbyidjobsdata'];
                }
                else {
                    unset($_SESSION['resultbyidjobsdata']);
                $jobs = getDashbordData(NULL,NULL); }
         
                 $status = array_unique(array_column($jobs, 'status'));
         
         		sort($status);
         
                 $sitename = array_unique(array_column($jobs, 'sitename'));
         
         		sort($sitename);
         
                 $jobdata = getJobsView();
         
                 logmsg('#29 - Viewing jobs page.');
         
             } else {
         
                 session_destroy();
         
                 logmsg('#31.jobs Invalid request');
         
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
               <li class="active"><a href="jobs.php">Jobs</a></li>
               <li><a href="invoice.php">Invoices</a></li>
            </ul>
         </div>
         <div class="content">
            <nav class="navbar navbar-expand">
               <a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>
               <span class="navbar-text page-title">Jobs</span>
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
            <div class="flud-container">
               <div class="interaction-listing">
                  <div class="row plots-filter">
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-3">
                              <label>Sitename</label>
                           </div>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <select id='column1_search' class='form-control'>
                                    <option value=''>All</option>
                                    <?php foreach($sitename as $key=>$value){ ?>
                                    <option value='<?php echo $value; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-3">
                              <label>Status</label>
                           </div>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <select id='column2_search' class='form-control'>
                                    <option value=''>All</option>
                                    <?php foreach($status as $key=>$value){ ?>
                                    <option value='<?php echo $value; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-3">
                              <label>Start</label>
                           </div>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text" class="form-control custumdate" id="startdate">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-3">
                              <label>End</label>
                           </div>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text" class="form-control custumdate" id="enddate">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 <div class="table-responsive">
                  <table class="table table-striped intro-tble" id="jobTable" data-page-length="25">
                  <!--<div class="table-responsive table table-hover table-striped">-->
                  <!--   <table id="jobTable">-->
                        <thead>
                           <tr>
                              <th style="white-space:nowrap;">  </th>
                              <th style="white-space:nowrap;">Job No.</th>
                              <th style="white-space:nowrap;">Date</th>
                              <th style="white-space:nowrap;">Site Name</th>
                              <th style="white-space:nowrap;">Ref/Task No.</th>
                              <th style="white-space:nowrap;">Site Address</th>
                              <th style="white-space:nowrap;">Defect</th>
                              <th style="white-space:nowrap;">Last Note</th>
                              <th style="white-space:nowrap;">Status</th>
                              <th style="white-space:nowrap;">Work Category</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php for ($i = 0; $i < sizeof($jobs); $i++) {
                              $cidno = $jobs[$i]['cidno'];
                              
                              $jobid = $jobs[$i]['jobid']; ?>
                           <tr>
                              <td nowrap>
                                 <a href="viewjobs.php?jid=<?php echo $jobid; ?>">
                                 <i class="fa fa-search" aria-hidden="true"></i>
                                 </a>
                              </td>
                              <td><?php echo $jobs[$i]['jobid']; ?></td>
                              <td nowrap><?php echo $jobs[$i]['dtcr']; ?></td>
                              <td nowrap>
                                 <a href="viewcustomer.php?cid=<?php echo $cidno; ?>">
                                 <?php echo $jobs[$i]['sitename']; ?></a>
                              </td>
                              <td nowrap><?php echo $jobs[$i]['cref']; ?></td>
                              <td nowrap>
                                 <?php echo $jobs[$i]['siadd']; ?>
                              </td>
                              <td nowrap><?php echo $jobs[$i]['defect']; ?></td>
                              <td nowrap><?php echo $jobs[$i]['lnote']; ?></td>
                              <td nowrap><?php echo $jobs[$i]['status']; ?></td>
                              <td nowrap><?php echo $jobs[$i]['workscat']; ?></td>
                           </tr>
                           <?php } ?>
                        </tbody>
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
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/material-bootstrap.min.js"></script>
      <script src="assets/js/app.js"></script>
      <script src="assets/js/custom.js"></script>
      <script src="assets/js/tagmanager.min.js"></script>  
      <script src="assets/js/bootstrap3-typeahead.min.js"></script>
      <script src="assets/js/jquery.dataTables.min.js"></script>  
      <script src="assets/js/dataTables.bootstrap4.min.js"></script>  
      <script src="assets/js/pushbar.min.js"></script>
      <!--<script src="assets/js/vendor.js"></script>-->
      <script src="assets/js/app.js"></script>
      <script src="assets/js/material-bootstrap.min.js"></script>
      <script src="assets/js/custom.js"></script>
      <script>
         // execute/clear BS loaders for docs
         $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
      </script>
      <script></script>
      <script>
         $(document).ready(function() {
         new Pushbar({ blur: true, overlay: true });
         var dataSrc = [];
         var table = $('#jobTable').dataTable({
          "bLengthChange": false,
                                     //"bFilter": true,
                                     //"bInfo": false,
                                     "bAutoWidth": false,
         'initComplete': function(){
         	var api = this.api();
         		// Populate a dataset for autocomplete functionality
         		// using data from first, second and third columns
         		api.cells('tr', [1]).every(function(){
         			// Get cell data as plain text
         			var data = $('<div>').html(this.data()).text();           
         			if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
         		});
         		// Sort dataset alphabetically
         		dataSrc.sort();
         	// Initialize Typeahead plug-in
         	$('input[type="search"]', api.table().container()).typeahead({
         		source: dataSrc,
         		afterSelect: function(value){
         			api.search(value).draw();
         		}
         	});
         }
         });
         $('#column1_search').on( 'change', function () {
         table.api().columns( 3 ).search( this.value ).draw();
         });
         $('#column2_search').on( 'change', function () {
         table.api().columns( 8 ).search( this.value ).draw();
         });
         
         });
         
      </script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script type="text/javascript">
         $(function(){
             $('.custumdate').datepicker({
                 inline: true,
                 //nextText: '&rarr;',
                 //prevText: '&larr;',
                 showOtherMonths: true,
                 dateFormat: 'yy-mm-dd',
                 dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                 //showOn: "button",
                 //buttonImage: "img/calendar-blue.png",
                 //buttonImageOnly: true,
             });
         });
      </script>
   </body>
</html>