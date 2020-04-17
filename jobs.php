<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
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
    <!--<link rel="stylesheet" type="text/css" href="assets/css/jquerydatatbl.css">-->
</head>

<body>
    <?php
    session_start();
    include("functions.php");
    if ($_SESSION['82j2ud2891166sid']) {
        $username = $_SESSION['82j2ud2891166sdispname'];
        $jobs = getDashbordData();
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
                        <a class="navbar-icon waves-effect waves-light" href="javascript:;">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="flud-container">
                <div class="interaction-listing">
                    <div class="row plots-filter">
                        <div class="col-md-6">
                            <div class='form-inline mb-3'>
                            <label class="mr-2">Sitename : </label>
                                <select id='column4_search' class='form-control'>
                                    <?php foreach($sitename as $key=>$value){ ?>
                                        <option value='<?php echo $value; ?>'><?php echo $value; ?></option>    
                                   <?php } ?>
                                </select></div>

                        </div>
                        <div class="col-md-6">                            
                            <div class='form-inline mb-3'>
                                <label class="mr-2">Status : </label>
                                <select id='column4_search' class='form-control'>
                                    <option value=''>All</option>
                                    <?php foreach($status as $key=>$value){ ?>
                                        <option value='<?php echo $value; ?>'><?php echo $value; ?></option>    
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="jobTable">
                            <thead>
                                <tr>
                                    <th style="white-space:nowrap;"> Sn. </th>
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
                                    <td nowrap>
                                        <a href="viewjobs.php?jid=<?php echo $jobid; ?>">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </a></td>
                                    <td><?php echo $jobs[$i]['jobid']; ?></td>
                                    <td nowrap><?php echo $jobs[$i]['dtcr']; ?></td>
                                    <td nowrap>
                                        <a href="viewcustomer.php?cid=<?php echo $cidno; ?>">
                                            <?php echo $jobs[$i]['sitename']; ?></a></td>
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
    <!--<script type="text/javascript" charset="utf8" src="assets/js/jquery182.min.js"></script>
    <script type="text/javascript" charset="utf8" src="assets/jquery-dataTableMin.js"></script> -->
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <!--<script type="text/javascript" src="/assets/js/jquery.dataTables.min.js"> </script> -->
    <script>
        $(function() {
            $("#jobTable").dataTable();
        })
    </script>

    <!--<script src="assets/js/vendor.js"></script>-->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/material-bootstrap.min.js"></script>

    <script src="assets/js/custom.js"></script>

</body>

</html>
