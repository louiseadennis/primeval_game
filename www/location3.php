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

check_location(3, $mysql);
add_location_clue(3, $mysql);

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

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>The Edge of a Floodplain</h2>

<p>You are standing on a small hillock in the middle of a flooded plain.  In the distance you can make out where you think the river must be.   A small pack of Coelophysis dart across the muddy ground, wading through pools of water and, it would appear, hunting for lizards.</p>

<p>A large rock sits on the top of the hillock into which someone has carved the letters IB.  Stephen mutters something about it confusing archeologists.</p>


<?php
print_equipment($mysql);
?>
</body>
</html>