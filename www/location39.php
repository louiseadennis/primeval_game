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

check_location(39, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location39.png>
<h2>The Shores of a Lake</h2>

<p>You are standing on the shore of a lake and you can see a volcano in the distance.  The ground is bare of life and the atmosphere is difficult to breath.</p>

<?php

$action_done = get_value_from_users("action_done", $mysql);
if (!$action_done) {
   print "<p><b>You must use breathing apparatus or will take damage.</b></p>";
}
?>
</div>
</body>
</html>