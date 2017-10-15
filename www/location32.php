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

check_location(32, $mysql);

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
<div  class=location>
<img src=assets/location32.png>
<h2>A Sandy Desert</h2>

<p>You find yourself standing on a rocky outcrop in the middle of a sea of sand.  The air is low in oxygen which makes it hard, but not impossible, to breathe.
<?php

$action_done = get_value_from_users("action_done", $mysql);
if ($action_done) {
   print "<b>You must use breathing apparatus or take damage.</b>";
}
?>
</p>
</div>
</body>
</html>