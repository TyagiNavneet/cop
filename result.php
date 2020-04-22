<?php
/* 
 * This is used for filter records month year based.
 * Using Ajax call
 * @Navneet - 20th April 2020
 */
include_once('functions.php');
if( isset($_GET['jm']) && isset($_GET['jy']) ) {
       session_start();
       unset($_SESSION['resultbyidjobsdata']);
       $jobsdata = getDashbordData($_GET['jm'],$_GET['jy']);
       $completedJobs = getJobStatus(1,$_GET['jm'],$_GET['jy']);
       if($jobsdata) {
            $CountTotalJobs = sizeof($jobsdata);
            $_SESSION['resultbyidjobsdata'] = $jobsdata;
        } else { $CountTotalJobs = '0'; }
       if($completedJobs) { 
           $countCompledJobs = $completedJobs; 
       } else { $countCompledJobs = '0'; }
       
       $responseJobs = array(
              'totalJobs' => $CountTotalJobs,
              'completedJobs' => $countCompledJobs
             ); 
        echo json_encode($responseJobs);       
    }
        
if( isset($_GET['im']) && isset($_GET['iy']) )  {
       session_start();
       unset($_SESSION['resultbyidinvoicedata']);
       $invoiceData = getInvoiceData($_GET['im'],$_GET['iy']);
       $invoiceAmount = getInvoiceAmount($_GET['im'],$_GET['iy']);
       if($invoiceData) {
           $CountInvoice = sizeof($invoiceData); 
           $_SESSION['resultbyidinvoicedata'] = $invoiceData;
        } else { $CountInvoice = '0'; }
       if($invoiceAmount) { 
           $amountInvoice = "£".$invoiceAmount; 
         } else { $amountInvoice = '0'; }
       $responseInvoice = array(
              'invoiceCount' => $CountInvoice,
              'invoiceAmount' => $amountInvoice
        ); 
        echo json_encode($responseInvoice);       
    }
?>
