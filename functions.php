<?PHP
function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Function to work out 
function calculateMinutes(DateInterval $intpass)
{
    $dayscalc = $intpass->format('%a');
    return ($dayscalc * 24 * 60) + ($intpass->h * 60) + $intpass->i;
}

function base64_url_encode($input)
{
    return strtr(base64_encode($input), '+/=', '-_,');
}

function base64_url_decode($input)
{
    return base64_decode(strtr($input, '-_,', '+/='));
}

function mencrypt($message)
{
    $OPEN_SSL_METHOD = 'aes-256-cbc';
    $BASE64_ENCRYPTION_KEY = 'G1fM0aXhguJ5tVaqVMSWDHB+Jk6QFd99FgkfAcEgwjI';
    $BASE64_IV = 'xIkaSwduZFjtP4SI4mIyOg';
    $encrypted = openssl_encrypt($message, $OPEN_SSL_METHOD, base64_decode($BASE64_ENCRYPTION_KEY), 0, base64_decode($BASE64_IV));
    $base64_encrypted = base64_url_encode($encrypted);
    return $base64_encrypted;
}

function mdecrypt($base64_encrypted)
{
    $OPEN_SSL_METHOD = 'aes-256-cbc';
    $BASE64_ENCRYPTION_KEY = 'G1fM0aXhguJ5tVaqVMSWDHB+Jk6QFd99FgkfAcEgwjI';
    $BASE64_IV = 'xIkaSwduZFjtP4SI4mIyOg';
    $encrypted = base64_url_decode($base64_encrypted);
    $decrypted = openssl_decrypt($encrypted, $OPEN_SSL_METHOD, base64_decode($BASE64_ENCRYPTION_KEY), 0, base64_decode($BASE64_IV));
    return $decrypted;
}


function datacleanse($strpass)
{
    $strpass = str_replace("'", "''", $strpass);
    return $strpass;
}
function dataclear($strpass)
{
    $strpass = str_replace("'", "", $strpass);
    return $strpass;
}

function redirect($url)
{
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

function validateDateTime($dateTime)
{
    $format = 'Y-m-d H:i:s';
    if (is_string($dateTime)) {
        $dt = DateTime::createFromFormat($format, $dateTime);
        return $dt && $dt->format($format) === $dateTime;
    } elseif (is_object($dateTime)) {
        $dt = DateTime::createFromFormat($format, $dateTime->format($format));
        return $dt->format($format) === $dateTime->format($format);
    }
    return false;
}

function validateDate($date)
{
    $format = 'Y-m-d';
    if (is_string($date)) {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    } elseif (is_object($date)) {
        $d = DateTime::createFromFormat($format, $date->format($format));
        return $d->format($format) === $date->format($format);
    }
    return false;
}

function mkdirPath($target)
{
    $wrapper = null;

    // strip the protocol
    if (isStream($target)) {
        list($wrapper, $target) = explode('://', $target, 2);
    }

    // from php.net/mkdir user contributed notes
    $target = str_replace('//', '/', $target);

    // put the wrapper back on the target
    if ($wrapper !== null) {
        $target = $wrapper . '://' . $target;
    }

    // safe mode fails with a trailing slash under certain PHP versions.
    $target = rtrim($target, '/'); // Use rtrim() instead of untrailingslashit to avoid formatting.php dependency.
    if (empty($target))
        $target = '/';

    if (file_exists($target))
        return @is_dir($target);

    // We need to find the permissions of the parent folder that exists and inherit that.
    $target_parent = dirname($target);
    while ('.' != $target_parent && !is_dir($target_parent)) {
        $target_parent = dirname($target_parent);
    }

    // Get the permission bits.
    if ($stat = @stat($target_parent)) {
        $dir_perms = $stat['mode'] & 0007777;
    } else {
        $dir_perms = 0777;
    }

    if (@mkdir($target, $dir_perms, true)) {

        // If a umask is set that modifies $dir_perms, we'll have to re-set the $dir_perms correctly with chmod()
        if ($dir_perms != ($dir_perms & ~umask())) {
            $folder_parts = explode('/', substr($target, strlen($target_parent) + 1));
            for ($i = 1; $i <= count($folder_parts); $i++) {
                @chmod($target_parent . '/' . implode('/', array_slice($folder_parts, 0, $i)), $dir_perms);
            }
        }

        return true;
    }

    return false;
}

function isStream($path)
{
    $scheme_separator = strpos($path, '://');

    if (false === $scheme_separator) {
        // $path isn't a stream
        return false;
    }

    $stream = substr($path, 0, $scheme_separator);

    return in_array($stream, stream_get_wrappers(), true);
}

/**
 * Validate email address by domain
 * 
 * Checks if the email address belongs to an accepted domain
 */
function validateByDomain($emailAddress, $acceptedDomails)
{
    // Get the domain from the email address
    $domain = getDomain(trim($emailAddress));

    // Check if domain is accepted. Return return if so
    if (in_array($domain, $acceptedDomails)) {
        return true;
    }

    return false;
}

/**
 * Get the domain
 * 
 * Gets the domain from an email address
 */
function getDomain($emailAddress)
{
    // Check if a valid email address was submitted
    if (!isEmail($emailAddress)) {
        return false;
    }

    // Split the email address at the @ symbol
    $emailParts = explode('@', $emailAddress);

    // Pop off everything after the @ symbol
    $domain = array_pop($emailParts);

    return $domain;
}

/**
 * Check email address
 * 
 * Checks if the submitted value is a valid email address
 */
function isEmail($emailAddress)
{
    // Filter submitted value to see if it's a proper email address
    if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        return true;
    }

    return false;
}

/**
 * Check email provider
 * 
 */
function isGmailProvider($emailAddress)
{
    $domain = getDomain($emailAddress);
    if ($domain == 'gmail.com') {
        return true;
    }
    return false;
}

function arrayParamsToUrlString($arrayParams)
{
    $ctr = 0;
    $urlStringParams = '';
    foreach ($arrayParams as $key => $value) {
        if ($ctr === 0) {
            $urlStringParams .= $key . '=' . urlencode($value);
        } else {
            $urlStringParams .= '&' . $key . '=' . urlencode($value);
        }
        $ctr++;
    }
    return $urlStringParams;
}

function deleteDir($dirPath)
{
    if (is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                return deleteDir($file);
            } else {
                return unlink($file);
            }
        }
        return rmdir($dirPath);
    }
    return false;
}

function getDashbordData()
{
    $mysqllink = dbCon();
    $sql = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a 
    LEFT JOIN customers b ON a.`cidno` = b.`cidno` 
    LEFT JOIN sites s ON a.`siteid` = s.`siteid`
    LEFT JOIN jobnotes j ON a.`jobid` = j.joblink
    LEFT JOIN invoices c ON a.`jobid` = c.`joblink`";
    $result = mysqli_query($mysqllink, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

function viewJobsbyId($id)
{
    $mysqllink = dbCon();
    $sql = "SELECT b.* FROM jobs b where b.jobid = '" . $id . "' limit 1";
    $result = mysqli_query($mysqllink, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
    }
    return $jobs;
}

function viewCustomerbyId($id)
{
    $mysqllink = dbCon();
    $sql = "SELECT a.* FROM customers  a where a.cidno = '" . $id . "' limit 1";
    $result = mysqli_query($mysqllink, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

// MySql Connection using Config variable
function dbCon()
{
    include('config.php');
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}

// Function to get mysql data.
function getResult($query)
{
    $con = dbCon();
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return FALSE;
    }
}


// Validation login .
function checkUser($data)
{
    // Array $data contain form request.
    $username = str_replace(";", "", $data['username']);
    $pass = strtoupper(md5(trim($data['pass'])));
    $ip = $data['ip'];
    $con = dbCon();

    // Check 1 : Checking if username/password and ip is exist
    if ($username && $pass && $ip) {
        logmsg(" #344 - Start");
        $countIP = getIpCount($ip);
        // Check 2 : for attempts
        if ($countIP > 20) {
            logmsg(' #348 - User has tried more then 20 times with ip so IP has blocked');
            header("location:adminlogin.php?loginerror=Your IP is Blocked.");
            exit;
        }

        // Getting user data if exist.
        $sql = "SELECT * from swd_setup_users where pusername = '" . $username . "'";
        $user  = getResult($sql); // Retriving user data by username.

        if ($user) {
            // Check 3 : If user exist in database then checking password also.
            logmsg(' #359 Userfound in db.');
            $sql = "SELECT * from swd_setup_users where pusername = '$username' and ppassword = '$pass'";
            // Using function to get mysql data.    
            $userdata = getResult($sql);

            if ($userdata) {
                logmsg(' #365 Username and password is correct.');
                $cenvertedTime = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($user[0]['last_login'])));
                if ($user[0]['login_attempts'] == 3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)) {
                    //echo $user[0]['login_attempts'] . ' : ' . date("Y-m-d H:i:s") . ' : ' . $cenvertedTime;
                    logmsg(' #369 User has tried 3 times with incorrect password so account has locked');
                    $error_message = 'Your account is temporarily locked, please try after ' . $cenvertedTime . '';
                    logmsg(' #371 Incorrect Password, ' . $error_message);
                    $sql = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$ip')";
                    mysqli_query($con, $sql);
                    header("location:adminlogin.php?loginerror=Incorrect Password, " . $error_message);
                    exit;
                }
                // Check 4 : Getting result if both variable is correct.
                $userid = $userdata[0]['id'];
                $sql = "UPDATE swd_setup_users set login_attempts='0', last_login=NULL 
                WHERE id = $userid ";
                mysqli_query($con, $sql);
                $sql = "SELECT * from swd_setup_users WHERE id = $userid ";
                // Updating swd_setup_users table and return userdata based on id.
                logmsg(' #384 Login Success');
                return getResult($sql);
            } else {
                // Check 5 : Checking login attempts and blocking users for 10 minutes.
                $cenvertedTime = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($user[0]['last_login'])));
                if ($user[0]['login_attempts'] == 3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)) {
                    $error_message = 'Your account is temporarily locked, please try after ' . $cenvertedTime . '';
                    $sql = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$ip')";
                    mysqli_query($con, $sql);
                    logmsg(' #369 User has tried 3 times with incorrect password so account has locked');
                    logmsg(' #394 Incorrect Password,' . $error_message . '.');
                    header("location:adminlogin.php?loginerror=Incorrect Password, " . $error_message);
                    exit;
                }
                // Updating details in swd_setup_users after 10 minutes if password is not correct.
                $dttime = date('Y-m-d H:i:s');
                $sql = "UPDATE swd_setup_users set login_attempts = login_attempts + 1 , last_login = '" . $dttime . "'
                WHERE pusername = '" . $username . "'";
                mysqli_query($con, $sql);
                $sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$ip')";
                mysqli_query($con, $sqlip);
                if ($user[0]['login_attempts'] < 4) {
                    // Updating login attempts in error message.
                    $left = (3 - $user[0]['login_attempts']);
                    $er_msg =  $left . " Login attempt left.";
                    logmsg(' #409 ' . $er_msg);
                    header("location:adminlogin.php?loginerror=Incorrect Password, " . $er_msg);
                    exit;
                }
                // Check 6 : If password is incorrect for existing user.
                logmsg(' #414 Incorrect password.');
                header("location:adminlogin.php?loginerror=Incorrect Password. ");
                exit;
            }
        } else {
            // Check 7 : Updating IP address in swd_ip_lock in username is not correct.
            $sqlip = "INSERT INTO swd_ip_lock (`ipaddress`)	VALUES ('$ip')";
            mysqli_query($con, $sqlip);
            logmsg(' #422 Username not exist');
            header("location:adminlogin.php?loginerror=Username not exist");
            exit;
        }
    } else {
        // If argument is missing or invalid request.
        logmsg(' #428 Invalid Request');
        header("location:adminlogin.php?loginerror=Invalid Request");
        exit;
    }
}


// Function to check login attempts for ip address.
function getIpCount($ip)
{
    $con = dbCon();
    $sql = "SELECT * from swd_ip_lock where ipaddress = '$ip'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
// Count of jobs.
function getCount($param)
{
    $con = dbCon();
    $sql = "SELECT * from " . $param . "";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

function logmsg($msg)
{
    $file = 'logs/logs.txt';
    $ip = get_client_ip();
    if ($file) {
        $d = date('Y-m-d H:i:s');
        $message = $d . " : " . $ip . " : " . $msg . "\r\n";
        file_put_contents($file, $message, FILE_APPEND);
    }
}

function getJobStatus($status)
{
    $con = dbCon();
    if ($status == 1) {
        $sql = "SELECT * from jobs where finjob IS NOT NULL";
    } else {
        $sql = "SELECT * from jobs where finjob IS NULL";
    }
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}


function getInvoiceTotal()
{
    $sql = "SELECT SUM(tot) AS total FROM invoices";
    $amount = getResult($sql);
    return $amount[0]['total'];
}

function getJobsView()
{
    /*$SQL = "SELECT s.siteaddress,j.jobid,j.worksid,j.dtcr,j.status,jn.notes FROM jobs j 
            left JOIN sites s ON j.siteid=s.siteid left JOIN jobnotes jn ON j.jobid=jn.joblink"; */
    $SQL = "SELECT s.*,j.*,jn.* FROM jobs j left JOIN sites s ON j.siteid=s.siteid left JOIN jobnotes jn ON j.jobid=jn.joblink";
    $data = getResult($SQL);
    return $data;
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function allowIp(){
   $ip = get_client_ip();
   if ( ($ip == "92.16.150.76") || ($ip == "182.73.16.20") ) return true;
}
