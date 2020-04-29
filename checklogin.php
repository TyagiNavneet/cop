<?php
include('functions.php');
$data['username'] =  $_POST['username'];
$data['pass'] = $_POST['userpassword'];
$data['ip'] = get_client_ip();
// Using function checkUser() for validation.
$userdata = checkUser($data);
if ($userdata) {
	//die('test');
	$row = $userdata[0];
	session_start();
	session_regenerate_id();
	if (isset($_SESSION['82j2ud2891166sid'])) {
		unset($_SESSION["82j2ud2891166sid"]);
		unset($_SESSION["82j2ud2891166spusername"]);
		unset($_SESSION["82j2ud2891166spassword"]);
		unset($_SESSION["82j2ud2891166sconame"]);
		unset($_SESSION["82j2ud2891166sdispname"]);
		unset($_SESSION["82j2ud2891166susertype"]);
		unset($_SESSION["82j2ud2891166scustid"]);
		unset($_SESSION["82j2ud2891166sgroupid"]);
		unset($_SESSION["82j2ud2891166sactive"]);
		unset($_SESSION["82j2ud2891166spemail"]);
		unset($_SESSION["82j2ud2891166spemailpassowrd"]);
		unset($_SESSION["82j2ud2891166sremoteuser"]);
		unset($_SESSION["82j2ud2891166stradeid"]);
		unset($_SESSION["82j2ud2891166sdtmod"]);
		unset($_SESSION["82j2ud2891166slmwho"]);
		unset($_SESSION["82j2ud2891166sdtcr"]);
		unset($_SESSION["82j2ud2891166sdtwho"]);
		unset($_SESSION["82j2ud2891166slogin_attempts"]);
		unset($_SESSION["82j2ud2891166slast_login"]);
		unset($_SESSION['crdate']);
	}
	if ($row['active'] == '1' && trim($row['usertype']) === 'MANAGER') {
		$sessionID = session_id();
		$myidpass = $row['id'];
		$isRemote = $row['remoteuser'];
		$_SESSION["82j2ud2891166sid"] = $row['id'];
		$_SESSION["82j2ud2891166spusername"] = $row['pusername'];
		$_SESSION["82j2ud2891166spassword"] = $row['ppassword'];
		$_SESSION["82j2ud2891166sconame"] = $row['conname'];
		$_SESSION["82j2ud2891166sdispname"] = $row['dispname'];
		$_SESSION["82j2ud2891166susertype"] = $row['usertype'];
		$_SESSION["82j2ud2891166scustid"] = $row['custid'];
		$_SESSION["82j2ud2891166sgroupid"] = $row['groupid'];
		$_SESSION["82j2ud2891166sactive"] = $row['active'];
		$_SESSION["82j2ud2891166spemail"] = $row['pemail'];
		$_SESSION["82j2ud2891166spemailpassowrd"] = $row['pemailpassword'];
		$_SESSION["82j2ud2891166sremoteuser"] = $row['remoteuser'];
		$_SESSION["82j2ud2891166stradeid"] = $row['tradeid'];
		$_SESSION["82j2ud2891166sdtmod"] = $row['dtmod'];
		$_SESSION["82j2ud2891166slmwho"] = $row['lmwho'];
		$_SESSION["82j2ud2891166sdtcr"] = $row['dtcr'];
		$_SESSION["82j2ud2891166sdtwho"] = $row['dtwho'];
		$_SESSION["82j2ud2891166slogin_attempts"] = $row['login_attempts'];
		$_SESSION["82j2ud2891166slast_login"] = $row['last_login'];
		$_SESSION['82j2ud2891166sUT'] = trim($row['usertype']);
		$_SESSION['cd'] = date('Y-m-01');
		$_SESSION['82j2ud2891166scurhp'] = "adminwelcome.php";
		if (!empty($myidpass)) {
			header("location:adminwelcome.php");
		} else {
			$error_message = 'Id not found';
			header("location:adminlogin.php?loginerror=Incorrect Username and/or Password, " . $error_message);
			exit;
		}
	}
} else {
	header("location:adminlogin.php?loginerror=Invalid request.");
	exit;
}

//$hm = authenticate($_POST['username'], $_POST['userpassword']); 
function authenticate($user, $pass)
{
	$user = str_replace(";", "", $user);
	include("db_connect.php");
	include("functions.php");
	$pass = strtoupper(md5(trim($pass)));
	$curIP = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

	if (!empty($user)) {
		$sqlcheckip = "SELECT * from swd_ip_lock WHERE ipaddress='$curIP'";
		$resultcheckip = mysqli_query($mysqllink, $sqlcheckip);
		$countcheckip = mysqli_num_rows($resultcheckip);
		if ($countcheckip > 20) {
			header("location:adminlogin.php?loginerror=Your IP is Blocked.");
			exit;
		}


		$sql = "SELECT * FROM swd_setup_users WHERE pusername='$user' and ppassword='$pass'";
		$result = mysqli_query($mysqllink, $sql);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);

		$sqlCheck = "SELECT * FROM swd_setup_users WHERE pusername='$user'";
		$resultCheck = mysqli_query($mysqllink, $sqlCheck);
		$rowcustCheck = mysqli_fetch_array($resultCheck);
		$countCheck = mysqli_num_rows($resultCheck);
		$cenvertedTime = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($rowcustCheck['last_login'])));

		if ($row['login_attempts'] == 3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)) {

			$error_message = 'Your account is temporarily locked, please try after ' . $cenvertedTime . '';
			$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
			mysqli_query($mysqllink, $sqlip);
			header("location:adminlogin.php?loginerror=Incorrect Username and/or Password, " . $error_message);
			exit;
		}

		if ($count > 0) {
			$sql = "UPDATE swd_setup_users set login_attempts='0', last_login=NULL WHERE pusername='$user'";
			mysqli_query($mysqllink, $sql);
			session_start();
			session_regenerate_id();
			if (isset($_SESSION['82j2ud2891166sid'])) {
				unset($_SESSION["82j2ud2891166sid"]);
				unset($_SESSION["82j2ud2891166spusername"]);
				unset($_SESSION["82j2ud2891166spassword"]);
				unset($_SESSION["82j2ud2891166sconame"]);
				unset($_SESSION["82j2ud2891166sdispname"]);
				unset($_SESSION["82j2ud2891166susertype"]);
				unset($_SESSION["82j2ud2891166scustid"]);
				unset($_SESSION["82j2ud2891166sgroupid"]);
				unset($_SESSION["82j2ud2891166sactive"]);
				unset($_SESSION["82j2ud2891166spemail"]);
				unset($_SESSION["82j2ud2891166spemailpassowrd"]);
				unset($_SESSION["82j2ud2891166sremoteuser"]);
				unset($_SESSION["82j2ud2891166stradeid"]);
				unset($_SESSION["82j2ud2891166sdtmod"]);
				unset($_SESSION["82j2ud2891166slmwho"]);
				unset($_SESSION["82j2ud2891166sdtcr"]);
				unset($_SESSION["82j2ud2891166sdtwho"]);
				unset($_SESSION["82j2ud2891166slogin_attempts"]);
				unset($_SESSION["82j2ud2891166slast_login"]);
			}

			if ($row['active'] == '1') {
				$sessionID = session_id();
				$myidpass = $row['id'];
				$isRemote = $row['remoteuser'];
				$_SESSION["82j2ud2891166sid"] = $row['id'];
				$_SESSION["82j2ud2891166spusername"] = $row['pusername'];
				$_SESSION["82j2ud2891166spassword"] = $row['ppassword'];
				$_SESSION["82j2ud2891166sconame"] = $row['conname'];
				$_SESSION["82j2ud2891166sdispname"] = $row['dispname'];
				$_SESSION["82j2ud2891166susertype"] = $row['usertype'];
				$_SESSION["82j2ud2891166scustid"] = $row['custid'];
				$_SESSION["82j2ud2891166sgroupid"] = $row['groupid'];
				$_SESSION["82j2ud2891166sactive"] = $row['active'];
				$_SESSION["82j2ud2891166spemail"] = $row['pemail'];
				$_SESSION["82j2ud2891166spemailpassowrd"] = $row['pemailpassword'];
				$_SESSION["82j2ud2891166sremoteuser"] = $row['remoteuser'];
				$_SESSION["82j2ud2891166stradeid"] = $row['tradeid'];
				$_SESSION["82j2ud2891166sdtmod"] = $row['dtmod'];
				$_SESSION["82j2ud2891166slmwho"] = $row['lmwho'];
				$_SESSION["82j2ud2891166sdtcr"] = $row['dtcr'];
				$_SESSION["82j2ud2891166sdtwho"] = $row['dtwho'];
				$_SESSION["82j2ud2891166slogin_attempts"] = $row['login_attempts'];
				$_SESSION["82j2ud2891166slast_login"] = $row['last_login'];
				if (trim($row['usertype']) === 'MANAGER') {
					$_SESSION['82j2ud2891166sUT'] = trim($row['usertype']);
					$_SESSION['82j2ud2891166scurhp'] = "adminwelcome.php";
					if (!empty($myidpass)) {
						header("location:adminwelcome.php");
					} else {
						$error_message = 'Id not found';
						header("location:adminlogin.php?loginerror=Incorrect Username and/or Password, " . $error_message);
						exit;
					}
				} else {
					$_SESSION['82j2ud2891166sUT'] = trim($row['usertype']);
					$_SESSION['82j2ud2891166scurhp'] = "index.php";
					if (!empty($myidpass)) {
						header("location:index.php");
					} else {
						$error_message = 'IP Address is invalid';
						$sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$curIP')";
						mysqli_query($mysqllink, $sqlip);
						header("location:adminlogin.php?loginerror=Unable to login " . $error_message);
						exit;
					}
				}
			} else {
				$error_message = 'User is not active';
				header("location:adminlogin.php?loginerror=Unable to login -" . $error_message);
				exit;
			}
		} else {
			$error_message = 'User or Password is not correct';
			header("location:adminlogin.php?loginerror=Unable to login -" . $error_message);
			exit;
		}
	} else {
		$error_message = 'Invalid value';
		header("location:adminlogin.php?loginerror=Unable to login -" . $error_message);
		exit;
	}

	include("db_close.php");
}	
/*
// @navneet- 17thApril - 09.00am Commented as this is declared in fucntions.ph file.

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
*/
