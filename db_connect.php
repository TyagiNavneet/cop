<?PHP
	// Set Time to UK
	if(ini_get("date.timezone")!=="Europe/London") {
		if(ini_set("date.timezone", "Europe/London")===FALSE) {
			echo "Unable to set timezone."; 
		}
	}
		

$resproject = [
    'dbhost' => 'localhost',
    'dbname' => 'ewsltdco_cavparkcust',
    'dbuser' => 'ewsltdco_cpcust',
    'dbpwd' => 'DL]WyW2~X+k0',
    'dbenginetype' => 'MySQL'
];
// Connect to server and select databse.
$mysqllink = OpenConMysql($resproject);

function OpenConMssql($data) {
    $serverName = $data['dbhost'];
    $connectionInfo = array("Database" => $data['dbname'], "UID" => $data['dbuser'], "PWD" => $data['dbpwd']);
    //echo "<pre>";print_r($serverName);exit;
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn === false)
        die("<pre>" . print_r(sqlsrv_errors(), true));
    return $conn;
}

function OpenConMysql($data) {
    $dbhost = $data['dbhost'];
    $db = $data['dbname'];
    $dbuser = $data['dbuser'];
    $dbpass = $data['dbpwd'];
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}
