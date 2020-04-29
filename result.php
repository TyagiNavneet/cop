<?php

/* 
 * This is used for filter records month year based.
 * Using Ajax call
 * @Navneet - 20th April 2020
 */
include_once('functions.php');

// Code for Jobs Details
if( isset($_GET['jm']) && isset($_GET['jy']) ) {
            session_start();
            $month = $_GET['jm'];
            $year = $_GET['jy'];
            $jobs = getJobsData(null,$month,$year);
            $CompleteJob  =  getJobsData(null,$month,$year,1);
            $countJobs = isset($jobs) ? sizeof($jobs) : '0';
            $completedJobs = isset($CompleteJob) ? sizeof($CompleteJob) : '0';            
            $response = array(
              'totalJobs' => $countJobs,
              'completedJobs' => $completedJobs ); 
           echo json_encode($response);       
    }

// Code for Invoice Details        
if( isset($_GET['im']) && isset($_GET['iy']) )  {
            session_start();
            $month = $_GET['im'];
            $year = $_GET['iy'];
            $invoices = getInvoiceData(null,$month,$year);
            $invoiceAmount  =  getInvoiceData(null,$month,$year,1);
            $countInvoice = isset($invoices) ? sizeof($invoices) : '0';
            $amount = isset($invoiceAmount) ? "£".$invoiceAmount[0]['totalAmount'] : '0';
            $response = array(
              'invoiceCount' => $countInvoice,
              'invoiceAmount' => $amount );
            echo json_encode($response);       
    }
// Code for date filter jobs data

if( isset($_GET['startdate']) && isset($_GET['enddate']) )  {
            session_start();
            $data = getJobsDataByDate($_GET['startdate'],$_GET['enddate']);
            $dataTbl =  '<thead>
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
                        </thead><tbody>';
                        if($data) {
            foreach ($data as $j) { 
            $dataTbl .='<tr><td nowrap><a href="viewjobs.php?jid='.$j['jobid'].'"> 
                    <i class="fa fa-search" aria-hidden="true"></i> </a> 
                   </td><td nowrap>'.$j['jobid'].'</td>
                   <td nowrap>'.$j['dtcr'].'</td>
                   <td nowrap> 
                   <a href="viewcustomer.php?cid='.$j['cidno'].'">'.$j['sitename'].'</a> 
                   </td> 
                   <td nowrap>'.$j['cref'].'</td> 
                   <td nowrap>'.$j['siadd'].'</td>
                   <td nowrap>'.$j['defect'].'</td>
                   <td nowrap>'.$j['lnote'].'</td>
                   <td nowrap>'.$j['status'].'</td>
                   <td nowrap>'.$j['workscat'].'</td></tr>';
                   } }
                   else { $dataTbl .='<tr><td colspan="10">No matching records found</td>/tr>';}
                   $dataTbl .='</tbody>';
            echo $dataTbl;
    }

// Code for date filter invoice data

if( isset($_POST['startdate']) && isset($_POST['enddate']) )  {
            session_start();
            $data = getInvoiceDataByDate($_POST['startdate'],$_POST['enddate']);
            $dataTbl =  '<thead>
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
                            <tbody>';
        if($data) {
                foreach ($data as $j) {
                $InvS = ($j['fin'] > 0 ) ? 'Yes' : 'No';
                $dataTbl .='<tr>
                            <td nowrap>
                                <a href="viewinvoice.php?id='.$j['invno'].'">
                                   <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                            </td>
                            <td nowrap>'.$j['invno'].'</td>
                            <td nowrap>'.$j['date'].'</td>
                            <td nowrap>'.$j['description'].'</td>
                            <td nowrap>'.$j['sub'].'</td>
                            <td nowrap>'.$j['vat'].'</td>
                            <td nowrap>'.$j['tot'].'</td>
            <td nowrap><a href="viewjobs.php?jid='.$j['joblink'].'">'.$j['joblink'].'</a></td>
                            <td nowrap>'.$InvS.'</td>
                            <td nowrap>'.$j['cname'].'</td></tr>';
                   } }
                   else { $dataTbl .='<tr><td colspan="10">No matching records found</td>/tr>';}
                   $dataTbl .='</tbody>';
            echo $dataTbl;
    }


?>
