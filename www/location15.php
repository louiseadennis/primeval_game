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

check_location(15, $mysql);

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
<img src=assets/location15.png>
<h2>A Poisonous Fog</h2>

<p>You are standing on bare rocks.  You can see virtually nothing beyond a thick green fog that makes it difficult to breath.

<?php

$action_done = get_value_from_users("action_done", $mysql);
if ($action_done) {
   print "<p>As you peer through the fog you see someone has painted onto the rock \"0, 2, 4, ?\" and \"?, D, F, H\"</p>";
   add_location_clue(15, $mysql);
} else {
   print "<b>You must use breathing apparatus or you will take damage and be too busy choking to see anything.</b></p>";
}
?>
</div>
</body>
</html>