<?php
// Destroying session 
include('functions.php');
session_destroy();
logmsg('#5 logout - success');
header("Location: http://localhost/cop/index.php");
