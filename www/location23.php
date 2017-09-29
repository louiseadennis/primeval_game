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

check_location(23, $mysql);

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
$wilder_collected = check_for_character('wilder', $mysql);
if (!$wilder_collected) {
   add_equipment("hand gun", $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Rocky Shore</h2>

<p>You are on a bare rocky sea shore.  You can see strange tubular, frond-shaped organisms in the rock pools.</p>

<?php

if (!$wilder_collected) {
     update_users("new_character", "wilder", $mysql);
     print "<img src=assets/wilder.png align=left>";
     print "<p>Wilder is here.</p>";
}

print_equipment($mysql);
?>
</body>
</html>