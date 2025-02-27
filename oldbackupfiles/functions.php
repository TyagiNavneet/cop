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
// Checking user Session data
function checkUser($data)
{
    if ($data) return true;
}
