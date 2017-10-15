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

check_location(33, $mysql);

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
<img src=assets/location25.png>
<h2>A Cliff overlooking a Canyon</h2>

<p>You are standing on a high cliff above a canyon through which a river runs.  You can see many strange plants on the canyon  floor.</p>

<?php

$phase = get_value_from_users("phase", $mysql);
if ($phase > 3) {
   print "<p>On one of the rocks has been carved.  The square root of 49 be: the answer.</p>";
   add_location_clue(33, $mysql);
}
?>
</div>
</body>
</html>