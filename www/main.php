<?php 

require_once('./config/accesscontrol.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

$location_id = mysqlclean($_POST, "location", 10, $mysql);

if ($location_id=='')
{
   header("Location: location1.php");
   exit;
 }
?>
<html>
<head>
<title>52 Weeks of Primeval - The Gentlemen of Primeval</title>

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<p>This is the main page.  It should not appear</b>
</body>
</html>