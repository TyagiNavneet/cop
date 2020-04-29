<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Jobs</title>
      <!-- Styles -->
      <link rel="icon" type="image/png" href="assets/images/favicon.png" />
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
      <!-- <link href="assets/css/font1.css" rel="stylesheet"> -->
      <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
      <link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
      
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!--<link rel="stylesheet" type="text/css" href="assets/css/jquerydatatbl.css">-->
	  <link href="assets/css/customstyle.css" rel="stylesheet"> <!-- moving position for calender -->
	  <style>
      .table td, .table th {
    padding: .75rem !important;
    border-top: 1px solid #dee2e6 !important;
 }
</style>
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
   include("functions.php");
   if( !$_SESSION['82j2ud2891166sid'] ) 
        { 
             header("location:adminlogin.php?loginerror=Invalid request.");
             die(); 
        }
        if(isset($_GET['jmonth']) && isset($_GET['jyear'])) {
          $jobs = getJobsData(null,$_GET['jmonth'],$_GET['jyear']);
          $status = ddlJobStatus();
          $sitename = ddlJobSitename();
          echo "<input type='hidden' id='jb_mnth' value ='".$_GET['jmonth']."'>";
          echo "<input type='hidden' id='jb_year' value ='".$_GET['jyear']."'>";
        }
        elseif ( !isset($_GET['jmonth']) && !isset($_GET['jyear'])) {
           $jobs = getJobsData();
           $status = ddlJobStatus();
           $sitename = ddlJobSitename();
          }
            ?>
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
                                    <?php for($i=0;$i<sizeof($sitename);$i++){ ?>
                                    <option value="<?php echo $sitename[$i]['sitename']; ?>">
                                      <?php echo $sitename[$i]['sitename']; ?></option>
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
                                    <?php for($i=0;$i<sizeof($status);$i++){ ?>
                                    <option value="<?php echo $status[$i]['status']; ?>"><?php 
                                    echo $status[$i]['status']; ?></option>
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
                              <th style="white-space:nowrap;"> </th>
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
          
            <tbody id='newjobdata'>
<?php foreach ($jobs as $j) { ?>
  <tr>
                   <td nowrap><a href="viewjobs.php?jid=<?php echo $j['jobid']; ?>"> 
                    <i class="fa fa-search" aria-hidden="true"></i> </a> 
                   </td>
                   <td><?php echo $j['jobid']; ?></td>
                   <td nowrap><?php echo $j['dtcr']; ?></td>
                   <td nowrap> <a href="viewcustomer.php?cid=<?php echo $j['cidno'] ?>"> <?php echo $j['sitename']; ?></a> 
                   </td> 
                   <td nowrap><?php echo $j['cref']; ?></td> 
                   <td nowrap><?php echo $j['siadd']; ?></td>
                   <td nowrap><?php echo $j['defect']; ?></td>
                   <td nowrap><?php echo $j['lnote']; ?></td>
                   <td nowrap><?php echo $j['status']; ?></td>
                   <td nowrap><?php echo $j['workscat']; ?></td>
  </tr> <?php } ?>
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
      <!--<script src="assets/js/custom.js"></script>-->
      <script>
         // execute/clear BS loaders for docs
         $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
      </script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script>
   $.fn.muFun =  function() {
     new Pushbar({ blur: true, overlay: true });
         var dataSrc = [];
         var table = $('#jobTable').dataTable({
          "bLengthChange": false,
         //"bFilter": true,
        "bInfo": false,
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
            }  });     }  });
         
         $('#column1_search').on( 'change', function () {
         table.api().columns( 3 ).search( this.value ).draw();
         });
         $('#column2_search').on( 'change', function () {
         table.api().columns( 8 ).search( this.value ).draw();
         });

      }
         $(function(){
             $('.custumdate').datepicker({
                 inline: true,
                 showOtherMonths: true,
                 dateFormat: 'yy-mm-dd',
                 dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                 onSelect: function(dateStr) {
                  var startDate = $("#startdate").val();
                  var endDate = $("#enddate").val();
                  if ( (startDate.length > 0) && (endDate.length > 0)) {
                  $.ajax({
                      url: 'result.php',
                      type: 'GET',
                      data: { startdate: startDate, enddate: endDate},
                      success: function(response) {
                        //alert(response);
                        $("#jobTable").empty();
                        $("#jobTable").html(response);
                                           }
                  }); } } }); });
      </script>

      <script>$(document).ready(function() {
$.fn.muFun();
         
         });
  </script>
   </body>
</html>