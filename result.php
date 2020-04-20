<?php

/* 
 * This is used for filter records month year based.
 * Using Ajax call
 * @Navneet - 20th April 2020
 */

include_once('functions.php');
if(isset($_GET['fdt']) && isset($_GET['ldt'])){
       $f=$_GET['fdt'];
       $t=$_GET['ldt'];
        session_start();
        $d = getDashbordData($f,$t);
        $_SESSION['resultbyidjobsdata'] = $d;
        if($d) { $tj = sizeof($d);        
        }
        else { $tj='0 record';}        
        $c = getJobStatus(1,$f,$t);
        if($c) { $cj = $c;}
        else { $cj = '0 record';}
         $response = array(
              'totalJobs' => $tj,
              'completedJobs' => $cj ); 
         echo json_encode($response);       
    }
?>
