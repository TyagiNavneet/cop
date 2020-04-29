<?php
// Destroying session 
include('functions.php');
session_start();
session_destroy();
session_unset();
logmsg('#5 logout - success');
#header("Location: http://cavcust.bespokesoftware.co/index.php");
header("Location: http://localhost/cop/index.php");
