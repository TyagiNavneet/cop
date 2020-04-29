<?PHP error_reporting(0);
function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } //!empty($_SERVER['HTTP_CLIENT_IP'])
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } //!empty($_SERVER['HTTP_X_FORWARDED_FOR'])
    else {
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
    $OPEN_SSL_METHOD       = 'aes-256-cbc';
    $BASE64_ENCRYPTION_KEY = 'G1fM0aXhguJ5tVaqVMSWDHB+Jk6QFd99FgkfAcEgwjI';
    $BASE64_IV             = 'xIkaSwduZFjtP4SI4mIyOg';
    $encrypted             = openssl_encrypt($message, $OPEN_SSL_METHOD, base64_decode($BASE64_ENCRYPTION_KEY), 0, base64_decode($BASE64_IV));
    $base64_encrypted      = base64_url_encode($encrypted);
    return $base64_encrypted;
}
function mdecrypt($base64_encrypted)
{
    $OPEN_SSL_METHOD       = 'aes-256-cbc';
    $BASE64_ENCRYPTION_KEY = 'G1fM0aXhguJ5tVaqVMSWDHB+Jk6QFd99FgkfAcEgwjI';
    $BASE64_IV             = 'xIkaSwduZFjtP4SI4mIyOg';
    $encrypted             = base64_url_decode($base64_encrypted);
    $decrypted             = openssl_decrypt($encrypted, $OPEN_SSL_METHOD, base64_decode($BASE64_ENCRYPTION_KEY), 0, base64_decode($BASE64_IV));
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
    } //is_string($dateTime)
    elseif (is_object($dateTime)) {
        $dt = DateTime::createFromFormat($format, $dateTime->format($format));
        return $dt->format($format) === $dateTime->format($format);
    } //is_object($dateTime)
    return false;
}
function validateDate($date)
{
    $format = 'Y-m-d';
    if (is_string($date)) {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    } //is_string($date)
    elseif (is_object($date)) {
        $d = DateTime::createFromFormat($format, $date->format($format));
        return $d->format($format) === $date->format($format);
    } //is_object($date)
    return false;
}
function mkdirPath($target)
{
    $wrapper = null;
    // strip the protocol
    if (isStream($target)) {
        list($wrapper, $target) = explode('://', $target, 2);
    } //isStream($target)
    // from php.net/mkdir user contributed notes
    $target = str_replace('//', '/', $target);
    // put the wrapper back on the target
    if ($wrapper !== null) {
        $target = $wrapper . '://' . $target;
    } //$wrapper !== null
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
    } //'.' != $target_parent && !is_dir($target_parent)
    // Get the permission bits.
    if ($stat = @stat($target_parent)) {
        $dir_perms = $stat['mode'] & 0007777;
    } //$stat = @stat($target_parent)
    else {
        $dir_perms = 0777;
    }
    if (@mkdir($target, $dir_perms, true)) {
        // If a umask is set that modifies $dir_perms, we'll have to re-set the $dir_perms correctly with chmod()
        if ($dir_perms != ($dir_perms & ~umask())) {
            $folder_parts = explode('/', substr($target, strlen($target_parent) + 1));
            for ($i = 1; $i <= count($folder_parts); $i++) {
                @chmod($target_parent . '/' . implode('/', array_slice($folder_parts, 0, $i)), $dir_perms);
            } //$i = 1; $i <= count($folder_parts); $i++
        } //$dir_perms != ($dir_perms & ~umask())
        return true;
    } //@mkdir($target, $dir_perms, true)
    return false;
}
function isStream($path)
{
    $scheme_separator = strpos($path, '://');
    if (false === $scheme_separator) {
        // $path isn't a stream
        return false;
    } //false === $scheme_separator
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
    } //in_array($domain, $acceptedDomails)
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
    } //!isEmail($emailAddress)
    // Split the email address at the @ symbol
    $emailParts = explode('@', $emailAddress);
    // Pop off everything after the @ symbol
    $domain     = array_pop($emailParts);
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
    } //filter_var($emailAddress, FILTER_VALIDATE_EMAIL)
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
    } //$domain == 'gmail.com'
    return false;
}
function arrayParamsToUrlString($arrayParams)
{
    $ctr             = 0;
    $urlStringParams = '';
    foreach ($arrayParams as $key => $value) {
        if ($ctr === 0) {
            $urlStringParams .= $key . '=' . urlencode($value);
        } //$ctr === 0
        else {
            $urlStringParams .= '&' . $key . '=' . urlencode($value);
        }
        $ctr++;
    } //$arrayParams as $key => $value
    return $urlStringParams;
}
function deleteDir($dirPath)
{
    if (is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        } //substr($dirPath, strlen($dirPath) - 1, 1) != '/'
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                return deleteDir($file);
            } //is_dir($file)
            else {
                return unlink($file);
            }
        } //$files as $file
        return rmdir($dirPath);
    } //is_dir($dirPath)
    return false;
}
/* Below Function added by Navneet */
/**
MySql Connection using Config variable
@Naveet
*/
function dbCon()
{
    include_once('config.php');
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}
/**
 *  Function to get Mysql query result
 *  @Navneet
 * */
function getResult($query)
{
    $con    = dbCon();
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        } //$row = mysqli_fetch_assoc($result)
        return $data;
    } //mysqli_num_rows($result) > 0
    else {
        return null;
    }
}
/**
 * Function log for test log message
 * Argument message
 **/
function logmsg($msg)
{ // uncomment for testing logs.@navneet
   /*  $file = 'logs/logs.txt';
    $ip   = get_client_ip();
    if ($file) {
        $d       = date('Y-m-d H:i:s');
        $message = $d . " : " . $ip . " : " . $msg . "\r\n";
        file_put_contents($file, $message, FILE_APPEND);
    } //$file
*/ }
/**
 *  Function for get user machine IP.
 * */
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
/** Function for validating user
 *  It take username,password, ip and attempt as arguments.
 *  Getting logs for testing and redirect to home page on failed validation.
 *  @Navneet 
 * */
function checkUser($data)
{
    // Array $data contain form request.
    $username = str_replace(";", "", $data['username']);
    $pass     = strtoupper(md5(trim($data['pass'])));
    $ip       = $data['ip'];
    $con      = dbCon();
    // Check 1 : Checking if username/password and ip is exist
    if ($username && $pass && $ip) {
        logmsg(" #344 - Start");
        $countIP = getIpCount($ip);
        // Check 2 : for attempts
        if ($countIP > 20) {
            logmsg(' #348 - User has tried more then 20 times with ip so IP has blocked');
            redirect("adminlogin.php?loginerror=Your IP is Blocked.");
            exit;
        } //$countIP > 20
        // Getting user data if exist.
        $sql  = "SELECT * from swd_setup_users where pusername = '" . $username . "'";
        $user = getResult($sql); // Retriving user data by username.
        if ($user) {
            // Check 3 : If user exist in database then checking password also.
            logmsg(' #359 Userfound in db.');
            $sql      = "SELECT * from swd_setup_users where pusername = '$username' and ppassword = '$pass'";
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
                    $sql = "INSERT INTO swd_ip_lock (`ipaddress`)   VALUES ('$ip')";
                    mysqli_query($con, $sql);
                    redirect("adminlogin.php?loginerror=Incorrect Password, " . $error_message);
                    exit;
                } //$user[0]['login_attempts'] == 3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)
                // Check 4 : Getting result if both variable is correct.
                $userid = $userdata[0]['id'];
                $sql    = "UPDATE swd_setup_users set login_attempts='0', last_login=NULL 
                WHERE id = $userid ";
                mysqli_query($con, $sql);
                $sql = "SELECT * from swd_setup_users WHERE id = $userid ";
                // Updating swd_setup_users table and return userdata based on id.
                logmsg(' #384 Login Success');
                return getResult($sql);
            } //$userdata
            else {
                // Check 5 : Checking login attempts and blocking users for 10 minutes.
                $cenvertedTime = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($user[0]['last_login'])));
                if ($user[0]['login_attempts'] == 3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)) {
                    $error_message = 'Your account is temporarily locked, please try after ' . $cenvertedTime . '';
                    $sql           = "INSERT INTO swd_ip_lock (`ipaddress`)   VALUES ('$ip')";
                    mysqli_query($con, $sql);
                    logmsg(' #369 User has tried 3 times with incorrect password so account has locked');
                    logmsg(' #394 Incorrect Password,' . $error_message . '.');
                    redirect("adminlogin.php?loginerror=Incorrect Password, " . $error_message);
                    exit;
                } //$user[0]['login_attempts'] == 3 && strtotime(date("Y-m-d H:i:s")) < strtotime($cenvertedTime)
                // Updating details in swd_setup_users after 10 minutes if password is not correct.
                $dttime = date('Y-m-d H:i:s');
                $sql    = "UPDATE swd_setup_users set login_attempts = login_attempts + 1 , last_login = '" . $dttime . "'
                WHERE pusername = '" . $username . "'";
                mysqli_query($con, $sql);
                $sqlip = "INSERT INTO swd_ip_lock (`ipaddress`) VALUES ('$ip')";
                mysqli_query($con, $sqlip);
                if ($user[0]['login_attempts'] < 4) {
                    // Updating login attempts in error message.
                    $left   = (3 - $user[0]['login_attempts']);
                    $er_msg = $left . " Login attempt left.";
                    logmsg(' #409 ' . $er_msg);
                    redirect("adminlogin.php?loginerror=Incorrect Password, " . $er_msg);
                    exit;
                } //$user[0]['login_attempts'] < 4
                // Check 6 : If password is incorrect for existing user.
                logmsg(' #414 Incorrect password.');
                redirect("adminlogin.php?loginerror=Incorrect Password. ");
                exit;
            }
        } //$user
        else {
            // Check 7 : Updating IP address in swd_ip_lock in username is not correct.
            $sqlip = "INSERT INTO swd_ip_lock (`ipaddress`) VALUES ('$ip')";
            mysqli_query($con, $sqlip);
            logmsg(' #422 Username not exist');
            redirect("adminlogin.php?loginerror=Username not exist");
            exit;
        }
    } //$username && $pass && $ip
    else {
        // If argument is missing or invalid request.
        logmsg(' #428 Invalid Request');
        redirect("adminlogin.php?loginerror=Invalid Request");
        exit;
    }
}
/**
Function to check login attempts for ip address.
@Navneet 
*/
function getIpCount($ip)
{
    $con    = dbCon();
    $sql    = "SELECT * from swd_ip_lock where ipaddress = '$ip'";
    $result = mysqli_query($con, $sql);
    $count  = mysqli_num_rows($result);
    return $count;
}
/**
 * Function getJobsData will be used for fetching data. 
 * Argument Jobid, From Month and Year. Default will be take null 
 * userCustId is storing in session at the time of success login, It's based on swd_setup_users table.
 * Retuer Array of data.
 * @ Navneet
 * */
function getJobsData($jobid = null, $mnth = null, $year = null, $status = null)
{
    $mysqllink  = dbCon();
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    if (isset($mnth) && isset($year) && isset($userCustId) && !isset($jobid) && !isset($status)) {
        $dayInMonth = cal_days_in_month(CAL_GREGORIAN, $mnth, $year);
        $fromDate   = $year . "-" . $mnth . "-01";
        $toDate     = $year . "-" . $mnth . "-" . $dayInMonth;
        $sql        = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId' and a.dtcr >= '$fromDate' and a.dtcr<='$toDate'";
    } //isset($mnth) && isset($year) && isset($userCustId) && !isset($jobid) && !isset($status)
    elseif (isset($mnth) && isset($year) && isset($userCustId) && isset($status) && !isset($jobid)) {
        $dayInMonth = cal_days_in_month(CAL_GREGORIAN, $mnth, $year);
        $fromDate   = $year . "-" . $mnth . "-01";
        $toDate     = $year . "-" . $mnth . "-" . $dayInMonth;
        $sql        = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId' and a.dtcr >= '$fromDate' and a.dtcr<='$toDate' and a.fin != 0";
    } //isset($mnth) && isset($year) && isset($userCustId) && isset($status) && !isset($jobid)
        elseif (isset($jobid) && isset($userCustId) && !isset($mnth) && !isset($year) && !isset($status)) {
        $sql = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId' and a.jobid='$jobid'";
    } //isset($jobid) && isset($userCustId) && !isset($mnth) && !isset($year) && !isset($status)
        elseif (isset($userCustId) && !isset($jobid) && !isset($mnth) && !isset($year) && !isset($status)) {
        $sql = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId'";
    } //isset($userCustId) && !isset($jobid) && !isset($mnth) && !isset($year) && !isset($status)
    else {
        $sql = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink`";
    }
    return getResult($sql);
}

/**
 *  Function for get jobs data filter date
 * */
function getJobsDataByDate($fromDate,$endDate)
{
    $mysqllink  = dbCon();
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    if (isset($fromDate) && isset($endDate) && isset($userCustId)) {
        $sql  = "SELECT a.*,b.*,c.*,s.siteaddress AS siadd,j.notes AS lnote FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId' and a.dtcr >= '$fromDate' and a.dtcr<='$endDate'";
       return getResult($sql);
    }
}

/**
 * Function getInvicesData will be used for fetching data. 
 * Argument invoiceID, From Month and Year and status of invoice amount. default will be null .
 * userCustId is storing in session at the time of success login, It's based on swd_setup_users table.
 * Retuer Array of data.
 * @ Navneet
 * */
function getInvoiceData($invno = null, $mnth = null, $year = null, $status = null)
{
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    if (isset($userCustId) && isset($mnth) && isset($year) && !isset($invno) && !isset($status)) {
        $dayJob   = cal_days_in_month(CAL_GREGORIAN, $mnth, $year);
        $fromDate = $year . "-" . $mnth . "-01";
        $toDate   = $year . "-" . $mnth . "-" . $dayJob;
        $sql      = "SELECT * FROM invoices WHERE date >='$fromDate' AND date <= '$toDate' and cidlink = '$userCustId'";
    } //isset($userCustId) && isset($mnth) && isset($year) && !isset($invno) && !isset($status)
    elseif (isset($userCustId) && isset($mnth) && isset($year) && isset($status) && !isset($invno)) {
        $dayJob   = cal_days_in_month(CAL_GREGORIAN, $mnth, $year);
        $fromDate = $year . "-" . $mnth . "-01";
        $toDate   = $year . "-" . $mnth . "-" . $dayJob;
        $sql      = "SELECT sum(tot) as totalAmount FROM invoices WHERE date >='$fromDate' AND date <= '$toDate' and cidlink = '$userCustId'";
    } //isset($userCustId) && isset($mnth) && isset($year) && isset($status) && !isset($invno)
        elseif (isset($userCustId) && !isset($mnth) && !isset($year) && !isset($status) && isset($invno)) {
        $sql = "SELECT * FROM invoices WHERE cidlink='$userCustId' and invno=$invno";
    } //isset($userCustId) && !isset($mnth) && !isset($year) && !isset($status) && isset($invno)
        elseif (isset($userCustId) && !isset($mnth) && !isset($year) && !isset($status) && !isset($invno)) {
        $sql = "SELECT * FROM invoices WHERE cidlink='$userCustId' order by invno desc";
    } //isset($userCustId) && !isset($mnth) && !isset($year) && !isset($status) && !isset($invno)
    else {
        $sql = "SELECT * FROM invoices";
    }
    return getResult($sql);
}


/**
 *  Function for get invoice data filter date
 * */
function getInvoiceDataByDate($fromDate,$endDate)
{
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    if (isset($fromDate) && isset($endDate) && isset($userCustId)) {
        $sql  = "SELECT * FROM invoices WHERE date >='$fromDate' AND date < '$endDate' and cidlink = '$userCustId'";
       return getResult($sql);
    }
}

/**
 * Function for get details for TAB 1 jobsview
 * 
 * */

function getDetailsForTab1($id){
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
  $sql=  "SELECT  a.planid,a.plandate,a.planname,c.tname FROM planner a 
LEFT JOIN labourplanner b ON a.planid=b.planid 
LEFT JOIN tradesmen c ON b.labourid=c.tid 
LEFT JOIN jobs j ON a.joblink=j.jobid WHERE j.cidno='".$userCustId."' and a.joblink='".$id."' GROUP BY a.planid ORDER BY a.planid DESC";
    return getResult($sql);
 }

 /**
  * 
  * 
  * */

function getAttchedFile(){
$sql = "SELECT * FROM attachedfiles WHERE showtocust=1";
return getResult($sql);
}

function getInvoiceFile($id){
$sql = "SELECT * FROM attachedfiles WHERE showtocust=1";
return getResult($sql);

}

// Dropdown function 
function ddlJobSitename()
{
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    $sql        = "SELECT distinct a.sitename FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId'";
    return getResult($sql);
}
function ddlJobStatus()
{
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    $sql        = " SELECT distinct a.status FROM jobs  a LEFT JOIN customers b ON a.`cidno` = b.`cidno` LEFT JOIN sites s ON a.`siteid` = s.`siteid` LEFT JOIN jobnotes j ON a.`jobid` = j.joblink LEFT JOIN invoices c ON a.`jobid` = c.`joblink` where b.cidno = '$userCustId'";
    return getResult($sql);
}
function ddlCustomer()
{
    $userCustId = isset($_SESSION["82j2ud2891166scustid"]) ? $_SESSION["82j2ud2891166scustid"] : null;
    $sql        = "SELECT distinct cname FROM invoices WHERE cidlink = '$userCustId'";
    return getResult($sql);
}
function ddlInvoiceStatus()
{
    $data = array(
        'Yes',
        'No'
    );
    return $data;
}
/**
 * View details customer by id
 * */
function viewCustomerbyId($id)
{
    $mysqllink = dbCon();
    $sql       = "SELECT a.*,b.* FROM customers a JOIN sites b ON a.cidno = b.custlink where a.cidno = '" . $id . "' limit 1";
    return getResult($sql);
}