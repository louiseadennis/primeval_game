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

check_location(10, $mysql);

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
<img src=assets/location10.png>
<h2>An Coral Reef</h2>

<p>You are in the middle of a wide ocean, though you can see a reef beneath you with ammonites swimming about.</p>  
<?php

$action_done = get_value_from_users("action_done", $mysql);
if (!$action_done) {
   print "<p><b>You will need a boat otherwise you will be swept out of the anomaly again!</b></p>";
}
?>
</div>
</body>
</html>