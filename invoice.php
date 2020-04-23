<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoices</title>
    <!-- Styles -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <!-- <link href="assets/css/font1.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
    <link href="assets/css/material-bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/customstyle.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <!--<link rel="stylesheet" type="text/css" href="assets/css/jquerydatatbl.css">-->
</head>
<body>
    <?php
    error_reporting(0);
    session_start();
    include("functions.php");
    if ($_SESSION['82j2ud2891166sid']) {
        $username = $_SESSION['82j2ud2891166sdispname'];
       if($_SESSION['resultbyidinvoicedata'] && $_GET['4a4f5sda4f5as7f8er5fds']=='f45454fsda4f') {
           $invoiceData = $_SESSION['resultbyidinvoicedata'];
           unset($_SESSION['resultbyidinvoicedata']);
          }
       else {
           unset($_SESSION['resultbyidinvoicedata']);
            $invoiceData = getInvoiceData(NULL,NULL);       
          
       }
        $customerName = array_unique(array_column($invoiceData, 'cname'));
        sort($customerName);
       logmsg('#34 - Viewing invoice page.');
    } else {
        session_destroy();
         logmsg('#37.invocie Invalid request');
        header("location:adminlogin.php?loginerror=Invalid request.");

        exit;

    }

    ?>

    <div class="common-layout is-default ">

        <div id="sidebar" class="sidenav sidenav-fixed expand-md">

            <div class="sidenav-header primary-bg nav-logo">

                <div class="font-weight-strong d-flex"><a href="javascript:;" class="logo">
                        <img src="assets/images/logo-login.png"></a>

                </div>

            </div>

            <ul class="collapsible collapsible-accordion sidbar-navbar">

                <li><a href="adminwelcome.php">Dashboard</a></li>

                <li ><a href="jobs.php">Jobs</a></li>

                <li class="active"><a href="invoice.php">Invoices</a></li>

            </ul>

        </div>

        <div class="content">

            <nav class="navbar navbar-expand">

                <a class="navbar-icon waves-effect waves-light mr-3 d-md-none" data-toggle="sidebar" data-target="#sidebar" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>

                <span class="navbar-text page-title">Invoice</span>

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
                                         <label>Customer </label>
                                    </div>
                                    <div class="col-md-9">
                                            <div class="form-group">
                                               
                                                 <select id='column1_search' class='form-control'>
                                    <option value=''>All</option>
                                    <?php foreach($customerName as $key=>$value){ ?>
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
                                         <label>Finished </label>
                                    </div>
                                    <div class="col-md-9">
                                            <div class="form-group">
                                               <select id='column2_search' class='form-control'>
                                    <option value=''>All</option>
                                    <option value='Yes'>Yes</option>
                                    <option value='No'>No</option>
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
<table class="table table-striped intro-tble" id="invoiceTable" data-page-length="25">
                            <thead>
                                <tr>
                                    <th style="white-space:nowrap;">  </th>
                                    <th style="white-space:nowrap;">Invoice No.</th>
                                    <th style="white-space:nowrap;">Date</th>
                                    <th style="white-space:nowrap;">Description</th>
                                    <th style="white-space:nowrap;">Sub</th>
                                    <th style="white-space:nowrap;">Vat</th>
                                    <th style="white-space:nowrap;">Total</th>
                                    <th style="white-space:nowrap;">JobId</th>
                                    <th style="white-space:nowrap;">Finished</th>
                                    <th style="white-space:nowrap;">Customer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < sizeof($invoiceData); $i++) {
                                    $invoiceId = $invoiceData[$i]['invno'];
                                    $jobid = $invoiceData[$i]['joblink']; ?>
                                <tr>
                                     <td nowrap>
                                        <a href="viewinvoice.php?invoiceid=<?php echo $invoiceId; ?>">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </a></td>
                                    <td nowrap> <?php echo $invoiceId;?></td>
                                    <td nowrap> <?php echo $invoiceData[$i]['date']; ?></td>
                                    <td nowrap> <?php echo $invoiceData[$i]['description']; ?></td>
                                    <td nowrap> <?php echo $invoiceData[$i]['sub']; ?></td>
                                    <td nowrap> <?php echo $invoiceData[$i]['vat']; ?></td>
                                    <td nowrap> <?php echo $invoiceData[$i]['tot']; ?></td>
                                    <td nowrap> <a href="viewjobs.php?jid=<?php echo $jobid; ?>">
                                            <?php echo $jobid; ?>
                                        </a></td>
                                    <td nowrap> <?php 
                                    $InvoiceStatus = ($invoiceData[$i]['fin'] > 0 ) ? 'Yes' : 'No'; 
                                    echo $InvoiceStatus; ?></td>
                                    <td nowrap> <?php echo $invoiceData[$i]['cname']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  <footer class="text-right">
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
    $(document).ready(function() {
			new Pushbar({ blur: true, overlay: true });
			var dataSrc = [];
			var table = $('#invoiceTable').dataTable({
				 "bLengthChange": false,
                                "bAutoWidth": false,
				'initComplete': function(){
					var api = this.api();
						api.cells('tr', [1]).every(function(){
							var data = $('<div>').html(this.data()).text();           
							if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
						});
						dataSrc.sort();
					$('input[type="search"]', api.table().container()).typeahead({
						source: dataSrc,
						afterSelect: function(value){
							api.search(value).draw();
						}
					});
				}
			});
			$('#column1_search').on( 'change', function () {
				table.api().columns( 9 ).search( this.value ).draw();
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
                autoclose: true,
                //showOn: "button",
                //buttonImage: "img/calendar-blue.png",
                //buttonImageOnly: true,
            });
        });


    </script>


</body>



</html>
