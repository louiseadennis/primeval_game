<?php 

require_once('./config/accesscontrol.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
require_once('utilities.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

$uname = $_SESSION["loginUsername"];
$location = get_location($mysql);
?>
<html>
<head>
<title>52 Weeks of Primeval -
<?php
echo $uname;
?>
 Profile</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<dl>
<dt>Username:</dt>
<dd>
<?php
echo $uname;
?>
</dd>
</dl>
<p><form method="POST" action="main.php">
<input type="hidden" name="location_id" value="
<?php
echo $location
?>
">
<input type="submit" value="Back to Game">
</form>
</p>
</body>
</head>
</html>
