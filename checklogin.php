<?php 
$hm = authenticate($_POST['txtemail'], $_POST['txtpassword']); 
function authenticate($user, $pass)
{
	$user = str_replace(";","",$user);
	//Make SQL connection
	include("db_connect.php");
	include("functions.php");
	$pass=strtoupper(md5(trim($pass)));
	
	$curIP = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	if(!empty($user)){
		$sqlcheckip = "SELECT * from swd_ip_lock WHERE ipaddress='$curIP'";
		$resultcheckip=mysqli_query($mysqllink,$sqlcheckip);
		$countcheckip=mysqli_num_rows($resultcheckip);
		if($countcheckip > 20){
			header("location:adminlogin.php?loginerror=Your IP is Blocked.");exit;
		}
		$sql="SELECT * FROM swd_setup_users WHERE pusername='$user' and ppassword='$pass'";
		$result=mysqli_query($mysqllink,$sql);
		$count=mysqli_num_rows($result);
	
		$row = mysqli_fetch_array($result);
		
			$sqlCheck="SELECT * FROM swd_setup_users WHERE pusername='$user'";
			$resultCheck=mysqli_query($mysqllink,$sqlCheck);
			$rowcustCheck = mysqli_fetch_array($resultCheck);		
			$countCheck=mysqli_num_rows($resultCheck);
			$cenvertedTime = date('Y-m-d H:i:s',strtotime('+10 minutes',strtotime($rowcustCheck['last_login'])));

		if ($row['login_attempts']==3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)){
			$error_message = 'Your account is temporarily locked, please try after '.$cenvertedTime.'';
			$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
			mysqli_query($mysqllink,$sqlip);
			header("location:adminlogin.php?loginerror=Incorrect Username and/or Password, ".$error_message); 
			exit;
		}	
					//echo $cenvertedTime;exit;
		if ($count>0)
		{	
			$sql="UPDATE swd_setup_users set login_attempts='0', last_login=NULL WHERE pusername='$user'";
			mysqli_query($mysqllink,$sql);
			session_regenerate_id();
			session_start();
			if(isset($_SESSION['82j2ud2891166scuruserid']))
			{	
				// Clear Any left over session variables...
				unset($_SESSION['82j2ud2891166scustid']);
				unset($_SESSION['82j2ud2891166scurhp']);
				unset($_SESSION['82j2ud2891166scustname']);
				unset($_SESSION['82j2ud2891166scustaddress']);
				unset($_SESSION['82j2ud2891166scustemail']);
				unset($_SESSION['82j2ud2891166scusttel']);
				unset($_SESSION['82j2ud2891166scustlogo']);		
				unset($_SESSION['82j2ud2891166scustlogoinvert']);														
				
				unset($_SESSION['82j2ud2891166scurusertype']);
				unset($_SESSION['82j2ud2891166scuruserid']);
				unset($_SESSION['82j2ud2891166scurusergroup']);				
				unset($_SESSION['82j2ud2891166scurdispname']);
				unset($_SESSION['82j2ud2891166scurfullname']);
				unset($_SESSION['82j2ud2891166scuruseremail']);	
				unset($_SESSION['82j2ud2891166scurusertid']);
				
				unset($_SESSION['82j2ud2891166sUT']);						

			}			
			
			if($row['active']=='1') {			
				$sessionID = session_id();
				$_SESSION["82j2ud2891166scuruseremail"]=$row['cemail'];
				$myidpass=$row['id'];
				$isRemote=$row['remoteuser'];
				$_SESSION["82j2ud2891166scuruserid"]=$myidpass;
				$_SESSION["82j2ud2891166scurfullname"]=$row['conname'];	
				$_SESSION["82j2ud2891166scurdispname"]=$row['dispname'];					
				$_SESSION["82j2ud2891166scuruseremail"]=$row['pemail'];									
				$_SESSION["82j2ud2891166scurusertype"]=$row['usertype'];
				$_SESSION['82j2ud2891166scustid']=$row['custid'];
				$_SESSION['82j2ud2891166scurusertid']=$row['tradeid'];
				$_SESSION['82j2ud2891166scurusergroup']=$row['groupid'];				
					
					
				$sql="SELECT * FROM swd_setup_customers WHERE cid='" . $_SESSION['82j2ud2891166scustid'] . "'";
				$result=mysqli_query($mysqllink,$sql);			
				$rowcust = mysqli_fetch_array($result);					
				
				$_SESSION["82j2ud2891166scustaddress"]=$rowcust['customeraddress'];						
				$_SESSION["82j2ud2891166scustemail"]=$rowcust['customeremail'];	
				$_SESSION["82j2ud2891166scustname"]=$rowcust['cname'];						
				$_SESSION["82j2ud2891166scusttel"]=$rowcust['customertel'];						
				$_SESSION["82j2ud2891166scustlogo"]=trim($rowcust['customerlogo']);
				$_SESSION["82j2ud2891166scustlogoinvert"]=trim($rowcust['customerlogoinvert']);
				$lcCustomerActive=$rowcust['customeractive'];
				$lcuseIP=$rowcust['customeruseiplock'];
																					
				if($lcCustomerActive=='1') {		
					$lcContinue==0;	
					// Check for Allowed IP Addresses...
					if($lcuseIP=='1') {
						if($isRemote<>1){
							// Check IP Address
							$lcCurIP = getUserIpAddr();
							
							// Do more here...Look at adding IP Ranges and also a Roming profile option...
							
							$sql="SELECT * FROM swd_setup_ips WHERE cid='" . $_SESSION['82j2ud2891166scustid'] . "'  AND ipaddress='" . $lcCurIP . "'";
							$result=mysqli_query($mysqllink,$sql);								
							$rowip=mysqli_num_rows($result);
							//echo $rowip;
							if($rowip>=1){																
								$lcContinue=1;	
							}
							else
							{
								$lcContinue=0;
							}
						}//OK to Continue as profile is roaming...
						else
						{
							$lcContinue=1;
						}						
					}
					else{
						$lcContinue=1;	
					}
					if($lcContinue==1){						
						if(trim($row['usertype'])==='SUPER'){
							$_SESSION['82j2ud2891166sUT'] = trim($row['usertype']);					
							$_SESSION['82j2ud2891166scurhp']="adminwelcome.php";					
							if(!empty($myidpass)){ header("location:adminwelcome.php"); }									
						}else{
							$_SESSION['82j2ud2891166sUT'] = trim($row['usertype']);			
							$_SESSION['82j2ud2891166scurhp']="index.php";
							if(!empty($myidpass)){ header("location:index.php"); }
						}	
					}
					else{
						$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
						mysqli_query($mysqllink,$sqlip);
						header("location:adminlogin.php?loginerror=Unable to login - IP address is invalid: " . $lcCurIP); 		
					}
				}
				else{
					$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
					mysqli_query($mysqllink,$sqlip);
					header("location:adminlogin.php?loginerror=Customer no longer active."); 			  
				}					
		  }
		  else{
				$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
				mysqli_query($mysqllink,$sqlip);
				header("location:adminlogin.php?loginerror=User Account no longer active."); 			  
		  }
		}else{
			$sql="SELECT * FROM swd_setup_users WHERE pusername='$user'";
			$result=mysqli_query($mysqllink,$sql);
			$rowcust = mysqli_fetch_array($result);		
			$count=mysqli_num_rows($result);
			$login_attempts = $rowcust['login_attempts'] + 1;
			if($count > 0 && $rowcust['login_attempts'] < 3 ){
				$last_login = date('Y-m-d H:i:s');
				$sql="UPDATE swd_setup_users set login_attempts='$login_attempts', last_login='$last_login' WHERE pusername='$user'";
				mysqli_query($mysqllink,$sql);
				
			}
			$login_attempts = 3 - $login_attempts;
			if($rowcust['login_attempts'] > 1 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)){
				$error_message = 'Your account is temporarily locked, please try after '.$cenvertedTime.'';
			}else{
				if($rowcust['login_attempts'] > 2){
					$last_login = date('Y-m-d H:i:s');
					$sql="UPDATE swd_setup_users set login_attempts='1', last_login='$last_login' WHERE pusername='$user'";
					mysqli_query($mysqllink,$sql);
					$login_attempts = 2;
				}
				$error_message = $login_attempts." login attempts left.";
			}
			$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
			mysqli_query($mysqllink,$sqlip);
			header("location:adminlogin.php?loginerror=Incorrect Username and/or Password, ".$error_message); 
		}
	}else{
		$sql="SELECT * FROM swd_setup_users WHERE pusername='$user'";
		$result=mysqli_query($mysqllink,$sql);
		$rowcust = mysqli_fetch_array($result);		
		$count=mysqli_num_rows($result);
		$login_attempts = $rowcust['login_attempts'] + 1;
		if($count > 0  && $rowcust['login_attempts'] < 3){
			$last_login = date('Y-m-d H:i:s');
			$sql="UPDATE swd_setup_users set login_attempts='$login_attempts', last_login='$last_login' WHERE pusername='$user'";
			mysqli_query($mysqllink,$sql);
		}
		$login_attempts = 3 - $login_attempts;
		if($rowcust['login_attempts'] > 1 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)){
			$error_message = 'Your account is temporarily locked, please try after '.$cenvertedTime.'';
		}else{
			if($rowcust['login_attempts'] > 2){
				$last_login = date('Y-m-d H:i:s');
				$sql="UPDATE swd_setup_users set login_attempts='1', last_login='$last_login' WHERE pusername='$user'";
				mysqli_query($mysqllink,$sql);
				$login_attempts = 2;
			}
			$error_message = $login_attempts." login attempts left.";
		}
		$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
		mysqli_query($mysqllink,$sqlip);
		header("location:adminlogin.php?loginerror=Incorrect Username and/or Password, ".$error_message); 
	}
		
	//Close connection
	include("db_close.php");
		
}	

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>