<?php 
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

check_location(51, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location51.png>
<h2>A Deep Pool on the shores of a Lake.</h2>

<p>You standing above a deep pool by the shores of lake surrounded by Herspernornis.  You can see Helen swimming in the pool below you, but by the time you get down there she has gone.  Nick says this is where he first met Helen again after discovering about the anomalies.</p>
</div>
</body>
</html>