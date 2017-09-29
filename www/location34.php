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

check_location(34, $mysql);

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
$sid_collected = check_for_character('sid', $mysql);

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Hot Desert</h2>

<p>You are standing in a hot desert surrounded by burrows.</p>

<?php

if (!$rex_collected) {
     update_users("new_character", "sid", $mysql);
     print "<img src=assets/sid.png align=left>";
     print "<p>Sid is here.  He leaps out of his burrow and runs eagerly towards you.</p>";
}

print_equipment($mysql);
?>
</body>
</html>