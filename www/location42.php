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

check_location(42, $mysql);

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
<h2>A Jungle</h2>

<p>You are standing in a lush jungle.  You recognise many of the trees but sense there are large creatures moving around in the undergrowth.</p>

<?php
if ($phase > 4) {
   add_location_clue(42, $mysql);
?>
<p>You see a strange symbol carved onto a rock:</p>
<center>
<img src=assets/clue42.png>
</center>
<?php
}
print_equipment($mysql);
?>
</body>
</html>